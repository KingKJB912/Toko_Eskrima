<?php
include('db.php'); // Ensure this line is present

$query_grafik = "
    SELECT m.Nama_Menu, DATE(p.Tanggal_Pesanan) AS Tanggal, SUM(dp.Jumlah) AS Total_Jumlah
    FROM Detail_Pesanan dp
    JOIN Menu m ON dp.ID_Menu = m.ID_Menu
    JOIN Pesanan p ON dp.ID_Pesanan = p.ID_Pesanan
    GROUP BY m.Nama_Menu, DATE(p.Tanggal_Pesanan)
    ORDER BY DATE(p.Tanggal_Pesanan) ASC, m.Nama_Menu
";

$result_grafik = $conn->query($query_grafik);
if (!$result_grafik) {
    die("Query failed: " . $conn->error);
}

$nama_menu = [];
$tanggal = [];
$data_menu = [];

while ($row = $result_grafik->fetch_assoc()) {
    $nama_menu[] = $row['Nama_Menu'];
    $tanggal[] = date('d-m-Y', strtotime($row['Tanggal']));

    if (!isset($data_menu[$row['Nama_Menu']])) {
        $data_menu[$row['Nama_Menu']] = [];
    }

    // Tambahkan jumlah penjualan untuk menu dan tanggal tertentu
    $data_menu[$row['Nama_Menu']][] = $row['Total_Jumlah'];
}

// Mengambil tanggal unik untuk labels pada grafik
$labels = array_unique($tanggal);
sort($labels); // Urutkan tanggal

$datasets = [];

foreach ($data_menu as $menu => $penjualan) {
    // Jika ada tanggal yang tidak ada penjualannya, isi dengan 0
    $penjualan_data = [];
    foreach ($labels as $label) {
        $index = array_search($label, $tanggal);
        $penjualan_data[] = isset($penjualan[$index]) ? $penjualan[$index] : 0;
    }

    $datasets[] = [
        'label' => $menu,
        'data' => $penjualan_data,
        'fill' => false,
        'borderColor' => '#' . dechex(rand(0, 255)) . dechex(rand(0, 255)) . dechex(rand(0, 255)),
        'tension' => 0.1,
    ];
}
?>
