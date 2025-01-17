<?php
include "../koneksi/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'];
    $spesialisasi = $_POST['spesialisasi'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    // Penanganan upload file
    $foto_profil = null;
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $fileName = basename($_FILES['foto_profil']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $targetFilePath)) {
            $foto_profil = $targetFilePath; // Simpan nama file untuk dimasukkan ke database
        }
    }

    if ($id) {
        // Edit pengacara
        $sql = "UPDATE pengacara SET 
                nama = ?, 
                spesialisasi = ?, 
                nomor_telepon = ?, 
                email = ?, 
                alamat = ?, 
                status = ?" . 
                ($foto_profil ? ", foto_profil = ?" : "") . " 
                WHERE id_pengacara = ?";
        $stmt = $koneksi->prepare($sql);
        
        if ($foto_profil) {
            $stmt->bind_param("sssssssi", $nama, $spesialisasi, $nomor_telepon, $email, $alamat, $status, $foto_profil, $id);
        } else {
            $stmt->bind_param("ssssssi", $nama, $spesialisasi, $nomor_telepon, $email, $alamat, $status, $id);
        }
    } else {
        // Tambah pengacara baru
        $sql = "INSERT INTO pengacara (nama, spesialisasi, nomor_telepon, email, alamat, foto_profil, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssssss", $nama, $spesialisasi, $nomor_telepon, $email, $alamat, $foto_profil, $status);
    }

    if ($stmt->execute()) {
        header("Location: admin.php?page=pengacara");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
?>
