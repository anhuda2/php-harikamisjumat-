<?php

$menu = "data";

require_once('koneksi.php');

if (isset($_GET['pencarian'])) {
    $cari = $_GET['pencarian'];
    // panggil table data siswa
    $ambil_data = mysqli_query($con, "SELECT a.*,k.nama_kelas FROM `data_siswa` a left JOIN  daftar_kelas b on b.no_siswa=a.no left join kelas k on k.id=b.id_kelas where a.nama like '%$cari%'  ");
} else {
    // panggil seluruh table data siswa
    $ambil_data = mysqli_query($con, "SELECT a.*,k.nama_kelas FROM `data_siswa` a left JOIN daftar_kelas b on b.no_siswa=a.no left join kelas k on k.id=b.id_kelas  ");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora&display=swap" rel="stylesheet">
</head>


<body style="font-family: 'Sora', sans-serif;">


    <?php require_once('navbar.php'); ?>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kota</th>
                    <th scope="col">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM daftar_kota ORDER BY jumlah_penduduk DESC";
                $result = mysqli_query($con, $query);
                $no = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['nama_kota'] . "</td>";
                    echo "<td>" . $row['jumlah_penduduk'] . "</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>




    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- JQUERY 3.X -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


</body>

</html>