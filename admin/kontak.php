<?php

require '../koneksi/koneksi.php'; // Pastikan koneksi ke database

// Handle form submission
if (isset($_POST['update_email'])) {
    $new_email = htmlspecialchars(trim($_POST['email']));
    if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        // Update email tujuan di database
        $sql = "UPDATE kontak SET email = ? WHERE id = 1";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $new_email);
        if ($stmt->execute()) {
            $message = "Email tujuan berhasil diperbarui.";
        } else {
            $message = "Terjadi kesalahan saat memperbarui email.";
        }
    } else {
        $message = "Email tidak valid.";
    }
}

// Ambil email tujuan saat ini
$sql = "SELECT email FROM kontak WHERE id = 1";
$result = $koneksi->query($sql);
$current_email = $result->num_rows > 0 ? $result->fetch_assoc()['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Kontak</title>
  <link rel="stylesheet" href="css/styleadmin.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #333;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }
    input[type=email] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      color: #721c24;
      background-color: #f8d7da;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Kelola Kontak</h1>
    <?php if (isset($message)) : ?>
      <div class="alert"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="post" action="">
      <div class="form-group">
        <label for="email">Email Tujuan Saat Ini:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($current_email) ?>" required>
      </div>
      <button type="submit" name="update_email" class="btn btn-primary">Perbarui Email</button>
    </form>
  </div>
</body>
</html>
