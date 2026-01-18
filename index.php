<?php
// Deklarasi strict types
declare(strict_types=1);

// Panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// Panggil file "functions.php" untuk membuat format tanggal indonesia
require_once "helper/functions.php";
?>

<!-- Aplikasi CRUD dengan PHP 8, MySQL 8, Bootstrap 5, dan Vanilla JS
**********************************************************************
* Developer   : Indra Styawantoro
* Company     : Pustaka Koding
* Release     : Maret 2023
* Update      : Januari 2026
* Website     : pustakakoding.com
* E-mail      : pustaka.koding@gmail.com
* WhatsApp    : +62-813-7778-3334
-->

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi CRUD dengan PHP 8, MySQL 8, Bootstrap 5, dan Vanilla JS">
    <meta name="author" content="Indra Styawantoro">

    <!-- Title -->
    <title>Aplikasi CRUD dengan PHP 8, MySQL 8, Bootstrap 5, dan Vanilla JS</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" integrity="sha256-GzSkJVLJbxDk36qko2cnawOGiqz/Y8GsQv/jMTUrx1Q=" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="d-flex flex-column h-100">
    <!-- Header -->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-primary shadow">
            <div class="container">
                <span class="navbar-brand d-flex align-items-center text-white">
                    <i class="fa-solid fa-laptop-code fs-4 me-3"></i>
                    <span>
                        Aplikasi CRUD 
                        <span class="d-none d-md-inline">dengan PHP 8, MySQL 8, Bootstrap 5, dan Vanilla JS</span>
                    </span>
                </span>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-shrink-0">
        <div class="container pt-5">
            <?php
            // Pemanggilan file konten sesuai "halaman" yang dipilih
            // Ambil parameter halaman (default: data)
            $halaman = $_GET['halaman'] ?? 'data';

            // Daftar halaman yang diizinkan
            $routes = [
                'data'       => 'tampil_data.php',
                'entri'      => 'form_entri.php',
                'ubah'       => 'form_ubah.php',
                'detail'     => 'tampil_detail.php',
                'pencarian'  => 'tampil_pencarian.php',
            ];

            // Validasi: Cegah Local File Inclusion (LFI)
            if (!array_key_exists($halaman, $routes)) {
                exit('Halaman tidak ditemukan');
            }

            // Include file sesuai halaman
            include $routes[$halaman];
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto bg-white shadow py-4">
        <div class="container">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                &copy; 2026 - <a href="https://pustakakoding.com/" target="_blank" class="text-decoration-none fw-semibold">Pustaka Koding</a>. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js" integrity="sha256-Huqxy3eUcaCwqqk92RwusapTfWlvAasF6p2rxV6FJaE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/id.js" integrity="sha256-cvHCpHmt9EqKfsBeDHOujIlR5wZ8Wy3s90da1L3sGkc=" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/form-validation.js"></script>
    <script src="assets/js/image-upload-validation.js"></script>
</body>

</html>