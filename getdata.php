<?php
include_once('koneksi.php');

$id = $_POST['id'];
$ambil_data = mysqli_query($con, "SELECT a.*,k.nama_kelas,k.id as id_kelas FROM `data_siswa` a left JOIN daftar_kelas b on b.no_siswa=a.no left join kelas k on k.id=b.id_kelas  where a.`no` = '$id'");

$data = mysqli_fetch_assoc($ambil_data);
// echo var_dump($data);

$ambil_data_kelas = mysqli_query($con,'select nama_kelas,id from kelas');


