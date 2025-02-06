<h3>Tambah Menu</h3>
<form action="index.php" method="POST">
    <label for="nama_menu">Nama Menu:</label>
    <input type="text" name="nama_menu" id="nama_menu" required>
    
    <label for="harga">Harga:</label>
    <input type="number" name="harga" id="harga" required>
    
    <button type="submit" name="submit_menu">Tambah Menu</button>
</form>

<h2>Update Menu</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Action</th>
    </tr>
    <?php
    $query_menu = "SELECT * FROM Menu";
    $result_menu = $conn->query($query_menu);
    while ($row = $result_menu->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Nama_Menu'] . "</td>";
        echo "<td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>";
        echo "<td>
                <a href='#update_menu_" . $row['ID_Menu'] . "'>Update</a> | 
                <a href='?delete&id=" . $row['ID_Menu'] . "&table=menu' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Hapus</a>
              </td>";
        echo "</tr>";

        // Update Form for each menu item
        echo "<tr id='update_menu_" . $row['ID_Menu'] . "' class='update-form' style='display:none;'>
                <form action='index.php' method='POST'>
                    <td><input type='text' name='nama_menu' value='" . htmlspecialchars($row['Nama_Menu']) . "' required></td>
                    <td><input type='number' name='harga' value='" . htmlspecialchars($row['Harga']) . "' required></td>
                    <td>
                        <input type='hidden' name='id_menu' value='" . htmlspecialchars($row['ID_Menu']) . "'>
                        <button type='submit' name='update_menu'>Update</button>
                    </td>
                </form>
              </tr>";
    }
    ?>
</table>