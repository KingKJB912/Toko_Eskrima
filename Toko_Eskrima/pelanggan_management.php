<h3>Tambah Pelanggan</h3>
<form action="index.php" method="POST">
    <label for="id_pelanggan">ID Pelanggan:</label>
    <input type="text" name="id_pelanggan" id="id_pelanggan" required>
    
    <label for="nama_pelanggan">Nama Pelanggan:</label>
    <input type="text" name="nama_pelanggan" id="nama_pelanggan" required>
    
    <label for="no_telepon">Nomor Telepon:</label>
    <input type="text" name="no_telepon" id="no_telepon" required>
    
    <label for="alamat">Alamat:</label>
    <input type="text" name="alamat" id="alamat" required>
    
    <button type="submit" name="submit_pelanggan">Tambah Pelanggan</button>
</form>

<h2>Daftar Pelanggan</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Nomor Telepon</th>
        <th>Alamat</th>
        <th>Action</th>
    </tr>
    <?php
    $query_pelanggan = "SELECT * FROM Pelanggan";
    $result_pelanggan = $conn->query($query_pelanggan);
    while ($row = $result_pelanggan->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID_Pelanggan'] . "</td>";
        echo "<td>" . $row['Nama_Pelanggan'] . "</td>";
        echo "<td>" . (isset($row['No_Telepon']) ? $row['No_Telepon'] : '-') . "</td>";
        echo "<td>" . (isset($row['Alamat']) ? $row['Alamat'] : '-') . "</td>";
        echo "<td>
                <a href='#update_pelanggan_" . $row['ID_Pelanggan'] . "'>Update</a> | 
                <a href='?delete&id=" . $row['ID_Pelanggan'] . "&table=pelanggan' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Hapus</a>
              </td>";
        echo "</tr>";

        // Update Form for each pelanggan
        echo "<tr id='update_pelanggan_" . $row['ID_Pelanggan'] . "' class='update-form' style='display:none;'>
                <form action='index.php' method='POST'>
                    <td><input type='text' name='id_pelanggan' value='" . htmlspecialchars($row['ID_Pelanggan']) . "' required readonly></td>
                    <td><input type='text' name='nama_pelanggan' value='" . htmlspecialchars($row['Nama_Pelanggan']) . "' required></td>
                    <td><input type='text' name='no_telepon' value='" . (isset($row['No_Telepon']) ? htmlspecialchars($row['No_Telepon']) : '') . "'></td>
                    <td><input type='text' name='alamat' value='" . (isset($row['Alamat']) ? htmlspecialchars($row['Alamat']) : '') . "'></td>
                    <td>
                        <button type='submit' name='update_pelanggan'>Update</button>
                    </td>
                </form>
              </tr>";
    }
    ?>
</table>
