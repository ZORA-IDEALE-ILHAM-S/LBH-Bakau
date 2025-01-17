<?php
include "../koneksi/koneksi.php";

// Periksa apakah ada parameter id
if (isset($_GET['id'])) {
    $id_pengacara = $_GET['id'];

    // Ambil data pengacara berdasarkan ID
    $sql = "SELECT * FROM pengacara WHERE id_pengacara = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('i', $id_pengacara);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika pengacara ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Pengacara tidak ditemukan.";
        exit;
    }

    // Proses pengeditan data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $spesialisasi = $_POST['spesialisasi'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $status = $_POST['status'];

        // Update data pengacara
        $update_sql = "UPDATE pengacara SET nama = ?, spesialisasi = ?, nomor_telepon = ?, email = ?, alamat = ?, status = ? WHERE id_pengacara = ?";
        $update_stmt = $koneksi->prepare($update_sql);
        $update_stmt->bind_param('ssssssi', $nama, $spesialisasi, $nomor_telepon, $email, $alamat, $status, $id_pengacara);
        $update_stmt->execute();

        // Redirect ke halaman daftar pengacara setelah sukses
        header("Location: dashboard.php?page=pengacara");
        exit();
    }
} else {
    echo "ID pengacara tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengacara</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Pengacara</h1>
    <form action="edit.php?id=<?php echo $id_pengacara; ?>" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
        
        <label for="spesialisasi">Spesialisasi:</label>
        <input type="text" name="spesialisasi" id="spesialisasi" value="<?php echo htmlspecialchars($row['spesialisasi']); ?>" required>
        
        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?php echo htmlspecialchars($row['nomor_telepon']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required><?php echo htmlspecialchars($row['alamat']); ?></textarea>
        
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Aktif" <?php echo $row['status'] == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
            <option value="Nonaktif" <?php echo $row['status'] == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
        </select>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
