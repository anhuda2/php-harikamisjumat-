<?php
include_once('koneksi.php');

$no = $_POST['no'];

// Fetch the file name
$query = "SELECT `foto` FROM `data_siswa` WHERE `no` = '$no'";
$data_foto = mysqli_query($con, $query);
$foto = mysqli_fetch_assoc($data_foto);

// check if the file exist and is a file not a folder 
if (file_exists("assets/" . $foto['foto']) && is_file("assets/" . $foto['foto'])) {
    unlink("assets/" . $foto['foto']);
}

// Delete the data
$delete_data = mysqli_query($con, "DELETE FROM `data_siswa` WHERE `no` = '$no' ");
if ($delete_data) {
    echo "<p>Data has been deleted successfully</p>";
} else {
    echo "<p>Data deletion failed</p>";
}

// Redirect to home page
header("Location: home.php");