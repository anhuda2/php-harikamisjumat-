<?php
include_once('koneksi.php');

// echo var_dump($_POST);
// Kolom data di table
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$jk = $_POST['jenkel'];
$foto = $_FILES['foto']['name'];


// echo "Selamat $nama , alamat anda $alamat , berjenis kelamin $jk No HP $nohp , dengan email $email <br>";

// echo '<img src="assets/'.$foto.'" class="card-img-top" alt="...">';


$insert_data = mysqli_query($con, "INSERT into data_siswa (`nama`,`nohp`,`alamat`,`email`,`jenkel`,`foto`) values ('$nama','$nohp','$alamat','$email','$jk','$foto') ");

if ($insert_data) {
    echo "<p>Data berhasil masuk</p>";
}else{
    echo "<p>Data gagal masuk</p>";
}

echo "<br>";

// echo var_dump($_FILES);

// $nama = $_FILES["foto"]["name"];

move_uploaded_file($_FILES["foto"]["tmp_name"], 'assets/'.$foto);

header("Location: home.php");