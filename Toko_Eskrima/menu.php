<?php
// Menangani Insert Menu
if (isset($_POST['submit_menu'])) {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];

    try {
        $stmt = $conn->prepare("INSERT INTO Menu (Nama_Menu, Harga) VALUES (?, ?)");
        $stmt->bind_param("sd", $nama_menu, $harga);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Menangani Update Menu
if (isset($_POST['update_menu'])) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];

    try {
        $stmt = $conn->prepare("UPDATE Menu SET Nama_Menu = ?, Harga = ? WHERE ID_Menu = ?");
        $stmt->bind_param("sds", $nama_menu, $harga, $id_menu);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
        echo "Menu item updated successfully.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}