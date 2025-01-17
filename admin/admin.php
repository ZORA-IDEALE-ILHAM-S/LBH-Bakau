<?php
session_start();
if (!isset($_SESSION['sesi'])) {
    echo "<script> alert('Silakan login terlebih dahulu!'); </script>";
    echo "<meta http-equiv='refresh' content='0; url=../login/index.php'>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ecf0f1;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            text-align: center;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            animation: fadeIn 1s ease-in-out;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 20px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
            padding-left: 30px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .main-content .page {
            display: none;
        }

        #home {
            display: block;
        }

        /* Animasi fadeIn */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        table, th, td {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #555;
            font-size: 18px;
            text-transform: uppercase;
        }

        td {
            font-size: 16px;
        }

        tr:hover {
            background-color: #ecf0f1;
            transform: scale(1.02);
            transition: transform 0.2s ease-in-out;
        }

        /* Button dengan animasi */
        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #3498db;
            transform: scale(1.1);
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            .sidebar {
                left: 0;
                width: 100%;
                height: auto;
                padding: 15px;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="?page=home" id="home-link">Home</a></li>
            <li><a href="?page=pengacara" id="pengacara-link">Pengacara</a></li>
            <li><a href="?page=lokasi" id="lokasi-link">Lokasi</a></li>
            <li><a href="?page=kontak" id="kontak-link">Kontak</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Include Halaman berdasarkan parameter GET -->
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include 'utama.php';
                    break;
                case 'pengacara':
                    include 'pengacara.php';
                    
                    break;
                case 'lokasi':
                    include 'lokasi.php';
                    
                    break;
            
                case 'kontak':
                    include 'kontak.php';
                
                    break;
                default:
                    echo '<h1>Halaman tidak ditemukan!</h1>';
                    break;
            }
        } else {
            // Default Halaman Home
            include 'utama.php';
        }
        ?>
    </div>

</body>
</html>
