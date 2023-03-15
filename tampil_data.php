<div class="d-flex flex-column flex-lg-row mt-5 mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Siswa</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://pustakakoding.com/" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?halaman=data" class="text-dark text-decoration-none">Siswa</a></li>
                <li class="breadcrumb-item" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row flex-lg-row-reverse align-items-center mb-5">
    <!-- button entri data -->
    <div class="col-lg-4 col-xl-3">
        <a href="?halaman=entri" class="btn btn-primary rounded-pill float-lg-end py-2 px-4 mb-4 mb-lg-0">
            <i class="fa-solid fa-plus me-2"></i> Entri Siswa
        </a>
    </div>
    <!-- form pencarian -->
    <div class="col-lg-8 col-xl-9">
        <form action="?halaman=pencarian" method="post" class="form-search needs-validation" novalidate>
            <input type="text" name="kata_kunci" class="form-control rounded-pill" placeholder="Cari Siswa ..." autocomplete="off" required>
            <div class="invalid-feedback">Masukan ID atau Nama Siswa yang ingin Anda cari.</div>
        </form>
    </div>
</div>

<?php
// menampilkan pesan sesuai dengan proses yang dijalankan
// jika pesan tersedia
if (isset($_GET['pesan'])) {
    // jika pesan = 1
    if ($_GET['pesan'] == 1) {
        // tampilkan pesan sukses simpan data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data siswa berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // jika pesan = 2
    elseif ($_GET['pesan'] == 2) {
        // tampilkan pesan sukses hapus data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data siswa berhasil diubah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // jika pesan = 3
    elseif ($_GET['pesan'] == 3) {
        // tampilkan pesan sukses hapus data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data siswa berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}
?>

<div class="row mb-5">
    <?php
    /* 
        membatasi jumlah data yang ditampilkan dari database untuk membuat pagination/paginasi
    */
    // cek data "paginasi" pada URL untuk mengetahui paginasi halaman aktif
    // jika data "paginasi" ada, maka paginasi halaman = data "paginasi". jika data "paginasi" tidak ada, maka paginasi halaman = 1
    $paginasi_halaman = (isset($_GET['paginasi'])) ? (int) $_GET['paginasi'] : 1;
    // tentukan jumlah data yang ditampilkan per paginasi halaman
    $batas = 10;
    // tentukan dari data ke berapa yang akan ditampilkan pada paginasi halaman
    $batas_awal = ($paginasi_halaman - 1) * $batas;

    // sql statement untuk menampilkan data dari tabel "tbl_siswa"
    $query = $mysqli->query("SELECT id_siswa, kelas, nama_lengkap, foto_profil FROM tbl_siswa
                             ORDER BY id_siswa DESC LIMIT $batas_awal, $batas")
                             or die('Ada kesalahan pada query tampil data : ' . $mysqli->error);
    // ambil jumlah data hasil query
    $rows = $query->num_rows;

    // cek hasil query
    // jika data siswa ada
    if ($rows <> 0) {
        // ambil data hasil query
        while ($data = $query->fetch_assoc()) { ?>
            <!-- tampilkan data -->
            <div class="p-2">
                <div class="d-flex bg-white rounded-4 shadow-sm">
                    <div class="flex-shrink-0 p-3">
                        <img src="images/<?php echo $data['foto_profil']; ?>" class="border border-2 img-fluid rounded-4" alt="Foto Profil" width="100" height="100">
                    </div>
                    <div class="p-4 flex-grow-1">
                        <h5><?php echo $data['id_siswa']; ?> - <?php echo $data['nama_lengkap']; ?></h5>
                        <p class="text-muted"><?php echo $data['kelas']; ?></p>
                    </div>
                    <div class="p-4">
                        <div class="d-flex flex-column flex-lg-row">
                            <!-- button form detail data -->
                            <a href="?halaman=detail&id=<?php echo $data['id_siswa']; ?>" class="btn btn-primary btn-sm rounded-pill px-3 me-2 mb-2 mb-lg-0"> Detail </a>
                            <!-- button form ubah data -->
                            <a href="?halaman=ubah&id=<?php echo $data['id_siswa']; ?>" class="btn btn-success btn-sm rounded-pill px-3 me-2 mb-2 mb-lg-0"> Ubah </a>
                            <!-- button modal hapus data -->
                            <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $data['id_siswa']; ?>"> Hapus </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal hapus data -->
            <div class="modal fade" id="modalHapus<?php echo $data['id_siswa']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                <i class="fa-regular fa-trash-can me-2"></i> Hapus Data Siswa
                            </h1>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Anda yakin ingin menghapus data siswa?</p>
                            <!-- informasi data yang akan dihapus -->
                            <p class="fw-bold mb-2"><?php echo $data['id_siswa']; ?> <span class="fw-normal">-</span> <?php echo $data['nama_lengkap']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                            <!-- button proses hapus data -->
                            <a href="proses_hapus.php?id=<?php echo $data['id_siswa']; ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="d-flex flex-column flex-xl-row align-items-center mt-4">
            <!-- menampilkan informasi jumlah paginasi halaman dan jumlah data -->
            <div class="flex-grow-1 text-center text-xl-start text-muted mb-3">
                <?php
                // sql statement untuk menampilkan jumlah data pada tabel "tbl_siswa"
                $query = $mysqli->query("SELECT id_siswa FROM tbl_siswa")
                                         or die('Ada kesalahan pada query jumlah data : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_data = $query->num_rows;

                // hitung jumlah paginasi halaman yang tersedia
                $jumlah_paginasi_halaman = ceil($jumlah_data / $batas);

                // cek jumlah data
                // jika data ada
                if ($jumlah_data <> 0) {
                    // tampilkan informasi paginasi halaman aktif dan jumlah paginasi halaman
                    echo "Halaman $paginasi_halaman dari $jumlah_paginasi_halaman";
                }
                ?>

                <span class="mx-2">|</span>

                <?php
                // ambil data awal yang ditampilkan per paginasi halaman
                /* 
                    jika "jumlah_paginasi_halaman" <> "0", maka "data_awal" = "batas_awal" + 1.
                    jika "jumlah_paginasi_halaman" == "0", maka "data_awal" = "batas_awal". 
                */
                $data_awal = ($jumlah_paginasi_halaman <> 0) ? $batas_awal + 1 : $batas_awal;

                // sql statement untuk menampilkan jumlah data pada tabel "tbl_siswa" yang ditampilkan per halaman
                $query = $mysqli->query("SELECT id_siswa FROM tbl_siswa LIMIT $data_awal, $batas")
                                         or die('Ada kesalahan pada query jumlah data per halaman : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_data_per_paginasi_halaman = $query->num_rows;

                // ambil data akhir yang ditampilkan per paginasi halaman
                /* 
                    jika "jumlah_data_per_paginasi_halaman" < "batas", maka "data_akhir" = "data_awal" + "jumlah_data_per_paginasi_halaman".
                    jika "jumlah_data_per_paginasi_halaman" >= "batas", maka "data_akhir" = "batas_awal" + "jumlah_data_per_paginasi_halaman". 
                */
                $data_akhir = ($jumlah_data_per_paginasi_halaman < $batas) ? $data_awal + $jumlah_data_per_paginasi_halaman : $batas_awal + $jumlah_data_per_paginasi_halaman;
                ?>
                <!-- tampilkan informasi jumlah data -->
                Menampilkan <?php echo $data_awal; ?> sampai <?php echo $data_akhir; ?> dari <?php echo $jumlah_data; ?> data
            </div>

            <!-- membuat pagination -->
            <ul class="pagination justify-content-center">
                <!-- button link "<" -->
                <?php
                // jika paginasi halaman <= 1, maka button link "<" tidak aktif
                if ($paginasi_halaman <= '1') { ?>
                    <li class="page-item pagination-pill disabled">
                        <a class="page-link" aria-label="Previous">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                <?php
                }
                // jika paginasi halaman > 1, maka button link "<" aktif
                else { ?>
                    <li class="page-item pagination-pill">
                        <a class="page-link" href="?paginasi=<?php echo $paginasi_halaman - 1; ?>" aria-label="Previous">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                <?php } ?>

                <!-- button link nomor -->
                <?php
                // tentukan jumlah button link nomor yang ditampilkan sebelum dan sesudah link yang aktif
                $jumlah_button = 3;

                // tentukan nilai awal dan nilai akhir yang akan digunakan pada perulangan untuk menampilkan button link nomor
                /* 
                    jika "paginasi_halaman" > "jumlah_button", maka "nomor_awal" = "paginasi_halaman" - "jumlah_button".
                    jika "paginasi_halaman" <= "jumlah_button", maka "nomor_awal" = 1.
                */
                $nomor_awal = ($paginasi_halaman > $jumlah_button) ? $paginasi_halaman - $jumlah_button : 1;

                /* 
                    jika "paginasi_halaman" < ("jumlah_paginasi_halaman" - "jumlah_button"), maka "nomor_akhir" = "paginasi_halaman" + "jumlah_button".
                    jika "paginasi_halaman" >= ("jumlah_paginasi_halaman" - "jumlah_button"), maka "nomor_akhir" = "jumlah_paginasi_halaman". 
                */
                $nomor_akhir = ($paginasi_halaman < ($jumlah_paginasi_halaman - $jumlah_button)) ? $paginasi_halaman + $jumlah_button : $jumlah_paginasi_halaman;

                // lakukan perulangan untuk menampilkan button link nomor sesuai jumlah paginasi halaman
                for ($x = $nomor_awal; $x <= $nomor_akhir; $x++) {
                    // membuat link aktif
                    /* 
                        jika "halaman" sama dengan link aktif, maka tambahkan css class "active"
                        jika "halaman" tidak sama dengan link aktif, maka hilangkan css class "active" 
                    */
                    $link_active = ($paginasi_halaman == $x) ? 'active' : '';
                ?>
                    <li class="page-item pagination-pill <?php echo $link_active; ?>">
                        <a class="page-link" href="?paginasi=<?php echo $x; ?>"><?php echo $x; ?></a>
                    </li>
                <?php } ?>

                <!-- button link ">" -->
                <?php
                // jika "paginasi_halaman" >= "jumlah_paginasi_halaman", maka button link ">" tidak aktif 
                if ($paginasi_halaman >= $jumlah_paginasi_halaman) { ?>
                    <li class="page-item pagination-pill disabled">
                        <a class="page-link" aria-label="Next">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                <?php
                }
                // jika "paginasi_halaman" < "jumlah_paginasi_halaman", maka button link ">" aktif
                else { ?>
                    <li class="page-item pagination-pill">
                        <a class="page-link" href="?paginasi=<?php echo $paginasi_halaman + 1; ?>" aria-label="Next">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php
    }
    // jika data siswa tidak ada
    else { ?>
        <!-- tampilkan pesan data tidak tersedia -->
        <div>Tidak ada data yang tersedia.</div>
    <?php } ?>
</div>
