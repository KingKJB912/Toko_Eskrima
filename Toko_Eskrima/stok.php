<?php
// Menangani Tambah Stok
if (isset($_POST['submit_stok'])) {
    $id_menu = $_POST['id_menu'];
    $jumlah_tambah = $_POST['jumlah_tambah'];

    try {
        $conn->begin_transaction();
        $sql_update = "UPDATE Stok SET Jumlah_Stok = Jumlah_Stok + ? WHERE ID_Menu = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("is", $jumlah_tambah, $id_menu);

        if ($stmt->execute()) {
            $conn->commit();
            echo "<p>Stok berhasil ditambahkan.</p>";
        } else {
            $conn->rollback();
            echo "<p>Error: " . $stmt->error . "</p>";
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}