<?php

$host = "localhost"; 
$dbname = "restorandb"; 
$username = "root"; 
$password = "";


$conn = mysqli_connect($host, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "";

?>