-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Mar 2023 pada 12.43
-- Versi server: 8.0.30
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crud_php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` varchar(8) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `whatsapp` varchar(13) NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `tanggal_daftar`, `kelas`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `email`, `whatsapp`, `foto_profil`) VALUES
('ID-00001', '2023-03-01', 'Web Development', 'Indra Styawantoro', 'Laki-laki', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'indra.styawantoro@gmail.com', '081377783334', 'c6a2a061d50317f437ba389a349f19e1d65897f3.jpg'),
('ID-00002', '2023-03-03', 'Web Design', 'Lindsay Spice', 'Perempuan', 'Kedaton, Kota Bandar Lampung, Lampung', 'lindsay.spice@gmail.com', '0895881122441', 'b5c388ea770724501edcabfe10c225339ba0e050.png'),
('ID-00003', '2023-03-03', 'Digital Marketing', 'Lynda Marquez', 'Perempuan', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'lynda.marquez@gmail.com', '0898557766889', 'bf754465bdf84f1f5e23e75d4c29e1b9b4b5c37f.png'),
('ID-00004', '2023-03-07', 'Web Design', 'James Doe', 'Laki-laki', 'Rajabasa, Kota Bandar Lampung, Lampung', 'james.doe@gmail.com', '082380905643', '587a38071d566578a39912e6dd71145ae708bb80.png'),
('ID-00005', '2023-03-11', 'Web Development', 'Mark Parker', 'Laki-laki', 'Kedaton, Kota Bandar Lampung, Lampung', 'mark.parker@gmail.com', '082123459876', '4dc0073f39fdb56fc5d64f4dc41329ea4218e30e.png'),
('ID-00006', '2023-03-13', 'Web Development', 'Frank Gibson', 'Laki-laki', 'Kemiling, Kota Bandar Lampung, Lampung', 'frank.gibson@gmail.com', '081379793535', '3b2841799de6fbf02a1c5f8225d5578d6279520c.png'),
('ID-00007', '2023-03-15', 'Digital Marketing', 'Ashlyn Jordan', 'Perempuan', 'Langkapura, Kota Bandar Lampung, Lampung', 'ashlyn.jordan@gmail.com', '081381195335', 'c6dc27673e8518b9c751bdf9a4094b0afe23107f.jpg'),
('ID-00008', '2023-03-15', 'Web Development', 'Patric Green', 'Laki-laki', 'Way Halim, Kota Bandar Lampung, Lampung', 'patric.green@gmail.com', '081366782234', '57de309cdc6eadddca798ba752f56197a974cf3d.png'),
('ID-00009', '2023-03-17', 'Mobile Development', 'Jeffery Riley', 'Laki-laki', 'Labuhan Ratu, Kota Bandar Lampung, Lampung', 'jeffery.riley@gmail.com', '081376891324', 'd6e6faf65717c420cd732445727738907eba58cd.png'),
('ID-00010', '2023-03-17', 'Data Analysis', 'Alice Doe', 'Perempuan', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'alice.doe@gmail.com', '082377883344', 'ea2612ffe3894d7c0ede840bfb31672583f71e7c.png'),
('ID-00011', '2023-03-21', 'Data Analysis', 'Jonathan Smart', 'Laki-laki', 'Kedaton, Kota Bandar Lampung, Lampung', 'jonathan.smart@gmail.com', '082373378448', '30357ff150897ccca11e26525d2843fcf1b91622.png'),
('ID-00012', '2023-03-23', 'Mobile Development', 'Mike Brown', 'Laki-laki', 'Rajabasa, Kota Bandar Lampung, Lampung', 'mike.brown@gmail.com', '082188669988', '5a8e7999a10b7e132c35b5c5de14f746df87860c.png'),
('ID-00013', '2023-03-23', 'Web Design', 'Pauline Smith', 'Perempuan', 'Teluk Betung, Kota Bandar Lampung, Lampung', 'pauline.smith@gmail.com', '085669919779', '0363ad161bcde3b53b8cd61721151fd7befd7faf.png'),
('ID-00014', '2023-03-23', 'Game Development', 'Ronnie Blake', 'Laki-laki', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'ronnie.blake@gmail.com', '082173775544', '12e8ad69d2dedf8f335cc77ab0de4d369c7304ce.png'),
('ID-00015', '2023-03-25', 'Data Analysis', 'Marsha Singer', 'Perempuan', 'Teluk Betung, Kota Bandar Lampung, Lampung', 'marsha.singer@gmail.com', '085758857778', 'ace08b0c38be78753e75cc347d1a3843f1405408.png'),
('ID-00016', '2023-03-27', 'Web Development', 'Manver Jacobson', 'Laki-laki', 'Rajabasa, Kota Bandar Lampung, Lampung', 'manver.jacobson@gmail.com', '082189897676', 'a1cbe2bca37482a9a2948a4f69cbf8ee8ebd2dfc.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
