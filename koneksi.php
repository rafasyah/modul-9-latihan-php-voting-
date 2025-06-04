<?php

//koneksi ke database 
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_osis"; //nama database

//perintah untuk koneksi
$koneksi = new mysqli($host, $user, $pass, $db);

//cek koneksi 
if ($koneksi->connect_error) {
    //menghentikan skrip dan menampilkan pesan 
    die("koneksi gagal: " . $koneksi->connect_error);
} else {
    // echo "koneksi berhasil";
}