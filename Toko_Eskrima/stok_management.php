<?php
// Sertakan file koneksi database
require 'db.php'; // Menghubungkan ke database

// Query untuk menampilkan menu dan stok
$sql = "SELECT m.ID_Menu, m.Nama_Menu, s.Jumlah_Stok 
        FROM Menu m
        JOIN Stok s ON m.ID_Menu = s.ID_Menu";
$result = $conn->query($sql);

if (!$result) {
    echo "<p>Error: " . $conn->error . "</p>";
}
?>

<h3>Tambah Stok</h3>
<form action="stok.php" method="POST">
    <label for="id_menu">ID Menu:</label>
    <select name="id_menu" id="id_menu" required>
        <option value="">Pilih Menu</option>
        <?php
        $sql = "SELECT ID_Menu, Nama_Menu FROM Menu";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["ID_Menu"] . "'>" . $row["ID_Menu"] . " - " . $row["Nama_Menu"] . "</option>";
            }
        }
        ?>
    </select>

    <label for="jumlah_tambah">Jumlah Tambah:</label>
    <input type="number" name="jumlah_tambah" id="jumlah_tambah" min="1" required>

    <button type="submit" name="submit_stok">Tambah Stok</button>
</form>

<h2>Menu dan Stok</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID Menu</th>
        <th>Nama Menu</th>
        <th>Jumlah Stok</th>
    </tr>
    <?php
    $sql = "SELECT m.ID_Menu, m.Nama_Menu, s.Jumlah_Stok 
            FROM Menu m
            JOIN Stok s ON m.ID_Menu = s.ID_Menu";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['ID_Menu'] . "</td>
                    <td>" . $row['Nama_Menu'] . "</td>
                    <td>" . $row['Jumlah_Stok'] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Data tidak tersedia.</td></tr>";
    }
    ?>
</table>