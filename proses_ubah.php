<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// mengecek data hasil submit dari form
if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_siswa      = $mysqli->real_escape_string($_POST['id_siswa']);
    $tanggal       = $mysqli->real_escape_string(trim($_POST['tanggal_daftar']));
    $kelas         = $mysqli->real_escape_string($_POST['kelas']);
    $nama_lengkap  = $mysqli->real_escape_string(trim($_POST['nama_lengkap']));
    $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
    $alamat        = $mysqli->real_escape_string(trim($_POST['alamat']));
    $email         = $mysqli->real_escape_string(trim($_POST['email']));
    $whatsapp      = $mysqli->real_escape_string(trim($_POST['whatsapp']));

    // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d) sebelum disimpan ke database
    $tanggal_daftar = date('Y-m-d', strtotime($tanggal));

    // ambil data file hasil submit dari form
    $nama_file          = $_FILES['foto']['name'];
    $tmp_file           = $_FILES['foto']['tmp_name'];
    $extension          = array_pop(explode(".", $nama_file));
    // enkripsi nama file
    $nama_file_enkripsi = sha1(md5(time() . $nama_file)) . '.' . $extension;
    // tentukan direktori penyimpanan file
    $path               = "images/" . $nama_file_enkripsi;

    // mengecek data foto dari form ubah data
    // jika data foto tidak ada (foto tidak diubah)
    if (empty($nama_file)) {
        // sql statement untuk update data di tabel "tbl_siswa" berdasarkan "id_siswa"
        $update = $mysqli->query("UPDATE tbl_siswa
                                  SET tanggal_daftar='$tanggal_daftar', kelas='$kelas', nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', alamat='$alamat', email='$email', whatsapp='$whatsapp'
                                  WHERE id_siswa='$id_siswa'")
                                  or die('Ada kesalahan pada query update : ' . $mysqli->error);
        // cek query
        // jika proses update berhasil
        if ($update) {
            // alihkan ke halaman data siswa dan tampilkan pesan berhasil ubah data
            header('location: index.php?halaman=data&pesan=2');
        }
    }
    // jika data foto ada (foto diubah)
    else {
        // lakukan proses unggah file
        // jika file berhasil diunggah
        if (move_uploaded_file($tmp_file, $path)) {
            // sql statement untuk update data di tabel "tbl_siswa" berdasarkan "id_siswa"
            $update = $mysqli->query("UPDATE tbl_siswa
                                      SET tanggal_daftar='$tanggal_daftar', kelas='$kelas', nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', alamat='$alamat', email='$email', whatsapp='$whatsapp', foto_profil='$nama_file_enkripsi'
                                      WHERE id_siswa='$id_siswa'")
                                      or die('Ada kesalahan pada query update : ' . $mysqli->error);
            // cek query
            // jika proses update berhasil
            if ($update) {
                // alihkan ke halaman data siswa dan tampilkan pesan berhasil ubah data
                header('location: index.php?halaman=data&pesan=2');
            }
        }
    }
}
