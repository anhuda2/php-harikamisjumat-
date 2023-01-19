<?php
// <!-- KOneksi database -->
$con = mysqli_connect('localhost', 'root', '', 'mydatabase');
// periksa koneksi
if(!$con){
    die("Koneksi bermasalah".mysqli_connect_errno()." - ".mysqli_connect_error());
}
