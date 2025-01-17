<?php require 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="stylesheet" href="css/stylekontak.css">
</head>
<body>
  <div class="main-container">
    <div class="container">
      <div class="form-container">
        <h2>FORM</h2>
        <!-- Form yang akan mengirim data -->
        <form action="" method="post">
          <input type="text" name="fullname" placeholder="Full Name" required>
          <input type="tel" name="phone" placeholder="No. HP" required pattern="[0-9]{10,15}">
          <input type="email" name="email" placeholder="Email" required>
          <textarea name="message" placeholder="Pesan..." rows="4" required></textarea>
          <button type="submit" name="submit">Kirim</button>
        </form>
      </div>
      <div class="contact-info">
        <h2>CONTACT US</h2>
        <p>Pastikan mengisi form dengan benar agar informasi yang masuk pada email tidak ada kesalahan.</p>
        <center>
          <h3>Kontak</h3>
          <?php
          // Ambil email tujuan dari database
          $sql = "SELECT email FROM kontak LIMIT 1"; // Pastikan tabel `email_tujuan` ada
          $result = $koneksi->query($sql);
          
          if ($result && $result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $displayEmail = $row['email'];
          } else {
              $displayEmail = "info@example.com"; // Email fallback jika tidak ditemukan
          }
          ?>
          <p>Email: <a href="mailto:<?= htmlspecialchars($displayEmail) ?>"><?= htmlspecialchars($displayEmail) ?></a></p>
        </center>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['submit'])) {
      // Data dari form
      $fullname = htmlspecialchars(trim($_POST['fullname']));
      $phone = htmlspecialchars(trim($_POST['phone']));
      $email = htmlspecialchars(trim($_POST['email']));
      $message = htmlspecialchars(trim($_POST['message']));
      
      // Validate email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "<script>alert('Email tidak valid.');</script>";
      } else {
          // Gunakan email tujuan dari database
          $to = $displayEmail;
          $subject = "Pesan dari $fullname";
          
          // Format pesan email
          $body = "Nama: $fullname\n";
          $body .= "No. HP: $phone\n";
          $body .= "Email: $email\n";
          $body .= "Pesan:\n$message\n";
          
          // Header email
          $headers = "From: $email\r\n";
          $headers .= "Reply-To: $email\r\n";
          
          // Kirim email
          if (mail($to, $subject, $body, $headers)) {
              echo "<script>alert('Pesan berhasil dikirim! Terima kasih telah menghubungi kami.');</script>";
          } else {
              echo "<script>alert('Maaf, terjadi kesalahan. Pesan gagal dikirim.');</script>";
          }
      }
  }
  ?>
</body>
</html>
