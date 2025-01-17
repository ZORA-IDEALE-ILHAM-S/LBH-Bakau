<?php
include "../koneksi/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pengacara berdasarkan ID
    $sql = "SELECT id_pengacara, nama, spesialisasi, nomor_telepon, email, alamat, foto_profil, status FROM pengacara WHERE id_pengacara = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mengambil data pengacara
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode([]);
}
?>
