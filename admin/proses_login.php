<?php
include '../koneksi/koneksi.php'; // Pastikan file koneksi terhubung

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Hash password dengan MD5
        $hashed_password = md5($password);

        // Query dengan prepared statement
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Simpan session
            session_start();
            $_SESSION['sesi'] = $user['username'];

            echo "<script> alert('Login berhasil!'); </script>";
            echo "<meta http-equiv='refresh' content='0; url=admin.php'>";
            exit();
        } else {
            echo "<script> alert('Username atau password salah!'); </script>";
        }

        $stmt->close();
    } else {
        echo "<script> alert('Harap isi username dan password!'); </script>";
    }

    echo "<meta http-equiv='refresh' content='0; url=../login/index.php'>";
}
?>
