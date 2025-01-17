<?php
include "../koneksi/koneksi.php";

// Query untuk mengambil data pengacara
$sql = "SELECT id_pengacara, nama, spesialisasi, nomor_telepon, email, alamat, foto_profil, status FROM pengacara";
$result = $koneksi->query($sql);
?>

<h1>Daftar Pengacara</h1>

<!-- Tombol Tambah Pengacara -->
<button id="tambah-pengacara-btn" class="btn-tambah">Tambah Pengacara</button>

<table>
    <tr>
        <th>Nama</th>
        <th>Spesialisasi</th>
        <th>Nomor Telepon</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Foto Profil</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php
    // Memeriksa apakah ada data
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['spesialisasi']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nomor_telepon']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td><img src='../uploads/" . htmlspecialchars($row['foto_profil']) . "' alt='Foto Profil' width='50'></td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>
                    <button class='edit-btn' data-id='" . $row['id_pengacara'] . "'>Edit</button>
                    <button> <a href='hapus.php?id=" . $row['id_pengacara'] . "' class='hapus-btn' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pengacara ini?');\">Hapus</a></button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Tidak ada data pengacara ditemukan.</td></tr>";
    }

    // Menutup koneksi
    $koneksi->close();
    ?>
</table>

<!-- Modal untuk Tambah/Edit Pengacara -->
<div id="tambah-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" id="close-modal">&times;</span>
        <h2 id="modal-title">Tambah Pengacara</h2>
        <form id="form-pengacara" action="proses_tambah_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id_pengacara">

            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" name="spesialisasi" id="spesialisasi" required>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" required></textarea>

            <label for="foto_profil">Foto Profil:</label>
            <input type="file" name="foto_profil" id="foto_profil" accept="image/*">

            <!-- Menampilkan foto profil jika ada -->
            <div id="foto-preview">
                <img id="foto-prev-img" src="" alt="Foto Profil" style="max-width: 100px; margin-top: 10px;">
            </div>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>

            <button type="submit" id="btn-submit">Simpan</button>
        </form>
    </div>
</div>

<!-- CSS untuk membuat tampilan form tambah lebih menarik -->
<style>
    /* Styling form dan modal */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
        font-size: 32px;
        color: #333;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #4CAF50;
        color: white;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }

    .btn-tambah {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        font-size: 16px;
    }

    .btn-tambah:hover {
        background-color: #45a049;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        overflow: auto;
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 10px;
        width: 60%;
        max-width: 500px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
    }

    label {
        display: block;
        font-size: 14px;
        margin-top: 10px;
    }

    input, textarea, select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    textarea {
        height: 100px;
    }
    .hapus-btn {
        color: white; /* Warna teks tetap putih */
      
        text-decoration: none; /* Menghilangkan garis bawah pada link */
        display: inline-block; /* Agar link menjadi tombol */
    }

    .hapus-btn:hover {
        background-color: #d32f2f; /* Warna latar belakang saat hover */
    }

    .hapus-btn:active {
        background-color: #b71c1c; /* Warna latar belakang saat tombol diklik */
    }
</style>

<body>

<script>
    // Menangani modal
    const modal = document.getElementById('tambah-modal');
    const closeModal = document.getElementById('close-modal');
    const tambahBtn = document.getElementById('tambah-pengacara-btn');
    const editBtns = document.querySelectorAll('.edit-btn');

    // Tombol untuk membuka modal tambah pengacara
    tambahBtn.addEventListener('click', () => {
        document.getElementById('modal-title').textContent = 'Tambah Pengacara';
        document.getElementById('form-pengacara').reset();
        document.getElementById('foto-preview').style.display = 'none'; // Menyembunyikan preview saat menambah pengacara
        modal.style.display = 'block';
    });

    // Tombol untuk menutup modal
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Jika klik di luar modal, tutup modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Tombol Edit pengacara
    editBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const id = e.target.getAttribute('data-id');  // Ambil ID pengacara dari data-id
            // Ambil data pengacara berdasarkan ID dan isi ke dalam form
            fetch(`get_pengacara.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-title').textContent = 'Edit Pengacara';
                    document.getElementById('id_pengacara').value = data.id_pengacara;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('spesialisasi').value = data.spesialisasi;
                    document.getElementById('nomor_telepon').value = data.nomor_telepon;
                    document.getElementById('email').value = data.email;
                    document.getElementById('alamat').value = data.alamat;
                    document.getElementById('status').value = data.status;
                    
                    // Menampilkan foto profil jika ada
                    const fotoProfil = data.foto_profil ? `../uploads/${data.foto_profil}` : '';
                    if (fotoProfil) {
                        document.getElementById('foto-preview').style.display = 'block';
                        document.getElementById('foto-prev-img').src = fotoProfil;
                    } else {
                        document.getElementById('foto-preview').style.display = 'none';
                    }

                    modal.style.display = 'block';
                })
                .catch(err => {
                    console.error('Error fetching pengacara data:', err);
                });
        });
    });

    // Menangani preview gambar saat memilih foto profil baru
    document.getElementById('foto_profil').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            const previewImg = document.getElementById('foto-prev-img');
            previewImg.src = reader.result;
            document.getElementById('foto-preview').style.display = 'block'; // Menampilkan preview gambar
        };

        if (file) {
            reader.readAsDataURL(file); // Membaca file yang dipilih dan menampilkan gambar
        }
    });
</script>



</body>

</script>
