<?php
require 'nav.php';


// Query untuk mengambil data iframe dari database
$sql = "SELECT lokasi FROM lokasi";  // Sesuaikan query dengan ID atau kriteria lainnya
$result = $koneksi->query($sql);
$iframeCode = null;

// Ambil data iframe jika tersedia
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $iframeCode = $row['lokasi'];  // Kolom 'lokasi' berisi kode HTML iframe
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/stylepeta.css">
  <title>Lokasi</title>
</head>
<body>

  <!-- Kontainer utama untuk menempatkan card di tengah -->
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Kantor Yayasan LBH Laporo Bakau Papua Barat</h5>
      </div>
      <!-- Peta -->
      <div class="map-container">
        <?php if ($iframeCode): ?>
          <!-- Menampilkan iframe dari database -->
          <?= $iframeCode ?>  <!-- Menampilkan seluruh kode iframe dari database -->
        <?php else: ?>
          <p class="text-danger">Lokasi tidak tersedia.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- JavaScript untuk Bootstrap (Optional jika ada fitur interaktif) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9QKtv3Rn7W3mgPxhU9/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
