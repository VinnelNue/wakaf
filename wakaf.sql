-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2025 at 02:46 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wakaf`
--

-- --------------------------------------------------------

--
-- Table structure for table `ahli_waris`
--

CREATE TABLE `ahli_waris` (
  `id_ahli_waris` int NOT NULL,
  `id_wakif` int NOT NULL,
  `nama_ahlih_waris` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hubungan_keluarga` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_ktp_penerimawar` bigint NOT NULL,
  `nomor_telepon_penerimawak` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_ktp` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `desa_kelurahan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten_kota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `provinsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ahli_waris`
--

INSERT INTO `ahli_waris` (`id_ahli_waris`, `id_wakif`, `nama_ahlih_waris`, `hubungan_keluarga`, `nomor_ktp_penerimawar`, `nomor_telepon_penerimawak`, `alamat_ktp`, `desa_kelurahan`, `kecamatan`, `kabupaten_kota`, `kode_pos`, `provinsi`, `created_at`, `updated_at`) VALUES
(2, 6, 'Anita Januari', 'Istri', 3507186301700002, '08123310678', 'Dusun Krajan 1 no.1 RT/RW 004/002', 'Pucangsongo', 'Pakis', 'Malang', 65154, 'Jawa Timur', '2025-08-04 03:24:49', '2025-08-04 03:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `data_nazir`
--

CREATE TABLE `data_nazir` (
  `id_nazir` int NOT NULL,
  `nama_nazir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_ktp` bigint NOT NULL,
  `tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pekerjaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kewarganegaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `desa` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `provinsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_nazir`
--

INSERT INTO `data_nazir` (`id_nazir`, `nama_nazir`, `nomor_ktp`, `tempat_lahir`, `tanggal_lahir`, `agama`, `pekerjaan`, `jabatan`, `kewarganegaraan`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `kode_pos`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Benny Hendrianto Kumala', 3172022810580003, 'Jakarta', '1958-05-28', 'Islam', 'Karyawan Swasta', 'Nazhir', 'Indonesia', 'Jl Kelapa Tiga, Gg Muhammad No. 39A, RT/RW : 002/006', 'Lenteng Agung', 'Jagakarsa', 'Jakarta Selatan', 12630, 'DKI Jakarta', '2025-08-04 03:24:49', '2025-08-04 03:24:49'),
(2, 'Adijaniwati Utari', 3174076502580001, 'Jakarta', '1958-02-25', 'Islam', '', 'Nazhir', 'Indonesia', 'Jl. Sungai Sambas IX No. 14, RT/RW : 003/005', 'Kramat Pela', 'Kebayoran Baru', 'Jakarta Selatan', 12130, 'DKI Jakarta', '2025-08-04 03:24:49', '2025-08-04 03:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `data_pemberi_infaq`
--

CREATE TABLE `data_pemberi_infaq` (
  `id_pemberi_infaq` int NOT NULL,
  `nama_pemberi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_ktp` bigint NOT NULL,
  `nomor_telepon` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_ktp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `desa_kelurahan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten_kota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `provinsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_penggunaan_infaq`
--

CREATE TABLE `data_penggunaan_infaq` (
  `id_pemanfaatan` int NOT NULL,
  `id_infaq` int NOT NULL,
  `tanggal` date NOT NULL,
  `pengunaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_digunakan` bigint NOT NULL,
  `pelaksana` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kua`
--

CREATE TABLE `kua` (
  `id_kua` int NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kabupaten_kota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `provinsi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kua`
--

INSERT INTO `kua` (`id_kua`, `kecamatan`, `kabupaten_kota`, `kode_pos`, `provinsi`, `alamat`) VALUES
(2, 'Pakis', 'Malang', 65154, 'Jawa Timur', 'Jl. H. Mustofa No.189, Tegalpsangan, Pakiskembar'),
(3, 'Rumbai Pesisir', 'Pekanbaru', 28261, 'Riau', 'Jl. Gabus Raya, No 5');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `posisi` int NOT NULL,
  `Design` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `posisi`, `Design`) VALUES
(1, 'Informasi Wakif', 1, 'Sidebar'),
(4, 'Infaq', 2, 'Treeview'),
(5, 'Ahli waris', 2, 'Sidebar'),
(7, 'nazir', 1, 'Sidebar'),
(8, 'Aset Wakaf Uang', 1, 'Treeview'),
(9, 'Aset wakaf selain uang', 1, 'Treeview'),
(10, 'KUA', 5, 'Sidebar'),
(12, 'Data Penerima aset wakaf', 1, 'Treeview'),
(13, 'Dashboard', 1, 'dashboard'),
(15, 'Setting', 0, 'Sidebar');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int NOT NULL,
  `id_menu` int NOT NULL,
  `nama_modul` varchar(150) NOT NULL,
  `link_menu` text NOT NULL,
  `link_folder` text NOT NULL,
  `posisi` int NOT NULL,
  `icon_menu` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `id_menu`, `nama_modul`, `link_menu`, `link_folder`, `posisi`, `icon_menu`) VALUES
(9, 7, 'Data Nazir', 'index.php?page=data_nazir', 'pages/data_nazir/data_nazir.php', 4, 'fa fa-asterisk'),
(10, 1, 'Wakif', 'index.php?page=wakif', 'pages/wakif/wakif.php', 1, 'fa fa-user'),
(12, 5, 'Ahli Waris', 'index.php?page=ahli_waris', 'pages/ahli_waris/ahli_waris.php', 3, 'fa fa-adjust'),
(13, 4, 'Data pemberi infaq', 'index.php?page=data_pemberi_infaq', 'pages/data_pemberi_infaq/data_pemberi_infaq.php', 1, 'fa fa-user'),
(14, 4, 'Penerimaan infaq', 'index.php?page=penerimaan_infaq', 'pages/penerimaan_infaq/penerimaan_infaq.php', 2, 'fa fa-book'),
(18, 4, 'Data penggunaan infaq', 'index.php?page=data_penggunaan_infaq', 'pages/data_penggunaan_infaq/data_penggunaan_infaq.php', 3, 'fa fa-cart-arrow-down'),
(23, 8, 'Wakaf Uang', 'index.php?page=uang_wakaf', 'pages/uang_wakaf/uang_wakaf.php', 1, 'fa fa-money'),
(24, 8, 'Data pengembangan uang wakaf', 'index.php?page=pengembangan_uang_wakaf', 'pages/pengembangan_uang_wakaf/pengembangan_uang_wakaf.php', 2, 'fa fa-building'),
(25, 8, 'Distribusi aset wakaf', 'index.php?page=pendistribusian_uang_wakaf', 'pages/pendistribusian_uang_wakaf/pendistribusian_uang_wakaf.php', 4, 'fa fa-arrows-h'),
(26, 12, 'Penerima manfaat wakaf', 'index.php?page=penerima_uang_wakaf', 'pages/penerima_uang_wakaf/penerima_uang_wakaf.php', 3, 'fa fa-book'),
(27, 9, 'Wakaf aset tetap', 'index.php?page=wakaf_asettetap', 'pages/wakaf_asettetap/wakaf_asettetap.php', 2, 'fa fa-book'),
(28, 10, 'kua', 'index.php?page=kua', 'pages/kua/kua.php', 1, 'fa fa-bank'),
(29, 9, 'Wakaf aset selain uang', 'index.php?page=wakaf_aset_selainuang', 'pages/wakaf_aset_selainuang/wakaf_aset_selainuang.php', 1, 'fa fa-archive'),
(31, 9, 'Pemanfaatan wakaf aset tetap', 'index.php?page=pemanfaatan_wakaf_asset_tetap', 'pages/pemanfaatan_wakaf_asset_tetap/pemanfaatan_wakaf_asset_tetap.php', 3, 'fa fa-exchange'),
(32, 13, 'dashboard', 'index.php?page=dashboard', 'pages/dashboard/dashboard.php', 1, 'fa fa-dashboard'),
(36, 15, 'Profil', 'index.php?page=setting', 'pages/setting/setting.php', 0, 'fa fa-gear');

-- --------------------------------------------------------

--
-- Table structure for table `pemanfaatan_wakaf_asset_tetap`
--

CREATE TABLE `pemanfaatan_wakaf_asset_tetap` (
  `id_pemanfaatan_wakaf_tetap` int NOT NULL,
  `id_aset_tetap` int NOT NULL,
  `pemanfaatan` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `institusi_pengelola` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `jumlah_hasil_pengembangan` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendistribusian_uang_wakaf`
--

CREATE TABLE `pendistribusian_uang_wakaf` (
  `id_pendistribusian_uangwakaf` int NOT NULL,
  `id_pengembangan__uang_wakaf` int NOT NULL,
  `tanggal` date NOT NULL,
  `id_penerima_manfaat_wakaf` int NOT NULL,
  `besar_manfaat_wakafditerima` bigint NOT NULL,
  `tujuan_pengunaan_wakaf_uang` varchar(50) NOT NULL,
  `petugas_pelaksana` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_infaq`
--

CREATE TABLE `penerimaan_infaq` (
  `id_infaq` int NOT NULL,
  `id_pemberi_infaq` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_infaq_sedekah` bigint NOT NULL,
  `tujuan_penggunaan` varchar(50) NOT NULL,
  `nama_petugas` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerima_uang_wakaf`
--

CREATE TABLE `penerima_uang_wakaf` (
  `id_penerima_manfaat_wakaf` int NOT NULL,
  `nama_penerima` varchar(30) NOT NULL,
  `nama_institusi_penerima` varchar(30) NOT NULL,
  `nomor_ktp` varchar(16) NOT NULL,
  `nomor_telepon` varchar(10) NOT NULL,
  `alamat_ktp` varchar(30) NOT NULL,
  `desa_kelurahan` varchar(20) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `kabupaten_kota` varchar(20) NOT NULL,
  `kode_pos` bigint NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerima_uang_wakaf`
--

INSERT INTO `penerima_uang_wakaf` (`id_penerima_manfaat_wakaf`, `nama_penerima`, `nama_institusi_penerima`, `nomor_ktp`, `nomor_telepon`, `alamat_ktp`, `desa_kelurahan`, `kecamatan`, `kabupaten_kota`, `kode_pos`, `provinsi`, `created_at`, `updated_at`) VALUES
(2, 'Rudi', 'Perorangan', '', '', '', '', '', '', 55678, '', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(3, 'Risman', 'SDIT Pekanbaru', '', '', '', '', '', '', 1234, '', '2025-08-04 03:24:48', '2025-08-04 03:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `pengembangan_uang_wakaf`
--

CREATE TABLE `pengembangan_uang_wakaf` (
  `id_pengembangan__uang_wakaf` int NOT NULL,
  `id_uang_wakaf` int NOT NULL,
  `instrument_pengembangan` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `institusi_pengelola` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_uang` bigint NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `persentase_hasil_pengembangan` decimal(10,4) DEFAULT NULL,
  `jumlah_hasil_perkembangan` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_usr` int NOT NULL,
  `id_user` int NOT NULL,
  `photo_profil` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uang_wakaf`
--

CREATE TABLE `uang_wakaf` (
  `id_uang_wakaf` int NOT NULL,
  `id_wakif` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_uang` bigint NOT NULL,
  `waktu` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bila_muaqot_sampai_tanggal` date DEFAULT NULL,
  `penerima_manfaat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `detail_penerima_manfaat` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_nazir` int NOT NULL,
  `lks_penerima_wakaf_uang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_sertifikat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sertifikat_wakaf_uang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(45) NOT NULL,
  `usernm` varchar(20) NOT NULL,
  `passwd` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `level` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  `token_expired_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `usernm`, `passwd`, `level`, `token`, `last_login`, `token_expired_at`) VALUES
(1, 'Admin', 'Admin1', '$2a$12$/hjyf3aZejashWumrg2wDumFcDIRdKA95GuISh/EE1DLzBNvZ.Qxa', 'admin', 'd08e8adfd509a3491822a72a029211531a616294568c1fbb9d44add94c6a98e6', '2025-09-04 17:21:46', '2025-09-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wakaf_asettetap`
--

CREATE TABLE `wakaf_asettetap` (
  `id_aset_tetap` int NOT NULL,
  `id_wakif` int NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_asset_tetap` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `luas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bila_muaqot_hingga` date DEFAULT NULL,
  `penerima_manfaat` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surat_kepemilikan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_surat_kepemilikan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desa_kelurahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kota_kabupaten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pos` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `provinsi` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_nazir` int NOT NULL,
  `id_kua` int NOT NULL,
  `akte_ikrar_wakaf` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wakaf_aset_selainuang`
--

CREATE TABLE `wakaf_aset_selainuang` (
  `id_wakafselainuang` int NOT NULL,
  `id_wakif` int NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_asset_bergerak` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_nilai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bila_muaqot` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerima_manfaat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail_penerima_manfaat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wakif`
--

CREATE TABLE `wakif` (
  `id_wakif` int NOT NULL,
  `nama_wakif` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_ktp_wakif` bigint NOT NULL,
  `nomor_telepon_wakif` varchar(10) NOT NULL,
  `alamat_kk` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `desa_kelurahan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten_kota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `provinsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wakif`
--

INSERT INTO `wakif` (`id_wakif`, `nama_wakif`, `nomor_ktp_wakif`, `nomor_telepon_wakif`, `alamat_kk`, `desa_kelurahan`, `kecamatan`, `kabupaten_kota`, `kode_pos`, `provinsi`, `created_at`, `updated_at`) VALUES
(3, 'Ediyus Haji Zubir', 1403090408680009, '', 'Komplek Merapi 77, RT/RW 003/003', 'Pematang Pudu', 'Mandau', 'Bengkalis', 28783, 'Riau', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(4, 'Zarius Rusli', 3674053110430002, '', 'Jalan Bintaro Tengah, Bintaro Jaya, RT/RW 004/007', 'Rengas', 'Ciputat Timur', 'Tangerang Selatan', 15444, 'Banten', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(5, 'Benny Hendrianto Kumala', 3172022810580003, '', 'Jl Kelapa Tiga, Gg Muhammad No. 39A, RT/RW : 002/006', 'Lenteng Agung', 'Jagakarsa', 'Jakarta Selatan', 12630, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(6, 'Yong Ardinal', 3507180109670007, '081230249', 'Dusun Krajan 1, No 1, RT/RW 002/004', 'Pucangsongo', 'Pakis', 'Malang', 65154, 'Jawa Timur', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(7, 'Wahono Hardi Sukardjo', 1471032603620001, '', 'Jl Mesjid II No 12, RT/RW 007/005', 'Bendungan Hilir', 'Tanah Abang', 'Jakarta Pusat', 10210, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(8, 'Adijaniwati Utari', 3174076502580001, '', 'Jalan Sungai Sambas IX No 14 RT/RW 003/005', 'Kramat Pela', 'Kebayoran Baru', 'Jakarta Selatan', 12130, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(9, 'Apriyadi', 1471120204640022, '', 'Kemanggisan Ilir VII No 18 A, RT/RW 008/013', 'Palmerah', 'Palmerah', 'Jakarta Barat', 11480, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(10, 'Amri Ismail', 3674031810530002, '', 'Jalan Maleo XVII JE. 3/13 Sektor IX, RT/RW 004/010', 'Pondok Pucung', 'Pondok Aren', 'Tangerang Selatan', 15229, 'Banten', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(11, 'Supriadi Arief', 3674031611480002, '', 'Jalan Bintaro Utama DD 15/1 Sektor 3A, RT/RW 008/010', 'Pondok Karya', 'Pondok Aren', 'Tangerang Selatan', 15425, 'Banten', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(12, 'Lukman Tedji', 317503041560005, '', 'Jalan Pedati Raya 8, RT/RW 014/007', 'Cipinang Cempedak', 'Jatinegara', 'Jakarta Timur', 13340, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(13, 'Arief Yunan', 6471051401580002, '', 'Komplek Citra Green Dago Blok L No. 2, RT/RW 008/001', 'Ciumbuleuit', 'Cidadap', 'Bandung', 40142, 'Jawa Barat', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(15, 'Junison Zaib', 3171081506580003, '', 'Kebayoran Essence H07, Jalan Dharmawangsa VI, RT/RW 005/013', 'Pondok Aren', 'Pondok Aren', 'Tangerang Selatan', 15224, 'Banten', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(16, 'Sadono', 1403092609630002, '', 'Jalan Bona Permai III Blok B6 No. 14, RT/RW 008/006', 'Lebak Bulus', 'Cilandak', 'Jakarta Selatan', 12440, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(17, 'Hervalni', 1471061011630001, '', 'Jalan Tegal Sari Ujung Gang Mekar Sari No 17, RT/RW 001/005', 'Umban Sari', 'Rumbai', 'Pekanbaru', 28265, 'Riau', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(18, 'Zul Hak', 1403090608530002, '', 'Jalan Pengayoman No. 64 A, RT/RW 004/008', 'Tangkerang Utara', 'Bukit Raya', 'Pekanbaru', 28289, 'Riau', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(19, 'Nurwazir', 1403091807570815, '', 'Jalan Kurai No. 03, RT/RW 002/002', 'Parit Antang', 'Aur Birugo Tigo Baleh', 'Bukittinggi', 26132, 'Sumatera Barat', '2025-08-04 03:24:48', '2025-08-04 03:24:48'),
(20, 'Agus Sulaiman Djamil', 3174073003620004, '', 'alan Gandari I Persil 7, RT/RW 003/010', 'Kramat Pela', 'Kebayoran Baru', 'Jakarta Selatan', 12130, 'DKI Jakarta', '2025-08-04 03:24:48', '2025-08-04 03:24:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahli_waris`
--
ALTER TABLE `ahli_waris`
  ADD PRIMARY KEY (`id_ahli_waris`),
  ADD KEY `id_wakif` (`id_wakif`);

--
-- Indexes for table `data_nazir`
--
ALTER TABLE `data_nazir`
  ADD PRIMARY KEY (`id_nazir`);

--
-- Indexes for table `data_pemberi_infaq`
--
ALTER TABLE `data_pemberi_infaq`
  ADD PRIMARY KEY (`id_pemberi_infaq`);

--
-- Indexes for table `data_penggunaan_infaq`
--
ALTER TABLE `data_penggunaan_infaq`
  ADD PRIMARY KEY (`id_pemanfaatan`),
  ADD KEY `id_infaq` (`id_infaq`);

--
-- Indexes for table `kua`
--
ALTER TABLE `kua`
  ADD PRIMARY KEY (`id_kua`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `pemanfaatan_wakaf_asset_tetap`
--
ALTER TABLE `pemanfaatan_wakaf_asset_tetap`
  ADD PRIMARY KEY (`id_pemanfaatan_wakaf_tetap`),
  ADD KEY `id_aset_tetap` (`id_aset_tetap`);

--
-- Indexes for table `pendistribusian_uang_wakaf`
--
ALTER TABLE `pendistribusian_uang_wakaf`
  ADD PRIMARY KEY (`id_pendistribusian_uangwakaf`),
  ADD KEY `id_pengembangan__uang_wakaf` (`id_pengembangan__uang_wakaf`) USING BTREE,
  ADD KEY `id_penerima_manfaat_wakaf` (`id_penerima_manfaat_wakaf`) USING BTREE;

--
-- Indexes for table `penerimaan_infaq`
--
ALTER TABLE `penerimaan_infaq`
  ADD PRIMARY KEY (`id_infaq`),
  ADD KEY `id_pemberi_infaq` (`id_pemberi_infaq`);

--
-- Indexes for table `penerima_uang_wakaf`
--
ALTER TABLE `penerima_uang_wakaf`
  ADD PRIMARY KEY (`id_penerima_manfaat_wakaf`);

--
-- Indexes for table `pengembangan_uang_wakaf`
--
ALTER TABLE `pengembangan_uang_wakaf`
  ADD PRIMARY KEY (`id_pengembangan__uang_wakaf`),
  ADD KEY `id_uang_wakaf` (`id_uang_wakaf`) USING BTREE;

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_usr`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `uang_wakaf`
--
ALTER TABLE `uang_wakaf`
  ADD PRIMARY KEY (`id_uang_wakaf`),
  ADD KEY `id_wakif` (`id_wakif`) USING BTREE,
  ADD KEY `id_nazir` (`id_nazir`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wakaf_asettetap`
--
ALTER TABLE `wakaf_asettetap`
  ADD PRIMARY KEY (`id_aset_tetap`),
  ADD KEY `id_wakif` (`id_wakif`),
  ADD KEY `id_nazir` (`id_nazir`),
  ADD KEY `id_kua` (`id_kua`);

--
-- Indexes for table `wakaf_aset_selainuang`
--
ALTER TABLE `wakaf_aset_selainuang`
  ADD PRIMARY KEY (`id_wakafselainuang`),
  ADD KEY `id_wakif` (`id_wakif`);

--
-- Indexes for table `wakif`
--
ALTER TABLE `wakif`
  ADD PRIMARY KEY (`id_wakif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahli_waris`
--
ALTER TABLE `ahli_waris`
  MODIFY `id_ahli_waris` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_nazir`
--
ALTER TABLE `data_nazir`
  MODIFY `id_nazir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_pemberi_infaq`
--
ALTER TABLE `data_pemberi_infaq`
  MODIFY `id_pemberi_infaq` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_penggunaan_infaq`
--
ALTER TABLE `data_penggunaan_infaq`
  MODIFY `id_pemanfaatan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kua`
--
ALTER TABLE `kua`
  MODIFY `id_kua` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pemanfaatan_wakaf_asset_tetap`
--
ALTER TABLE `pemanfaatan_wakaf_asset_tetap`
  MODIFY `id_pemanfaatan_wakaf_tetap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendistribusian_uang_wakaf`
--
ALTER TABLE `pendistribusian_uang_wakaf`
  MODIFY `id_pendistribusian_uangwakaf` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerimaan_infaq`
--
ALTER TABLE `penerimaan_infaq`
  MODIFY `id_infaq` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerima_uang_wakaf`
--
ALTER TABLE `penerima_uang_wakaf`
  MODIFY `id_penerima_manfaat_wakaf` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengembangan_uang_wakaf`
--
ALTER TABLE `pengembangan_uang_wakaf`
  MODIFY `id_pengembangan__uang_wakaf` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_usr` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uang_wakaf`
--
ALTER TABLE `uang_wakaf`
  MODIFY `id_uang_wakaf` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wakaf_asettetap`
--
ALTER TABLE `wakaf_asettetap`
  MODIFY `id_aset_tetap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wakaf_aset_selainuang`
--
ALTER TABLE `wakaf_aset_selainuang`
  MODIFY `id_wakafselainuang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wakif`
--
ALTER TABLE `wakif`
  MODIFY `id_wakif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ahli_waris`
--
ALTER TABLE `ahli_waris`
  ADD CONSTRAINT `ahli_waris_ibfk_1` FOREIGN KEY (`id_wakif`) REFERENCES `wakif` (`id_wakif`);

--
-- Constraints for table `data_penggunaan_infaq`
--
ALTER TABLE `data_penggunaan_infaq`
  ADD CONSTRAINT `data_penggunaan_infaq_ibfk_1` FOREIGN KEY (`id_infaq`) REFERENCES `penerimaan_infaq` (`id_infaq`);

--
-- Constraints for table `pemanfaatan_wakaf_asset_tetap`
--
ALTER TABLE `pemanfaatan_wakaf_asset_tetap`
  ADD CONSTRAINT `pemanfaatan_wakaf_asset_tetap_ibfk_1` FOREIGN KEY (`id_aset_tetap`) REFERENCES `wakaf_asettetap` (`id_aset_tetap`);

--
-- Constraints for table `pendistribusian_uang_wakaf`
--
ALTER TABLE `pendistribusian_uang_wakaf`
  ADD CONSTRAINT `pendistribusian_uang_wakaf_ibfk_1` FOREIGN KEY (`id_pengembangan__uang_wakaf`) REFERENCES `pengembangan_uang_wakaf` (`id_pengembangan__uang_wakaf`),
  ADD CONSTRAINT `pendistribusian_uang_wakaf_ibfk_2` FOREIGN KEY (`id_penerima_manfaat_wakaf`) REFERENCES `penerima_uang_wakaf` (`id_penerima_manfaat_wakaf`);

--
-- Constraints for table `penerimaan_infaq`
--
ALTER TABLE `penerimaan_infaq`
  ADD CONSTRAINT `penerimaan_infaq_ibfk_1` FOREIGN KEY (`id_pemberi_infaq`) REFERENCES `data_pemberi_infaq` (`id_pemberi_infaq`);

--
-- Constraints for table `pengembangan_uang_wakaf`
--
ALTER TABLE `pengembangan_uang_wakaf`
  ADD CONSTRAINT `pengembangan_uang_wakaf_ibfk_1` FOREIGN KEY (`id_uang_wakaf`) REFERENCES `uang_wakaf` (`id_uang_wakaf`);

--
-- Constraints for table `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `uang_wakaf`
--
ALTER TABLE `uang_wakaf`
  ADD CONSTRAINT `uang_wakaf_ibfk_1` FOREIGN KEY (`id_wakif`) REFERENCES `wakif` (`id_wakif`),
  ADD CONSTRAINT `uang_wakaf_ibfk_2` FOREIGN KEY (`id_nazir`) REFERENCES `data_nazir` (`id_nazir`);

--
-- Constraints for table `wakaf_asettetap`
--
ALTER TABLE `wakaf_asettetap`
  ADD CONSTRAINT `wakaf_asettetap_ibfk_2` FOREIGN KEY (`id_kua`) REFERENCES `kua` (`id_kua`),
  ADD CONSTRAINT `wakaf_asettetap_ibfk_3` FOREIGN KEY (`id_nazir`) REFERENCES `data_nazir` (`id_nazir`),
  ADD CONSTRAINT `wakaf_asettetap_ibfk_4` FOREIGN KEY (`id_wakif`) REFERENCES `wakif` (`id_wakif`);

--
-- Constraints for table `wakaf_aset_selainuang`
--
ALTER TABLE `wakaf_aset_selainuang`
  ADD CONSTRAINT `wakaf_aset_selainuang_ibfk_1` FOREIGN KEY (`id_wakif`) REFERENCES `wakif` (`id_wakif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
