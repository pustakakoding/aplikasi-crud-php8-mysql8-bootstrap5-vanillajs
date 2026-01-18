<?php
// Deklarasi strict types
declare(strict_types=1);
// memulai session 
session_start();

// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// mengecek data hasil submit dari form
if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_siswa      = $mysqli->real_escape_string(trim($_POST['id_siswa']));
    $tanggal       = $mysqli->real_escape_string(trim($_POST['tanggal_daftar']));
    $kelas         = $mysqli->real_escape_string(trim($_POST['kelas']));
    $nama_lengkap  = $mysqli->real_escape_string(trim($_POST['nama_lengkap']));
    $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
    $alamat        = $mysqli->real_escape_string(trim($_POST['alamat']));
    $email         = $mysqli->real_escape_string(filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL));
    $whatsapp      = $mysqli->real_escape_string(preg_replace('/[^0-9]/', '', trim($_POST['whatsapp'])));

    // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d) sebelum disimpan ke database
    $tanggal_daftar = date('Y-m-d', strtotime($tanggal));

    // ambil data file hasil submit dari form
    $nama_file = $_FILES['foto']['name'];
    $tmp_file  = $_FILES['foto']['tmp_name'];
    $extension = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    // enkripsi nama file
    $nama_file_enkripsi = bin2hex(random_bytes(16)) . '_' . time() . '.' . $extension;
    // tentukan direktori penyimpanan file
    $path = "images/{$nama_file_enkripsi}";

    // lakukan proses unggah file
    // jika file berhasil diunggah
    if (move_uploaded_file($tmp_file, $path)) {
        // sql statement untuk insert data ke tabel "tbl_siswa"
        $insert = $mysqli->query("INSERT INTO tbl_siswa(id_siswa, tanggal_daftar, kelas, nama_lengkap, jenis_kelamin, alamat, email, whatsapp, foto_profil) 
                                 VALUES('$id_siswa', '$tanggal_daftar', '$kelas', '$nama_lengkap', '$jenis_kelamin', '$alamat', '$email', '$whatsapp', '$nama_file_enkripsi')")
                                 or die("Ada kesalahan pada query insert : {$mysqli->error}");
        // cek query
        // jika proses insert berhasil
        if ($insert) {
            // simpan pesan ke dalam session
            $_SESSION['pesan'] = [
                'status' => 'success',
                'icon'   => '<i class="fa-solid fa-circle-check me-2"></i>',
                'judul'  => 'Sukses!',
                'isi'    => 'Data siswa berhasil disimpan.'
            ];

            // alihkan ke halaman data siswa dan tampilkan pesan
            header('location: index.php?halaman=data');
            exit;
        }
    }
}
