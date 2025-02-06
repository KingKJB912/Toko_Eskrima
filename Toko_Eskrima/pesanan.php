<?php
// Include koneksi ke database
include('db.php');

// Pastikan form ditangani dengan baik untuk menambahkan pesanan
if (isset($_POST['tambah_pesanan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal_pesanan = $_POST['tanggal_pesanan'];
    $id_menu = $_POST['id_menu'];
    $jumlah = $_POST['jumlah'];

    // Menghitung subtotal
    $result_menu = $conn->query("SELECT Harga FROM Menu WHERE ID_Menu = '$id_menu'");
    $menu = $result_menu->fetch_assoc();
    $subtotal = $menu['Harga'] * $jumlah;

    // Menambahkan pesanan ke tabel Pesanan
    $query_tambah_pesanan = "INSERT INTO Pesanan (ID_Pelanggan, Tanggal_Pesanan) VALUES ('$id_pelanggan', '$tanggal_pesanan')";
    $conn->query($query_tambah_pesanan);
    
    // Mendapatkan ID Pesanan yang baru saja ditambahkan
    $id_pesanan = $conn->insert_id;

    // Menambahkan detail pesanan ke tabel Detail_Pesanan
    $query_detail_pesanan = "INSERT INTO Detail_Pesanan (ID_Pesanan, ID_Menu, Jumlah, Subtotal) VALUES ('$id_pesanan', '$id_menu', '$jumlah', '$subtotal')";
    $result_detail_pesanan = $conn->query($query_detail_pesanan);

    if ($result_detail_pesanan) {
        echo "Pesanan berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan detail pesanan!";
    }
}