-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 05:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viepkkco_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `bdb_bumlin`
--

CREATE TABLE `bdb_bumlin` (
  `id` varchar(80) NOT NULL,
  `pos_id` varchar(80) NOT NULL,
  `pos_name` varchar(225) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `desa_name` varchar(225) NOT NULL,
  `kms` varchar(100) DEFAULT NULL,
  `umur` char(5) NOT NULL,
  `kel_dawis` int(12) DEFAULT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `umur_kehamilan` char(5) DEFAULT NULL,
  `hamil_ke` char(5) DEFAULT NULL,
  `pyd_ptdh_fe1` date DEFAULT NULL,
  `pyd_ptdh_fe2` date DEFAULT NULL,
  `pyd_ptdh_fe3` date DEFAULT NULL,
  `pyd_imsi1` date DEFAULT NULL,
  `pyd_imsi2` date DEFAULT NULL,
  `pyd_kapsul_yodium` date DEFAULT NULL,
  `lahir_tanggal` date DEFAULT NULL,
  `lahir_pic` varchar(255) DEFAULT NULL,
  `bayi_berat` double(10,2) NOT NULL DEFAULT 0.00,
  `bayi_meninggal` date DEFAULT NULL,
  `ibu_meninggal` date DEFAULT NULL,
  `ibu_menyusui` char(3) DEFAULT NULL,
  `pyd_resiko` char(3) DEFAULT NULL,
  `bayi_jk` char(1) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `tgl_pendaftaran` date DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bdb_kunjungan_bumlin`
--

CREATE TABLE `bdb_kunjungan_bumlin` (
  `id` varchar(80) NOT NULL,
  `bumlin_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `is_kunjungan` int(10) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bdb_pemeriksaan_bumlin`
--

CREATE TABLE `bdb_pemeriksaan_bumlin` (
  `id` varchar(80) NOT NULL,
  `bumlin_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `tekanan_darah` varchar(200) DEFAULT NULL,
  `berat_badan` double(10,2) NOT NULL DEFAULT 0.00,
  `is_risk` char(1) NOT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blt_balita`
--

CREATE TABLE `blt_balita` (
  `id` varchar(80) NOT NULL,
  `pos_id` varchar(80) NOT NULL,
  `pos_name` varchar(225) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `desa_name` varchar(225) NOT NULL,
  `kms` varchar(100) DEFAULT NULL,
  `nama_bapak` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `tgl_lahir_anak` date DEFAULT NULL,
  `jk_anak` char(1) NOT NULL,
  `kel_dawis` int(12) DEFAULT NULL,
  `tgl_meninggal_anak` date DEFAULT NULL,
  `pyd_syrp_besi_fe1` date DEFAULT NULL,
  `pyd_syrp_besi_fe2` date DEFAULT NULL,
  `pyd_vit_a_bln1` date DEFAULT NULL,
  `pyd_vit_a_bln2` date DEFAULT NULL,
  `pyd_pmt_pemulihan` date DEFAULT NULL,
  `pyd_oralit` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_risk` char(1) NOT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blt_kunjungan_balita`
--

CREATE TABLE `blt_kunjungan_balita` (
  `id` varchar(80) NOT NULL,
  `balita_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `is_kunjungan` int(10) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bml_bumil`
--

CREATE TABLE `bml_bumil` (
  `id` varchar(80) NOT NULL,
  `pos_id` varchar(80) NOT NULL,
  `pos_name` varchar(225) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `desa_name` varchar(225) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_bapak` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nama_bayi` varchar(255) DEFAULT NULL,
  `tgl_lahir_bayi` date DEFAULT NULL,
  `jk_bayi` char(1) NOT NULL,
  `tgl_meninggal_bayi` date DEFAULT NULL,
  `tgl_meninggal_ibu` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_risk` char(1) NOT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bml_kunjungan_bumil`
--

CREATE TABLE `bml_kunjungan_bumil` (
  `id` varchar(80) NOT NULL,
  `bumil_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `is_kunjungan` int(10) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `byi_bayi`
--

CREATE TABLE `byi_bayi` (
  `id` varchar(80) NOT NULL,
  `pos_id` varchar(80) NOT NULL,
  `pos_name` varchar(225) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `desa_name` varchar(225) NOT NULL,
  `kms` varchar(100) DEFAULT NULL,
  `nama_bapak` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `tgl_lahir_bayi` date DEFAULT NULL,
  `jk_bayi` char(1) NOT NULL,
  `bbl` char(2) DEFAULT NULL,
  `kel_dawis` int(12) DEFAULT NULL,
  `tgl_meninggal_bayi` date DEFAULT NULL,
  `pyd_syrp_besi_fe1` date DEFAULT NULL,
  `pyd_syrp_besi_fe2` date DEFAULT NULL,
  `pyd_vit_a_bln1` date DEFAULT NULL,
  `pyd_vit_a_bln2` date DEFAULT NULL,
  `pyd_oralit` date DEFAULT NULL,
  `pyd_bcg` date DEFAULT NULL,
  `pyd_dpt1` date DEFAULT NULL,
  `pyd_dpt2` date DEFAULT NULL,
  `pyd_dpt3` date DEFAULT NULL,
  `pyd_polio1` date DEFAULT NULL,
  `pyd_polio2` date DEFAULT NULL,
  `pyd_polio3` date DEFAULT NULL,
  `pyd_polio4` date DEFAULT NULL,
  `pyd_campak` date DEFAULT NULL,
  `pyd_hepatitis1` date DEFAULT NULL,
  `pyd_hepatitis2` date DEFAULT NULL,
  `pyd_hepatitis3` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_risk` char(1) NOT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `byi_kunjungan_bayi`
--

CREATE TABLE `byi_kunjungan_bayi` (
  `id` varchar(80) NOT NULL,
  `bayi_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `is_kunjungan` int(10) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `byi_penimbangan_bayi`
--

CREATE TABLE `byi_penimbangan_bayi` (
  `id` varchar(80) NOT NULL,
  `bayi_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `tinggi_sebelum` double(10,2) NOT NULL DEFAULT 0.00,
  `berat_sebelum` double(10,2) NOT NULL DEFAULT 0.00,
  `tinggi_sekarang` double(10,2) NOT NULL DEFAULT 0.00,
  `berat_sekarang` double(10,2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `const_month`
--

CREATE TABLE `const_month` (
  `label_id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `const_month`
--

INSERT INTO `const_month` (`label_id`, `name`) VALUES
(1, 'JANUARI'),
(2, 'FEBRUARI'),
(3, 'MARET'),
(4, 'APRIL'),
(5, 'MEI'),
(6, 'JUNI'),
(7, 'JULI'),
(8, 'AGUSTUS'),
(9, 'SEPTEMBER'),
(10, 'OKTOBER'),
(11, 'NOVEMBER'),
(12, 'DESEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `mst_desa`
--

CREATE TABLE `mst_desa` (
  `id` varchar(80) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_desa`
--

INSERT INTO `mst_desa` (`id`, `nama`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `deleted`) VALUES
('6658d090-32fa-11ef-a6e6-74563c9f4db6', 'Desa Konoha', 1, 'admin', '2024-06-25 10:00:00', 'admin', '2024-06-25 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_enum`
--

CREATE TABLE `mst_enum` (
  `id` varchar(80) NOT NULL,
  `enum_group` varchar(255) NOT NULL,
  `enum_name` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_posyandu`
--

CREATE TABLE `pos_posyandu` (
  `id` varchar(80) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_posyandu`
--

INSERT INTO `pos_posyandu` (`id`, `desa_id`, `nama`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `deleted`) VALUES
('8c34feb0-32fa-11ef-a6e6-74563c9f4db6', '6658d090-32fa-11ef-a6e6-74563c9f4db6', 'Posyandu Konoha Pusat', 1, 'admin', '2024-06-25 10:00:00', 'admin', '2024-06-25 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_applications`
--

CREATE TABLE `sys_applications` (
  `id` varchar(80) NOT NULL,
  `app_full_name` varchar(255) NOT NULL,
  `app_sort_name` varchar(255) NOT NULL,
  `app_type` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `build_date` varchar(255) NOT NULL,
  `server_ip` varchar(255) NOT NULL,
  `server_name` varchar(255) NOT NULL,
  `is_active` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0,
  `serial_number` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_applications`
--

INSERT INTO `sys_applications` (`id`, `app_full_name`, `app_sort_name`, `app_type`, `version`, `build_date`, `server_ip`, `server_name`, `is_active`, `created_by`, `created_on`, `updated_by`, `updated_on`, `deleted`, `serial_number`) VALUES
('4d6a7202-32f8-11ef-a6e6-74563c9f4db6', 'Full Application Name', 'AppName', 'Web', '1.0.0', '2024-06-25', '192.168.1.1', 'Server1', 1, 'creator123', '2024-06-25 10:00:00', 'updater123', '2024-06-25 12:00:00', 0, 'xxxxxxxxxxx');

-- --------------------------------------------------------

--
-- Table structure for table `usr_roles`
--

CREATE TABLE `usr_roles` (
  `id` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `is_admin` char(1) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_roles`
--

INSERT INTO `usr_roles` (`id`, `name`, `is_admin`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `deleted`) VALUES
('eccdbd9e-4c84-11ec-802e-089798e691ce', 'Superadmin', '1', 1, 'eccdbd9e-4c84-11ec-802e-089798e691ce', '2024-06-25 10:00:00', 'eccdbd9e-4c84-11ec-802e-089798e691ce', '2024-06-25 12:00:00', 0),
('f104827c-4c84-11ec-802e-089798e691ce', 'Dev', '1', 1, 'eccdbd9e-4c84-11ec-802e-089798e691ce', '2024-06-25 10:00:00', 'eccdbd9e-4c84-11ec-802e-089798e691ce', '2024-06-25 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usr_users`
--

CREATE TABLE `usr_users` (
  `id` varchar(80) NOT NULL,
  `role_id` varchar(80) NOT NULL,
  `pos_id` varchar(80) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_users`
--

INSERT INTO `usr_users` (`id`, `role_id`, `pos_id`, `username`, `nama`, `email`, `password`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `deleted`) VALUES
('07fa5ba2-32fa-11ef-a6e6-74563c9f4db6', 'eccdbd9e-4c84-11ec-802e-089798e691ce', NULL, 'sindang2024', 'Sindang Admin', 'sindang2024@mail.com', '$2y$10$RywNI/BGq1B0ozPAlwW9rOMVB/s5fLgn7L93Gm.eOK8h7KFmeLCTe', 1, 'admin', '2024-06-25 10:00:00', 'admin', '2024-06-25 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wsp_akseptor_wuspus`
--

CREATE TABLE `wsp_akseptor_wuspus` (
  `id` varchar(80) NOT NULL,
  `wuspus_id` varchar(80) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `is_akseptor` int(10) NOT NULL DEFAULT 0,
  `jenis_akseptor` varchar(200) DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wsp_wuspus`
--

CREATE TABLE `wsp_wuspus` (
  `id` varchar(80) NOT NULL,
  `pos_id` varchar(80) NOT NULL,
  `pos_name` varchar(225) NOT NULL,
  `desa_id` varchar(80) NOT NULL,
  `desa_name` varchar(225) NOT NULL,
  `kms` varchar(100) DEFAULT NULL,
  `nama` varchar(225) NOT NULL,
  `umur` char(5) NOT NULL,
  `suami_pus` varchar(225) NOT NULL,
  `kel_dawis` int(12) DEFAULT NULL,
  `jml_anak_hidup` int(5) DEFAULT NULL,
  `jml_anak_meninggal` int(5) DEFAULT NULL,
  `umur_anak_meninggal` char(5) NOT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `lila` varchar(225) NOT NULL,
  `pyd_kapsul_yodium` date DEFAULT NULL,
  `pyd_imsi1` date DEFAULT NULL,
  `pyd_imsi2` date DEFAULT NULL,
  `pyd_imsi_lengkap` date DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `created_by` varchar(80) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(80) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bdb_bumlin`
--
ALTER TABLE `bdb_bumlin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bdb_kunjungan_bumlin`
--
ALTER TABLE `bdb_kunjungan_bumlin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bdb_pemeriksaan_bumlin`
--
ALTER TABLE `bdb_pemeriksaan_bumlin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blt_balita`
--
ALTER TABLE `blt_balita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blt_kunjungan_balita`
--
ALTER TABLE `blt_kunjungan_balita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bml_bumil`
--
ALTER TABLE `bml_bumil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bml_kunjungan_bumil`
--
ALTER TABLE `bml_kunjungan_bumil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byi_bayi`
--
ALTER TABLE `byi_bayi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byi_kunjungan_bayi`
--
ALTER TABLE `byi_kunjungan_bayi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byi_penimbangan_bayi`
--
ALTER TABLE `byi_penimbangan_bayi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_desa`
--
ALTER TABLE `mst_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_enum`
--
ALTER TABLE `mst_enum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_posyandu`
--
ALTER TABLE `pos_posyandu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_posyandu_mst_desa_FK` (`desa_id`);

--
-- Indexes for table `sys_applications`
--
ALTER TABLE `sys_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_roles`
--
ALTER TABLE `usr_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_users`
--
ALTER TABLE `usr_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wsp_akseptor_wuspus`
--
ALTER TABLE `wsp_akseptor_wuspus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wsp_wuspus`
--
ALTER TABLE `wsp_wuspus`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pos_posyandu`
--
ALTER TABLE `pos_posyandu`
  ADD CONSTRAINT `pos_posyandu_mst_desa_FK` FOREIGN KEY (`desa_id`) REFERENCES `mst_desa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
