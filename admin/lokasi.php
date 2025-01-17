<?php
require '../koneksi/koneksi.php'; // Pastikan file ini memuat koneksi ke database

// Variabel pesan untuk feedback
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil lokasi baru dari form
    $lokasi_baru = $_POST['lokasi'] ?? '';

    // Validasi input
    if (!empty($lokasi_baru)) {
        // Query untuk memperbarui lokasi
        $sql = "UPDATE lokasi SET lokasi = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $lokasi_baru);

        if ($stmt->execute()) {
            $message = "Lokasi berhasil diperbarui.";
        } else {
            $message = "Gagal memperbarui lokasi: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Lokasi tidak boleh kosong.";
    }
}

// Ambil lokasi saat ini untuk ditampilkan
$sql = "SELECT lokasi FROM lokasi LIMIT 1";
$result = $koneksi->query($sql);
$current_lokasi = $result && $result->num_rows > 0 ? $result->fetch_assoc()['lokasi'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <title>Admin - Update Lokasi</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .alert {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Ubah Lokasi</h2>
        
        <!-- Tampilkan pesan hasil dari form -->
        <?php if ($message): ?>
            <div class="alert <?= strpos($message, 'berhasil') !== false ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="lokasi">URL Lokasi Peta (Google Maps Embed URL):</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="lokasi" 
                    name="lokasi" 
                    value="<?= htmlspecialchars($current_lokasi) ?>" 
                    required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
