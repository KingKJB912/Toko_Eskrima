<?php
// Konfigurasi koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'tokoeskrima';

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
