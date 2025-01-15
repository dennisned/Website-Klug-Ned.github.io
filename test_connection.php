<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hubungi_kami'; // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi ke database berhasil!";
?>
