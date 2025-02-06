<h2>Daftar Pesanan</h2>
<table border="1" cellpadding="5">
    <!-- Tabel daftar pesanan -->
    <tr>
        <th>ID Pesanan</th>
        <th>Tanggal Pesanan</th>
        <th>Nama Pelanggan</th>
        <th>Menu</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php
    $result_pesanan = $conn->query("SELECT p.ID_Pesanan, p.Tanggal_Pesanan, pl.Nama_Pelanggan, m.Nama_Menu, dp.Jumlah, dp.Subtotal 
    FROM Pesanan p 
    JOIN Pelanggan pl ON p.ID_Pelanggan = pl.ID_Pelanggan 
    JOIN Detail_Pesanan dp ON p.ID_Pesanan = dp.ID_Pesanan 
    JOIN Menu m ON dp.ID_Menu = m.ID_Menu");

    while ($pesanan = $result_pesanan->fetch_assoc()) {
        echo "<tr>
                <td>" . $pesanan['ID_Pesanan'] . "</td>
                <td>" . $pesanan['Tanggal_Pesanan'] . "</td>
                <td>" . $pesanan['Nama_Pelanggan'] . "</td>
                <td>" . $pesanan['Nama_Menu'] . "</td>
                <td>" . $pesanan['Jumlah'] . "</td>
                <td>Rp " . number_format($pesanan['Subtotal'], 0, ',', '.') . "</td>
                <td>
                    <a href='#update_pesanan_" . $pesanan['ID_Pesanan'] . "'>Update</a> | 
                    <a href='?delete&id=" . $pesanan['ID_Pesanan'] . "&table=pesanan' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Hapus</a>
                </td>
              </tr>";

        // Update Form for each pesanan
        echo "<tr id='update_pesanan_" . $pesanan['ID_Pesanan'] . "' class='update-form' style='display:none;'>
                <form action='index.php' method='POST'>
                    <td><input type='text' name='id_pesanan' value='" . htmlspecialchars($pesanan['ID_Pesanan']) . "' required readonly></td>
                    <td><input type='text' name='tanggal_pesanan' value='" . htmlspecialchars($pesanan['Tanggal_Pesanan']) . "' required></td>
                    <td><input type='text' name='nama_pelanggan' value='" . htmlspecialchars($pesanan['Nama_Pelanggan']) . "' required></td>
                    <td><input type='text' name='nama_menu' value='" . htmlspecialchars($pesanan['Nama_Menu']) . "' required></td>
                    <td><input type='number' name='jumlah' value='" . htmlspecialchars($pesanan['Jumlah']) . "' required></td>
                    <td><input type='number' name='subtotal' value='" . htmlspecialchars($pesanan['Subtotal']) . "' required></td>
                    <td>
                        <button type='submit' name='update_pesanan'>Update</button>
                    </td>
                </form>
              </tr>";
    }
    ?>
</table>

<!-- Form tambah pesanan -->
<h2>Tambah Pesanan</h2>
<form action='index.php' method='POST'>
    <label for='id_pelanggan'>Nama Pelanggan:</label>
    <select name='id_pelanggan' required>
        <?php
        $result_pelanggan = $conn->query("SELECT * FROM Pelanggan");
        while ($pelanggan = $result_pelanggan->fetch_assoc()) {
            echo "<option value='" . $pelanggan['ID_Pelanggan'] . "'>" . $pelanggan['Nama_Pelanggan'] . "</option>";
        }
        ?>
    </select>
    <br>
    <label for='tanggal_pesanan'>Tanggal Pesanan:</label>
    <input type='date' name='tanggal_pesanan' required>
    <br>
    <label for='id_menu'>Menu:</label>
    <select name='id_menu' required>
        <?php
        $result_menu = $conn->query("SELECT * FROM Menu");
        while ($menu = $result_menu->fetch_assoc()) {
            echo "<option value='" . $menu['ID_Menu'] . "'>" . $menu['Nama_Menu'] . "</option>";
        }
        ?>
    </select>
    <br>
    <label for ='jumlah'>Jumlah:</label>
    <input type='number' name='jumlah' required>
    <br>
    <button type='submit' name='tambah_pesanan'>Tambah Pesanan</button>
</form>