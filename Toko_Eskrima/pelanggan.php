<?php
// Menangani Insert Pelanggan
if (isset($_POST['submit_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    try {
        $stmt = $conn->prepare("INSERT INTO Pelanggan (ID_Pelanggan, Nama_Pelanggan, No_Telepon, Alamat) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_pelanggan, $nama_pelanggan, $no_telepon, $alamat);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
        echo "Pelanggan berhasil ditambahkan.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Menangani Update Pelanggan
if (isset($_POST['update_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    try {
        $stmt = $conn->prepare("UPDATE Pelanggan SET Nama_Pelanggan = ?, No_Telepon = ?, Alamat = ? WHERE ID_Pelanggan = ?");
        $stmt->bind_param("sssi", $nama_pelanggan, $no_telepon, $alamat, $id_pelanggan);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
        echo "Pelanggan berhasil diperbarui.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Menangani Update Pelanggan
if (isset($_POST['update_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    try {
        $stmt = $conn->prepare("UPDATE Pelanggan SET Nama_Pelanggan = ?, No_Telepon = ?, Alamat = ? WHERE ID_Pelanggan = ?");
        $stmt->bind_param("sssi", $nama_pelanggan, $no_telepon, $alamat, $id_pelanggan);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
        echo "Pelanggan berhasil diperbarui.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Menangani Delete Pelanggan
if (isset($_GET['delete']) && isset($_GET['id']) && $_GET['table'] == 'pelanggan') {
    $id = $_GET['id'];
    $conn->begin_transaction();

    try {
        // Cek apakah pelanggan memiliki pesanan terkait
        $check_query = "SELECT COUNT(*) FROM Pesanan WHERE ID_Pelanggan = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("i", $id);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            echo "Tidak dapat menghapus pelanggan ini karena ada pesanan terkait.";
        } else {
            // Hapus pelanggan
            $stmt = $conn->prepare("DELETE FROM Pelanggan WHERE ID_Pelanggan = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $conn->commit ();
            echo "Pelanggan berhasil dihapus.";
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}