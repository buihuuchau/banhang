-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 24, 2021 lúc 02:56 PM
-- Phiên bản máy phục vụ: 5.7.24
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` bigint(20) NOT NULL,
  `idkhachhang` bigint(20) DEFAULT NULL,
  `iddonhang` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `anhsanpham` varchar(255) NOT NULL,
  `dongiasanpham` bigint(20) NOT NULL,
  `soluongsanpham` bigint(20) NOT NULL,
  `thanhtiensanpham` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `id` bigint(20) NOT NULL,
  `idkhachhang` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `soluongsanpham` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` bigint(20) NOT NULL,
  `tendanhmuc` varchar(255) NOT NULL,
  `danhmuccha` bigint(20) NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `tendanhmuc`, `danhmuccha`, `hidden`) VALUES
(18, 'Cá', 0, 0),
(19, 'Thức ăn', 0, 0),
(20, 'Cây', 0, 0),
(21, 'Hồ', 0, 0),
(22, 'Chế phẩm', 0, 0),
(23, 'Vật liệu', 0, 0),
(24, 'Phụ kiện', 0, 0),
(25, 'Khác', 0, 0),
(26, 'Guppy', 18, 0),
(27, 'Endler', 18, 0),
(28, 'Cá săn mồi', 18, 0),
(29, 'Cá koi', 18, 0),
(30, 'Tươi sống', 19, 0),
(31, 'Đông lạnh', 19, 0),
(32, 'Sấy khô', 19, 0),
(33, 'Đóng hộp', 19, 0),
(34, 'Rong', 20, 0),
(35, 'Rêu', 20, 0),
(36, 'Cỏ', 20, 0),
(37, 'Hạt giống', 20, 0),
(38, 'Xốp', 21, 0),
(39, 'Kính', 21, 0),
(40, 'Xi măng', 21, 0),
(41, 'Nhựa', 21, 0),
(42, 'Trị bệnh', 22, 0),
(43, 'Xử lý nước', 22, 0),
(44, 'Dinh dưỡng', 22, 0),
(45, 'Vi sinh', 22, 0),
(46, 'Lọc', 23, 0),
(47, 'Đá', 23, 0),
(48, 'Nền', 23, 0),
(49, 'Trang trí', 23, 0),
(50, 'Đèn', 24, 0),
(51, 'Máy móc', 24, 0),
(52, 'Công cụ', 24, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` bigint(20) NOT NULL,
  `idkhachhang` bigint(20) NOT NULL,
  `ngaydathang` date NOT NULL,
  `diachigiaohang` varchar(255) NOT NULL,
  `thanhtiendonhang` bigint(20) NOT NULL,
  `trangthaidonhang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `id` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `dulieuhinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`id`, `idsanpham`, `dulieuhinhanh`) VALUES
(1, 65, 'storage/admin/1/RDeSIzxJzUczOVlEUwGTdZyPI3uzPY5ACCGBcvcy.jpg'),
(2, 65, 'storage/admin/1/Q2BxlUbajPpsWGYEdetdoO68eKSEhxrF5dkKXTPi.jpg'),
(3, 65, 'storage/admin/1/NgS3iCHhmuHbu45Ds1KrAodEw779KZbZXQalPxGH.jpg'),
(4, 65, 'storage/admin/1/JDmA3yelJeRbrzEOaNbAq76Ty6I3NbYfGGldzsb9.jpg'),
(5, 65, 'storage/admin/1/gXHKP8cVXPPUgfCDmXD68M1Ud0m3b0VMZOhyABY3.jpg'),
(21, 47, 'storage/admin/1/Xuvo40Z96Z5g5DjwJqfiHkR52hAYx6OiPbRzNXvq.jpg'),
(22, 47, 'storage/admin/1/8R3Q0XWvDXknvUDDcdUdD0HLNSSPU6p87GBYbIWZ.jpg'),
(26, 47, 'storage/admin/1/KB8QipDGJYJxDWt4WOdldnbU0paVIBS9UhEu5Uxq.jpg'),
(27, 47, 'storage/admin/1/9j6lQZIdqPzKla0j1rtW3398KtlzrqQl2ZBPX1Ji.jpg'),
(28, 47, 'storage/admin/1/2Aw1t2HTVQOMrJCnKzugF8mugfvIYeTJgSS226Ra.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` bigint(20) NOT NULL,
  `sdtkhachhang` bigint(20) NOT NULL,
  `matkhaukhachhang` varchar(255) NOT NULL,
  `hotenkhachhang` varchar(255) NOT NULL,
  `diachikhachhang` varchar(255) NOT NULL,
  `diachigiaohang` varchar(255) NOT NULL,
  `uytinkhachhang` bigint(20) NOT NULL DEFAULT '0',
  `thanhtiengiohang` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id`, `sdtkhachhang`, `matkhaukhachhang`, `hotenkhachhang`, `diachikhachhang`, `diachigiaohang`, `uytinkhachhang`, `thanhtiengiohang`) VALUES
(1, 763232505, 'd8d12015bb905077cce3ca1c32d47c9e', 'Bùi Hữu Châu', 'Cần Thơ', 'B1-6 KDC An Thới', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khohang`
--

CREATE TABLE `khohang` (
  `id` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `soluonghang` bigint(20) NOT NULL DEFAULT '0',
  `soluongban` bigint(20) NOT NULL DEFAULT '0',
  `soluongconlai` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaphang`
--

CREATE TABLE `nhaphang` (
  `id` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `dongianhap` bigint(20) NOT NULL,
  `soluongnhap` bigint(20) NOT NULL,
  `thanhtiennhap` bigint(20) NOT NULL,
  `ngaynhap` date NOT NULL,
  `nguongocnhap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` bigint(20) NOT NULL,
  `iddanhmuc` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `anhsanpham` varchar(255) NOT NULL,
  `thongtinsanpham` longtext NOT NULL,
  `xuatxusanpham` varchar(255) NOT NULL,
  `dongiasanpham` bigint(20) NOT NULL,
  `donvitinhsanpham` varchar(255) NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0',
  `sanphamnoibat` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `iddanhmuc`, `tensanpham`, `anhsanpham`, `thongtinsanpham`, `xuatxusanpham`, `dongiasanpham`, `donvitinhsanpham`, `hidden`, `sanphamnoibat`) VALUES
(44, 26, 'Koi Đen Short Gen Ribbon', 'storage/admin/1/fj3DTGIfo7nosX2zv8FWVSOwoPzGpFknbEDZJsYp.jpg', 'Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon', 'Việt Nam', 60000, 'cặp', 0, 1),
(45, 27, 'Huyết Kiếm', 'storage/admin/1/pHECOryG3zByihHYb84KR8SRtgOtkr9R74jQJo4Y.jpg', 'Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm', 'Việt Nam', 500000, 'cặp', 0, 1),
(46, 27, 'Cá Mún Hạt Lựu Thập Cẩm', 'storage/admin/1/xJlxKe4l58XoJa3UUyLFfZjEG3BEDkFVnbVOzTFO.jpg', 'Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm', 'Việt Nam', 3000, 'con', 0, 1),
(47, 29, 'Koi Chép Việtt', 'storage/admin/1/IhzQ36BzwjB7tXQ4MPA1iWVAO7kdiYr5t1wSobnr.jpg', 'Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt', 'Việt Nam', 800000, 'kg', 0, 1),
(48, 29, 'Cá Chép Koi Mini Việt Nam', 'storage/admin/1/fVGwh88udmGdGO702kEPZlsZJOzPz89Oh3VpEoCH.jpg', 'Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam', 'Việt Nam', 450000, 'kg', 0, 0),
(49, 28, 'Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ', 'storage/admin/1/KyjSdDRC7MDAhdAooEPFhoJ5miuL6RCY2BXsglzB.jpg', 'Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ', 'Việt Nam', 90000, 'con', 0, 1),
(50, 28, 'Cá Rồng Ngân Long', 'storage/admin/1/L0OoDnTQ2izi6mYEeVTCr8az6QXcIutNyicY1Q1G.jpg', 'Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long', 'Việt Nam', 250000, 'con', 0, 1),
(51, 33, 'Thức ăn Okiko La Hán', 'storage/admin/1/t516n10TtM3lfWoG6VRS7qj6NTp4iDwwzT7yun7E.jpg', 'Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán', 'Việt Nam', 60000, 'bịch', 0, 1),
(52, 33, 'Thức ăn Pro’s Choice Cá Dĩa', 'storage/admin/1/2YHG8eHUD4T8oKrrBIGP6PWLWhIW1AGWvN2xvBu8.jpg', 'Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa', 'Việt Nam', 50000, 'chai', 0, 1),
(53, 33, 'Thức ăn Cho Rùa Taiyo', 'storage/admin/1/gS0l5qLqVtyfbbwUUZmR6oSHNVrhiv5lhAjCqXbs.jpg', 'Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo', 'Việt Nam', 25000, 'hủ', 0, 1),
(54, 39, 'Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly', 'storage/admin/1/8o9JPwYihByppKo5QcofET360XzPUIXfHcQu275Y.png', 'Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly', 'Việt Nam', 1900000, 'hồ', 0, 1),
(56, 41, 'Khay Nhựa Tầng Nuôi Cá Trồng Rau', 'storage/admin/1/h49QQGyBklI5CL5PiqOsXKtZ1QJC9z5ObjgppXR2.jpg', 'Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau', 'Việt Nam', 280000, 'bộ', 0, 1),
(60, 43, 'Thuốc Diệt Rêu OF 125ml', 'storage/admin/1/J5X23KS2t1r1dVnMQO9jVhUbd9v6R1UwpP1Tx6Lp.png', 'Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml', 'Việt Nam', 100000, 'chai', 0, 1),
(61, 26, 'Blue Grass Bds', 'storage/admin/1/Ws1KYmo0qU65qLpYO1JiFu3lhVbr9pedWacRexQT.jpg', 'Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds Blue Grass Bds', 'Việt Nam', 100000, 'cặp', 0, 1),
(62, 26, 'Koi Đen Short Gen Ribbon', 'storage/admin/1/fj3DTGIfo7nosX2zv8FWVSOwoPzGpFknbEDZJsYp.jpg', 'Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon Koi Đen Short Gen Ribbon', 'Việt Nam', 60000, 'cặp', 0, 1),
(63, 27, 'Huyết Kiếm', 'storage/admin/1/pHECOryG3zByihHYb84KR8SRtgOtkr9R74jQJo4Y.jpg', 'Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm Huyết Kiếm', 'Việt Nam', 500000, 'cặp', 0, 1),
(64, 27, 'Cá Mún Hạt Lựu Thập Cẩm', 'storage/admin/1/xJlxKe4l58XoJa3UUyLFfZjEG3BEDkFVnbVOzTFO.jpg', 'Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm Cá Mún Hạt Lựu Thập Cẩm', 'Việt Nam', 3000, 'con', 0, 1),
(65, 29, 'Koi Chép Việt', 'storage/admin/1/IhzQ36BzwjB7tXQ4MPA1iWVAO7kdiYr5t1wSobnr.jpg', 'Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt Koi Chép Việt', 'Việt Nam', 800000, 'kg', 0, 0),
(66, 29, 'Cá Chép Koi Mini Việt Nam', 'storage/admin/1/fVGwh88udmGdGO702kEPZlsZJOzPz89Oh3VpEoCH.jpg', 'Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam Cá Chép Koi Mini Việt Nam', 'Việt Nam', 450000, 'kg', 0, 1),
(67, 28, 'Cá Bạc Hổ Việt Nam Nhỏ', 'storage/admin/1/KyjSdDRC7MDAhdAooEPFhoJ5miuL6RCY2BXsglzB.jpg', 'Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ Cá Bạc Hổ Việt Nam Nhỏ', 'Việt Nam', 90000, 'con', 0, 0),
(68, 28, 'Cá Rồng Ngân Long', 'storage/admin/1/L0OoDnTQ2izi6mYEeVTCr8az6QXcIutNyicY1Q1G.jpg', 'Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long Cá Rồng Ngân Long', 'Việt Nam', 250000, 'con', 0, 0),
(69, 33, 'Thức ăn Okiko La Hán', 'storage/admin/1/t516n10TtM3lfWoG6VRS7qj6NTp4iDwwzT7yun7E.jpg', 'Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán Thức ăn Okiko La Hán', 'Việt Nam', 60000, 'bịch', 0, 1),
(70, 33, 'Thức ăn Pro’s Choice Cá Dĩa', 'storage/admin/1/2YHG8eHUD4T8oKrrBIGP6PWLWhIW1AGWvN2xvBu8.jpg', 'Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa Thức ăn Pro’s Choice Cá Dĩa', 'Việt Nam', 50000, 'chai', 0, 1),
(71, 33, 'Thức ăn Cho Rùa Taiyo', 'storage/admin/1/gS0l5qLqVtyfbbwUUZmR6oSHNVrhiv5lhAjCqXbs.jpg', 'Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo Thức ăn Cho Rùa Taiyo', 'Việt Nam', 25000, 'hủ', 0, 1),
(72, 39, 'Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly', 'storage/admin/1/8o9JPwYihByppKo5QcofET360XzPUIXfHcQu275Y.png', 'Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly Hồ Kính Siêu Trong 90x40x40cm Kính 8 Ly', 'Việt Nam', 1900000, 'hồ', 0, 1),
(73, 39, 'Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly', 'storage/admin/1/iE8drnVqqaz5nCOZ4QMmLwLV0JmphZ7BOsAeGxyI.png', 'Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly Hồ Kính Siêu Trong 120x45x45cm Kính 12 Ly', 'Việt Nam', 3500000, 'hồ', 0, 1),
(74, 41, 'Khay Nhựa Tầng Nuôi Cá Trồng Rau', 'storage/admin/1/h49QQGyBklI5CL5PiqOsXKtZ1QJC9z5ObjgppXR2.jpg', 'Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau Khay Nhựa Tầng Nuôi Cá Trồng Rau', 'Việt Nam', 280000, 'bộ', 0, 1),
(76, 43, 'Thuốc Diệt Rêu OF 125ml', 'storage/admin/1/J5X23KS2t1r1dVnMQO9jVhUbd9v6R1UwpP1Tx6Lp.png', 'Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml Thuốc Diệt Rêu OF 125ml', 'Việt Nam', 100000, 'chai', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinshop`
--

CREATE TABLE `thongtinshop` (
  `id` bigint(20) NOT NULL,
  `tenshop` varchar(255) NOT NULL,
  `logoshop` varchar(255) NOT NULL,
  `diachishop` varchar(255) NOT NULL,
  `dienthoaishop` varchar(255) NOT NULL,
  `emailshop` varchar(255) DEFAULT NULL,
  `websiteshop` varchar(255) DEFAULT NULL,
  `stkshop` bigint(20) NOT NULL,
  `vitrishop` varchar(255) DEFAULT NULL,
  `thoigianhoatdong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongtinshop`
--

INSERT INTO `thongtinshop` (`id`, `tenshop`, `logoshop`, `diachishop`, `dienthoaishop`, `emailshop`, `websiteshop`, `stkshop`, `vitrishop`, `thoigianhoatdong`) VALUES
(1, 'SHOP CÁ CẢNH PHÚ QUỐC', 'storage/admin/1/6fCeF7MuKn5n3N61PsJukAQMB1B4CUpoZrIcMAcK.jpg', 'PHÚC QUỐC, KIÊN GIANG', '0123456789', 'buihuuchau99@gmail.com', 'http://abc.com', 12345678901234, '10.071948, 105.758935', 'Từ 7h đến 21h');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bùi Hữu Châu', 'buihuuchau99@gmail.com', '2021-09-08 04:59:08', '$2y$10$SkCSSHqaTHVxtpqJbnSVOeAY9RXH6BNjlI5HSTJgAP5VOHLmIDhsC', NULL, '2021-09-08 04:58:09', '2021-09-08 04:59:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video`
--

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `dulieuvideo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `video`
--

INSERT INTO `video` (`id`, `idsanpham`, `dulieuvideo`) VALUES
(1, 65, 'storage/admin/1/4HWbyEKV1XJvyte8OqbnNAPRThkp7owQkJPlgofR.mp4'),
(2, 47, 'storage/admin/1/AlcCdzCisy0OpsaKFwdDeM9qLdUEt2GuqE3AsniR.mp4');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhaphang`
--
ALTER TABLE `nhaphang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongtinshop`
--
ALTER TABLE `thongtinshop`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `khohang`
--
ALTER TABLE `khohang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhaphang`
--
ALTER TABLE `nhaphang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `thongtinshop`
--
ALTER TABLE `thongtinshop`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
