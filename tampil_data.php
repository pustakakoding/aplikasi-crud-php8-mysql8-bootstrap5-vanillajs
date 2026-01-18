<?php
// Deklarasi strict types
declare(strict_types=1);
// memulai session 
session_start();
?>

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
if (isset($_SESSION['pesan'])):
?>
    <div class="alert alert-<?= $_SESSION['pesan']['status']; ?> alert-dismissible fade show mb-4" role="alert">
        <strong><?= $_SESSION['pesan']['icon']; ?><?= $_SESSION['pesan']['judul']; ?></strong>
        <?= $_SESSION['pesan']['isi']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    // hapus pesan setelah ditampilkan
    unset($_SESSION['pesan']);
endif;
?>

<div class="row row-cols-1 row-cols-lg-2 g-4">
<?php
// Konfigurasi pagination
const ITEMS_PER_PAGE = 10;
const PAGINATION_LINKS = 3;

// ambil data paginasi halaman dari URL, jika tidak ada set ke 1
$paginasi_halaman = filter_input(
    INPUT_GET,
    'paginasi',
    FILTER_VALIDATE_INT,
    ['options' => ['default' => 1, 'min_range' => 1]]
) ?: 1;

// tentukan batas data yang ditampilkan per paginasi halaman
$batas = ITEMS_PER_PAGE;
// hitung batas awal data yang ditampilkan
$batas_awal = ($paginasi_halaman - 1) * $batas;

// sql statement untuk menampilkan data dari tabel "tbl_siswa"
$query = $mysqli->query("SELECT id_siswa, kelas, nama_lengkap, foto_profil FROM tbl_siswa
                        ORDER BY id_siswa DESC LIMIT $batas OFFSET $batas_awal")
                        or die("Ada kesalahan pada query tampil data : {$mysqli->error}");
// ambil jumlah data hasil query
$rows = $query->num_rows;

// cek hasil query
// jika data siswa ada
if ($rows <> 0) {
    // ambil data hasil query
    while ($data = $query->fetch_assoc()) { ?>
        <!-- tampilkan data -->
        <div class="col">
            <div class="d-flex flex-column flex-sm-row bg-white rounded-4 shadow-sm">
                <div class="flex-shrink-0 text-center text-sm-start p-3">
                    <img src="images/<?= basename($data['foto_profil']) ?>" class="border border-2 img-fluid rounded-4" alt="Foto Profil" width="135" height="135" loading="lazy">
                </div>
                <div class="flex-grow-1 p-4">
                    <div class="text-center text-sm-start mb-4">
                        <h5><?= $data['id_siswa'] ?> - <?= $data['nama_lengkap'] ?></h5>
                        <p class="text-muted"><?= $data['kelas'] ?></p>
                    </div>
                    <div class="d-flex justify-content-center justify-content-sm-start gap-2">
                        <!-- button form detail data -->
                        <a href="?halaman=detail&id=<?= $data['id_siswa'] ?>" class="btn btn-primary btn-sm rounded-pill px-3"> Detail </a>
                        <!-- button form ubah data -->
                        <a href="?halaman=ubah&id=<?= $data['id_siswa'] ?>" class="btn btn-success btn-sm rounded-pill px-3"> Ubah </a>
                        <!-- button modal hapus data -->
                        <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id_siswa'] ?>"> Hapus </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal hapus data -->
        <div class="modal fade" id="modalHapus<?= $data['id_siswa'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
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
                        <p class="fw-bold mb-2"><?= $data['id_siswa'] ?> <span class="fw-normal">-</span> <?= $data['nama_lengkap'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <!-- button proses hapus data -->
                        <a href="proses_hapus.php?id=<?= $data['id_siswa'] ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="d-flex flex-column flex-xl-row align-items-center mt-4 mb-5">
    <!-- menampilkan informasi jumlah paginasi halaman dan jumlah data -->
    <div class="flex-grow-1 text-center text-xl-start text-muted mb-3">
        <?php
        // sql statement untuk menampilkan jumlah data pada tabel "tbl_siswa"
        $query = $mysqli->query("SELECT COUNT(*) as total FROM tbl_siswa")
                                or die('Ada kesalahan pada query jumlah data : ' . mysqli_error($mysqli));
        // ambil data hasil query
        $data = $query->fetch_assoc();
        // simpan total data ke variabel
        $total_data = $data['total'];

        // hitung jumlah paginasi halaman yang tersedia
        $jumlah_paginasi_halaman = (int) ceil($total_data / $batas);

        // cek jumlah data
        // jika data ada
        if ($total_data <> 0) {
            // tampilkan informasi paginasi halaman
            echo "Halaman $paginasi_halaman dari $jumlah_paginasi_halaman";
        }
        ?>

        <span class="mx-2">|</span>

        <?php
        // ambil data awal dan data akhir yang ditampilkan per paginasi halaman
        $data_awal = max(1, $batas_awal + 1);
        $data_akhir = min($batas_awal + $batas, $total_data);
        ?>
        <!-- tampilkan informasi jumlah data -->
        Menampilkan <?= $data_awal ?> sampai <?= $data_akhir ?> dari <?= $total_data ?> data
    </div>

    <!-- membuat pagination link -->
    <ul class="pagination justify-content-center">
        <!-- previous button -->
        <li class="page-item pagination-pill <?= $paginasi_halaman <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?paginasi=<?= $paginasi_halaman - 1 ?>" aria-label="Previous">
                <i class="fa-solid fa-angle-left"></i>
            </a>
        </li>

        <?php
        // menentukan nomor awal dan nomor akhir untuk link paginasi
        $nomor_awal = max(1, $paginasi_halaman - PAGINATION_LINKS);
        $nomor_akhir = min($jumlah_paginasi_halaman, $paginasi_halaman + PAGINATION_LINKS);

        // nomor paginasi link
        for ($x = $nomor_awal; $x <= $nomor_akhir; $x++) {
            $is_active = $paginasi_halaman === $x;
        ?>
            <li class="page-item pagination-pill <?= $is_active ? 'active' : '' ?>">
                <a class="page-link" href="?paginasi=<?= $x ?>"><?= $x ?></a>
            </li>
        <?php } ?>

        <!-- next button -->
        <li class="page-item pagination-pill <?= $paginasi_halaman >= $jumlah_paginasi_halaman ? 'disabled' : '' ?>">
            <a class="page-link me-0" href="?paginasi=<?= $paginasi_halaman + 1 ?>" aria-label="Next">
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </li>
    </ul>
</div>
<?php
}
// jika data siswa tidak ada
else { ?>
    <!-- tampilkan pesan data tidak tersedia -->
    <div>Tidak ada data yang tersedia.</div>
<?php } ?>