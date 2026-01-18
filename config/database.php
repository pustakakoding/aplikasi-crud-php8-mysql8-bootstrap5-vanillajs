<?php
// Deklarasi strict types
declare(strict_types=1);

// Konfigurasi database
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'db_crud_php_mysqli';  

// Error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Koneksi database
    $mysqli = new mysqli(
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME
    );

    // Set charset
    $mysqli->set_charset('utf8mb4');

    // Set timezone (opsional)
    $mysqli->query("SET time_zone = '+07:00'");

} catch (mysqli_sql_exception $e) {
    // Logging error
    error_log($e->getMessage());

    // Hentikan eksekusi dan tampilkan pesan
    die("Koneksi database gagal.");
}