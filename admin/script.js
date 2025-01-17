// Menangani navigasi antar halaman
document.getElementById('home-link').addEventListener('click', function() {
    showPage('home');
});

document.getElementById('pengacara-link').addEventListener('click', function() {
    showPage('pengacara');
});
document.getElementById('lokasi-link').addEventListener('click', function() {
    showPage('lokasi');
});
document.getElementById('kontak-link').addEventListener('click', function() {
    showPage('kontak');
});
// Menangani klik tombol edit
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-btn')) {
        const pengacaraId = event.target.getAttribute('data-id');
        window.location.href = `edit.php?id=${pengacaraId}`;
    }
});

// Menangani klik tombol hapus
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('hapus-btn')) {
        const pengacaraId = event.target.getAttribute('data-id');
        if (confirm('Apakah Anda yakin ingin menghapus pengacara ini?')) {
            fetch(`hapus.php?id=${pengacaraId}`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        alert('Pengacara berhasil dihapus.');
                        location.reload();
                    } else {
                        alert('Gagal menghapus pengacara.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
});

// Fungsi untuk menampilkan halaman yang dipilih
function showPage(page) {
    // Sembunyikan semua halaman
    const pages = document.querySelectorAll('.page');
    pages.forEach(p => p.style.display = 'none');

    // Tampilkan halaman yang dipilih
    document.getElementById(page).style.display = 'block';
}
