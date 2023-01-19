<?php

require_once('koneksi.php');

$limit = 10;
$offset = 0;
if(isset($_GET['offset'])){
    $offset = $_GET['offset'];
}

if (isset($_GET['pencarian'])) {
    $cari = $_GET['pencarian'];
    // panggil table data siswa
    $ambil_data = mysqli_query($con, "SELECT a.*,k.nama_kelas FROM `data_siswa` a left JOIN  daftar_kelas b on b.no_siswa=a.no left join kelas k on k.id=b.id_kelas where a.nama like '%$cari%' LIMIT $offset, $limit ");
} else {
    // panggil seluruh table data siswa
    $ambil_data = mysqli_query($con, "SELECT a.*,k.nama_kelas FROM `data_siswa` a left JOIN daftar_kelas b on b.no_siswa=a.no left join kelas k on k.id=b.id_kelas LIMIT $offset, $limit ");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>

    <?php require_once('navbar.php'); ?>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
<div class="pagination">
    <?php if ($offset > 0): ?>
        <button type="button" class="btn btn-outline-info prev-btn" style="margin-right: 10px;">
            <a  style="text-decoration: none;" href="home.php?offset=<?php echo $offset - 10; ?>">
                <i class="fas fa-arrow-left"></i>
            </a>
        </button>
    <?php endif; ?>
    <button type="button" class="btn btn-outline-info next-btn">
    <a  style="text-decoration: none;" href="home.php?offset=<?php echo $offset + 10 ?>">
    <i class="fas fa-arrow-right"></i>
            </a>
    </button>
</div>

                <?php $no = 1;
                while ($data = mysqli_fetch_assoc($ambil_data)) {

                    // jika foto kosong maka tampilkan gambar default
                    if ($data['foto'] == "") {
                        $gambar = "Noimg.png";
                    } else {
                        $gambar = $data['foto'];
                    }

                    ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td>
                            <?php echo $data['nama'] ?>
                        </td>
                        <td>
                            <?php echo $data['nohp'] ?>
                        </td>
                        <td><?= $data['alamat'] ?></td>
                        <td>
                            <?= $data['jenkel'] ?>
                        </td>
                        <td><?= $data['nama_kelas'] ?></td>
                        <td><img class="img-thumbnail" width="100" src="assets/<?= $gambar ?>" /></td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-id="<?= $data['no'] ?>" data-bs-aksi="ubah"> Ubah
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-id="<?= $data['no'] ?>" data-bs-aksi="hapus"> Hapus
                            </button>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
            </table>
</div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- JQUERY 3.X -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

            const modal = document.getElementById('exampleModal')
            modal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-bs-id');
                const aksi = button.getAttribute('data-bs-aksi');
                // console.log(id);
                $.post('form.php', { id, aksi }, function (a) {
                    // console.log(a);
                }).done(function (x) {
                    $('.modal-body').html(x);
                }).fail(function () {
                    alert("error");
                }).always(function () {
                    // alert("finished");
                });
            });


            // proses update
            $("#form").submit(function (event) {
                event.preventDefault();
            })

        });

    </script>
</body>

</html>