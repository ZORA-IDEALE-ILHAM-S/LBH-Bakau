<?php
include "../koneksi/koneksi.php";
$pth="admin.php";
// Cek jika ID pengacara dikirimkan
if (isset($_GET['id'])) {
    $id_pengacara = $_GET['id'];

    // Query untuk menghapus data pengacara berdasarkan ID
    $sql = "DELETE FROM pengacara WHERE id_pengacara = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_pengacara);

    if ($stmt->execute()) {
        echo "Data pengacara berhasil dihapus!";
        header("Location: $pth?page=pengacara"); // Kembali ke daftar pengacara setelah hapus
    } else {
        echo "Gagal menghapus data pengacara!";
    }
} else {
    echo "ID pengacara tidak valid!";
    exit();
}
?>
