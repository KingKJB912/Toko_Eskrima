<?php
// Koneksi database
include('db.php');

// Mulai transaksi
$conn->begin_transaction();

// Include files for menu, pelanggan, and pesanan
include('menu.php');
include('pelanggan.php');
include('pesanan.php');

// Include files for stok and grafik
include('stok.php');
include('grafik.php');

// Mengambil data menu
$query_menu = "SELECT * FROM Menu";
$result_menu = $conn->query($query_menu);

// Mengambil data pelanggan
$query_pelanggan = "SELECT * FROM Pelanggan";
$result_pelanggan = $conn->query($query_pelanggan);

// Mengambil data pesanan dan detailnya
$query_pesanan = "
    SELECT p.ID_Pesanan, p.Tanggal_Pesanan, pl.Nama_Pelanggan, m.Nama_Menu, dp.Jumlah, dp.Subtotal
    FROM Pesanan p
    JOIN Pelanggan pl ON p.ID_Pelanggan = pl.ID_Pelanggan
    JOIN Detail_Pesanan dp ON p.ID_Pesanan = dp.ID_Pesanan
    JOIN Menu m ON dp.ID_Menu = m.ID_Menu
";
$result_pesanan = $conn->query($query_pesanan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Eskrima</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Toko Eskrima</h1>
        <nav>
            <ul>
                <li><a href="#tampil_menu">View</a></li> 
                <li><a href="#menu">Menu</a></li>
                <li><a href="#pelanggan">Pelanggan</a></li>
                <li><a href="#pesanan">Pesanan</a></li>
                <li><a href="#Stok">Stok</a></li>
                <li><a href="#grafik">Grafik</a></li>
            </ul>
        </nav>
        <div>
            <a href="signup.php" class="signup-button">Sign Up</a>
        </div>
    </header>

    <main>
        <section id="tampil_menu">
            <?php include('menu_display.php'); ?>
        </section>

        <section id="menu">
            <?php include('menu_management.php'); ?>
        </section>

        <section id="pelanggan">
            <?php include('pelanggan_management.php'); ?>
        </section>

        <section id="pesanan">
            <?php include('pesanan_management.php'); ?>
        </section>

        <section id="Stok">
            <?php include('stok_management.php'); ?>
        </section>

        <section id="grafik">
            <?php include('grafik_display.php'); ?>
        </section>
    </main>
</body>
</html>