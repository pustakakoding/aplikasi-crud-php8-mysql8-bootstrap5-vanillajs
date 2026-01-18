<?php
// Deklarasi strict types
declare(strict_types=1);
// memulai session 
session_start();

// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// mengecek data GET "id_siswa"
if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_siswa = $mysqli->real_escape_string(trim($_GET['id']));

    // mengecek data foto profil
    // sql statement untuk menampilkan data "foto_profil" dari tabel "tbl_siswa" berdasarkan "id_siswa"
    $query = $mysqli->query("SELECT foto_profil FROM tbl_siswa WHERE id_siswa='$id_siswa'")
                            or die("Ada kesalahan pada query tampil data : {$mysqli->error}");
    // ambil data hasil query
    $data = $query->fetch_assoc();

    // sql statement untuk delete data dari tabel "tbl_siswa" berdasarkan "id_siswa"
    $delete = $mysqli->query("DELETE FROM tbl_siswa WHERE id_siswa='$id_siswa'")
                             or die("Ada kesalahan pada query delete : {$mysqli->error}");

    // hapus file foto dari folder images
    if (file_exists("images/$data[foto_profil]")) {
        unlink("images/$data[foto_profil]");
    }

    // cek query
    // jika proses delete berhasil
    if ($delete) {
        // simpan pesan ke dalam session
        $_SESSION['pesan'] = [
            'status' => 'success',
            'icon'   => '<i class="fa-solid fa-circle-check me-2"></i>',
            'judul'  => 'Sukses!',
            'isi'    => 'Data siswa berhasil dihapus.'
        ];

        // alihkan ke halaman data siswa dan tampilkan pesan
        header('location: index.php?halaman=data');
        exit;
    }
}
