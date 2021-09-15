-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 15, 2021 lúc 02:27 PM
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
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `tendanhmuc` varchar(255) NOT NULL,
  `danhmuccha` bigint(20) NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `idusers`, `tendanhmuc`, `danhmuccha`, `hidden`) VALUES
(1, 1, 'Thức ăn', 0, 0),
(2, 1, 'Thức ăn cho chim', 1, 0),
(3, 1, 'Thức ăn cho cá', 1, 0),
(4, 1, 'Hồ', 0, 0),
(5, 1, 'Hồ kính', 4, 0),
(6, 1, 'Hồ nhựa', 4, 0),
(7, 1, 'Hồ nhựa meca mỏng', 6, 0),
(8, 1, 'Hồ nhựa meca dày', 6, 0),
(9, 1, 'Hồ kính cường lực', 5, 0),
(10, 1, 'Hồ kính chống đạn', 5, 1),
(11, 1, 'Thức ăn cho chim bé', 2, 0),
(12, 1, 'Cá', 0, 0);

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
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `idkhachhang` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `dongiasanpham` bigint(20) NOT NULL,
  `soluongsanpham` bigint(20) NOT NULL,
  `thanhtien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `dulieuhinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`id`, `idusers`, `idsanpham`, `dulieuhinhanh`) VALUES
(63, 1, 40, 'storage/admin/1/wytGBbT9SkeRPuaBKFchSmYCvlMRCxC7nBtJjtx8.jpg'),
(64, 1, 40, 'storage/admin/1/rFGWEOcfZnlI1qqvHxTtIZgYJIyxQUb1yRg8g33O.jpg'),
(65, 1, 40, 'storage/admin/1/r1RbnzORQyCFKrXfydkmGoAaolZ8fKB2Gasc3MZp.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `sdtkhachhang` bigint(20) NOT NULL,
  `matkhaukhachhang` varchar(255) NOT NULL,
  `hotenkhachhang` varchar(255) NOT NULL,
  `diachikhachhang` varchar(255) NOT NULL,
  `ngaysinhkhachhang` date NOT NULL,
  `gioitinhkhachhang` bigint(20) NOT NULL,
  `uytinkhachhang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khohang`
--

CREATE TABLE `khohang` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `dongianhap` bigint(20) NOT NULL,
  `soluongnhap` bigint(20) NOT NULL,
  `thanhtiennhap` bigint(20) NOT NULL,
  `hangdaban` bigint(20) NOT NULL DEFAULT '0',
  `hangconlai` bigint(20) NOT NULL,
  `ngaynhap` date NOT NULL,
  `nguongocnhap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khohang`
--

INSERT INTO `khohang` (`id`, `idusers`, `idsanpham`, `tensanpham`, `dongianhap`, `soluongnhap`, `thanhtiennhap`, `hangdaban`, `hangconlai`, `ngaynhap`, `nguongocnhap`) VALUES
(8, 1, 41, 'cá koi nhật', 25000000, 4, 100000000, 0, 4, '2021-09-15', 'Nhật Bản'),
(9, 1, 40, 'Hồ kính 20*20', 530000, 20, 10600000, 0, 20, '2021-09-15', 'Nhôm kính Thịnh Phát, sdt 0712455678');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `linhvuc`
--

CREATE TABLE `linhvuc` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `tenlinhvuc` varchar(255) NOT NULL,
  `hidden` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `linhvuc`
--

INSERT INTO `linhvuc` (`id`, `idusers`, `tenlinhvuc`, `hidden`) VALUES
(1, 1, 'Thức ăn', 0),
(2, 1, 'Cây cảnh', 0);

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
  `idusers` bigint(20) NOT NULL,
  `iddanhmuc` bigint(20) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `anhsanpham` varchar(255) NOT NULL,
  `thongtinsanpham` varchar(255) NOT NULL,
  `xuatxusanpham` varchar(255) NOT NULL,
  `dongiasanpham` bigint(20) NOT NULL,
  `donvitinhsanpham` varchar(255) NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0',
  `sanphamnoibat` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `idusers`, `iddanhmuc`, `tensanpham`, `anhsanpham`, `thongtinsanpham`, `xuatxusanpham`, `dongiasanpham`, `donvitinhsanpham`, `hidden`, `sanphamnoibat`) VALUES
(39, 1, 11, 'ao kính 20*25', 'storage/admin/1/6wgCAq22aocFRd27LKByVDkX8QXIA6PWn6Fc59Id.jpg', 'b', 'c', 10000, 'd', 0, 1),
(40, 1, 9, 'Hồ kính 20*20', 'storage/admin/1/lwkeUvuuS7k7YH3tKppV7LeYGlNW7S3gdVYsIZ6N.jpg', 'bb', 'c', 200000, 'd', 0, 0),
(41, 1, 12, 'cá koi nhật', 'storage/admin/1/htwHpj1Xr2ClMm7jidnJ09K5rQd3XPDVWAUfOAtZ.jpg', 'thông tin', 'c', 50000000, 'con', 0, 1);

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
  `vitrishop` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongtinshop`
--

INSERT INTO `thongtinshop` (`id`, `tenshop`, `logoshop`, `diachishop`, `dienthoaishop`, `emailshop`, `websiteshop`, `vitrishop`) VALUES
(1, 'SHOP CÁ CẢNH PHÚ QUỐC', 'storage/admin/1/lIw9RLfvN3pZYDtszYL6uyyqtoqMSDdaQzeXsIaS.jpg', 'PHÚC QUỐC, KIÊN GIANG', '0123456789', 'buihuuchau99@gmail.com', 'http://abc.com', '10.071948, 105.758935'),
(2, 'SHOP CÁ CẢNH PHÚ QUỐCc', 'storage/admin/2/scNTMDP5RGGnorquKmUfDEI93OdW9c4uqnHvPlwY.jpg', 'PHÚC QUỐC, KIÊN GIANGg', '0123456789', 'chaub1706789@student.ctu.edu.vn', 'https://abc.com', '10.071948, 105.758935');

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
(1, 'Bùi Hữu Châu', 'buihuuchau99@gmail.com', '2021-09-08 04:59:08', '$2y$10$SkCSSHqaTHVxtpqJbnSVOeAY9RXH6BNjlI5HSTJgAP5VOHLmIDhsC', NULL, '2021-09-08 04:58:09', '2021-09-08 04:59:08'),
(2, 'Bùi Hữu Châu', 'chaub1706789@student.ctu.edu.vn', '2021-09-10 06:00:08', '$2y$10$viZg21tqqhGTw8WWmqKx7eRYFBRBKB3AGEiy7Ztk.FBeOsUk5bk4O', NULL, '2021-09-10 05:59:58', '2021-09-10 06:00:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video`
--

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL,
  `idusers` bigint(20) NOT NULL,
  `idsanpham` bigint(20) NOT NULL,
  `dulieuvideo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `video`
--

INSERT INTO `video` (`id`, `idusers`, `idsanpham`, `dulieuvideo`) VALUES
(26, 1, 40, 'storage/admin/1/dohyTrMxZlLRcWwhI7TPLlFL05CwEGBwk68GOXvK.mp4');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `linhvuc`
--
ALTER TABLE `linhvuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
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
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khohang`
--
ALTER TABLE `khohang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `linhvuc`
--
ALTER TABLE `linhvuc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `thongtinshop`
--
ALTER TABLE `thongtinshop`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
