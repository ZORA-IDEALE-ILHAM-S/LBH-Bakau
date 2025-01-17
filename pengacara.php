<?php
require 'nav.php';
require 'koneksi/koneksi.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>DAFTAR PENGACARA</title>
    <link rel="stylesheet" href="css/stylepenga.css">
    <style>
      /* Styling modal untuk tampilan lebih menarik */
      .modal-content {
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      }

      .modal-header {
        background-color: #007bff;
        color: white;
        text-align: center; /* Menengahkan teks di header */
        width: 100%;
      }

      .modal-footer {
        border-top: 1px solid #007bff;
      }

      .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
      }

      .card-img-top {
        border-radius: 10px;
        height: 200px;
        object-fit: cover;
      }

      /* Menambahkan penataan untuk teks di dalam modal */
      .modal-body {
        display: flex;
        flex-direction: column;
        align-items: center; /* Menengahkan semua teks secara horizontal */
        justify-content: center; /* Menengahkan teks secara vertikal */
        text-align: justify; /* Membuat teks rata kiri-kanan */
      }

      .modal-body p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 10px;
      }

      .modal-body img {
        border-radius: 10px;
        margin-bottom: 20px;
      }

      .modal-footer .btn-secondary {
        text-align: center;
        width: 100%; /* Membuat tombol lebih lebar */
      }
    </style>
  </head>
  <body>
    <div class="container">
      <center>
        <h1>DAFTAR PENGACARA</h1>
      </center>

      <div class="row mt-4">
        <?php
        // Query untuk mengambil data pengacara dari database
        $sql = "SELECT id_pengacara, nama, spesialisasi, nomor_telepon, email, alamat, foto_profil FROM pengacara";
        $result = $koneksi->query($sql);

        // Periksa apakah data ditemukan
        if ($result->num_rows > 0) {
          // Loop melalui setiap data pengacara
          while ($row = $result->fetch_assoc()) {
            echo '
            <div class="col-md-3 mb-4">
              <div class="card" data-toggle="modal" data-target="#detailModal" data-id="' . $row["id_pengacara"] . '" data-nama="' . $row["nama"] . '" data-spesialisasi="' . $row["spesialisasi"] . '" data-telepon="' . $row["nomor_telepon"] . '" data-email="' . $row["email"] . '" data-alamat="' . $row["alamat"] . '" data-foto="' . $row["foto_profil"] . '">
                <img class="card-img-top" src="uploads/' . $row["foto_profil"] . '" alt="Foto ' . $row["nama"] . '">
                <div class="card-body">
                  <h5>' . strtoupper($row["nama"]) . '</h5>
                </div>
              </div>
            </div>
            ';
          }
        } else {
          echo '<p class="text-center">Tidak ada data pengacara yang tersedia.</p>';
        }

        // Tutup koneksi
        $koneksi->close();
        ?>
      </div>

      <!-- Modal Detail Pengacara -->
      <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel">Detail Pengacara</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img id="modal-foto" src="" alt="Foto Profil" class="img-fluid mb-3" />
              <p><strong>Nama:</strong> <span id="modal-nama"></span></p>
              <p><strong>Spesialisasi:</strong> <span id="modal-spesialisasi"></span></p>
              <p><strong>Nomor Telepon:</strong> <span id="modal-telepon"></span></p>
              <p><strong>Email:</strong> <span id="modal-email"></span></p>
              <p><strong>Alamat:</strong> <span id="modal-alamat"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9QKtv3Rn7W3mgPxhU9/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      // Script untuk mengisi data di modal saat card di klik
      $('#detailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var id = button.data('id');
        var nama = button.data('nama');
        var spesialisasi = button.data('spesialisasi');
        var telepon = button.data('telepon');
        var email = button.data('email');
        var alamat = button.data('alamat');
        var foto = button.data('foto');

        // Isi data ke dalam modal
        var modal = $(this);
        modal.find('#modal-nama').text(nama);
        modal.find('#modal-spesialisasi').text(spesialisasi);
        modal.find('#modal-telepon').text(telepon);
        modal.find('#modal-email').text(email);
        modal.find('#modal-alamat').text(alamat);
        modal.find('#modal-foto').attr('src', 'uploads/' + foto); // Update path foto
      });
    </script>
  </body>
</html>
