<?php
$query_menu = "SELECT * FROM Menu";
$result_menu = $conn->query($query_menu);
?>
<h2>Daftar Menu</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Nama Menu</th>
        <th>Harga</th>
    </tr>
    <?php
    $query_menu = "SELECT * FROM Menu";
    $result_menu = $conn->query($query_menu);
    while ($row = $result_menu->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Nama_Menu'] . "</td>";
        echo "<td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>";
        echo "</tr>";
    }
    ?>
</table>