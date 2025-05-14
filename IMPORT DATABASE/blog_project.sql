-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 07:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 1),
(10, '0001_01_01_000002_create_jobs_table', 1),
(11, '2025_05_13_130010_add_role_to_users_table', 1),
(12, '2025_05_14_040137_create_posts_table', 1),
(13, '2025_05_14_041424_add_rejection_reason_to_posts_table', 1),
(14, '2025_05_14_045725_update_posts_structure', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `status`, `user_id`, `created_at`, `updated_at`, `rejection_reason`, `short_description`, `banner_image`, `gallery_images`) VALUES
(1, 'Hoshimachi Suisei – Từ VTuber độc lập đến ngôi sao âm nhạc của Hololive', '<p class=\"\" data-start=\"456\" data-end=\"788\"><strong data-start=\"456\" data-end=\"470\">Giới thiệu</strong><br data-start=\"470\" data-end=\"473\">Hoshimachi Suisei (星街すいせい) l&agrave; một ca sĩ ki&ecirc;m VTuber trực thuộc Hololive Production &ndash; một trong những c&ocirc;ng ty giải tr&iacute; VTuber lớn nhất thế giới. Với chất giọng mạnh mẽ, khả năng s&aacute;ng tạo v&agrave; h&igrave;nh tượng ng&ocirc;i sao đầy cuốn h&uacute;t, Suisei đ&atilde; trở th&agrave;nh h&igrave;nh mẫu l&yacute; tưởng của nhiều fan y&ecirc;u &acirc;m nhạc lẫn văn h&oacute;a VTuber hiện đại.</p>\r\n<hr class=\"\" data-start=\"790\" data-end=\"793\">\r\n<p class=\"\" data-start=\"795\" data-end=\"1226\"><strong data-start=\"795\" data-end=\"818\">Khởi đầu đầy nỗ lực</strong><br data-start=\"818\" data-end=\"821\">Suisei bắt đầu h&agrave;nh tr&igrave;nh của m&igrave;nh v&agrave;o năm 2018 với tư c&aacute;ch l&agrave; một VTuber độc lập. C&ocirc; tự thiết kế nh&acirc;n vật, lồng tiếng v&agrave; dựng m&ocirc; h&igrave;nh 2D cho ch&iacute;nh m&igrave;nh. Ban đầu, c&ocirc; chỉ mong muốn trở th&agrave;nh một idol ảo c&oacute; thể ca h&aacute;t v&agrave; truyền cảm hứng. D&ugrave; kh&ocirc;ng c&oacute; hậu thuẫn từ c&ocirc;ng ty, Suisei vẫn miệt m&agrave;i s&aacute;ng tạo nội dung, ph&aacute;t triển cộng đồng fan ri&ecirc;ng v&agrave; tạo dựng dấu ấn với lối n&oacute;i chuyện d&iacute; dỏm v&agrave; đam m&ecirc; ch&aacute;y bỏng.</p>\r\n<hr class=\"\" data-start=\"1228\" data-end=\"1231\">\r\n<p class=\"\" data-start=\"1233\" data-end=\"1637\"><strong data-start=\"1233\" data-end=\"1278\">Gia nhập Hololive v&agrave; bước ngoặt sự nghiệp</strong><br data-start=\"1278\" data-end=\"1281\">Năm 2019, Suisei được mời gia nhập Hololive th&ocirc;ng qua nh&atilde;n &acirc;m nhạc INoNaKa Music. Cuối năm đ&oacute;, c&ocirc; được chuyển sang chi nh&aacute;nh ch&iacute;nh thức của Hololive, đ&aacute;nh dấu bước ngoặt lớn trong sự nghiệp. Với cơ sở người h&acirc;m mộ ng&agrave;y c&agrave;ng lớn, c&ocirc; nhanh ch&oacute;ng thu h&uacute;t sự ch&uacute; &yacute; qua c&aacute;c buổi livestream chơi game, cover b&agrave;i h&aacute;t v&agrave; c&aacute;c buổi concert trực tuyến chất lượng cao.</p>\r\n<hr class=\"\" data-start=\"1639\" data-end=\"1642\">\r\n<p class=\"\" data-start=\"1644\" data-end=\"1782\"><strong data-start=\"1644\" data-end=\"1672\">Th&agrave;nh c&ocirc;ng trong &acirc;m nhạc</strong><br data-start=\"1672\" data-end=\"1675\">Suisei l&agrave; một trong những VTuber c&oacute; giọng h&aacute;t được đ&aacute;nh gi&aacute; cao nhất hiện nay. C&ocirc; sở hữu nhiều bản hit như:</p>\r\n<ul data-start=\"1784\" data-end=\"2216\">\r\n<li class=\"\" data-start=\"1784\" data-end=\"1879\">\r\n<p class=\"\" data-start=\"1786\" data-end=\"1879\"><strong data-start=\"1786\" data-end=\"1807\">Next Color Planet</strong> (2020) &ndash; b&agrave;i h&aacute;t đ&aacute;nh dấu bước tiến quan trọng trong &acirc;m nhạc c&aacute; nh&acirc;n.</p>\r\n</li>\r\n<li class=\"\" data-start=\"1880\" data-end=\"1958\">\r\n<p class=\"\" data-start=\"1882\" data-end=\"1958\"><strong data-start=\"1882\" data-end=\"1891\">GHOST</strong> (2021) &ndash; đạt vị tr&iacute; cao tr&ecirc;n bảng xếp hạng Oricon Digital Chart.</p>\r\n</li>\r\n<li class=\"\" data-start=\"1959\" data-end=\"2117\">\r\n<p class=\"\" data-start=\"1961\" data-end=\"2117\"><strong data-start=\"1961\" data-end=\"1980\">Stellar Stellar</strong> &ndash; b&agrave;i h&aacute;t chủ đề trong album đầu tay <em data-start=\"2018\" data-end=\"2039\">Still Still Stellar</em> (2021), gi&uacute;p c&ocirc; khẳng định vị tr&iacute; trong ng&agrave;nh c&ocirc;ng nghiệp &acirc;m nhạc Nhật Bản.</p>\r\n</li>\r\n<li class=\"\" data-start=\"2118\" data-end=\"2216\">\r\n<p class=\"\" data-start=\"2120\" data-end=\"2216\"><strong data-start=\"2120\" data-end=\"2131\">Specter</strong> (2023) &ndash; album thứ hai mang phong c&aacute;ch trưởng th&agrave;nh, b&iacute; ẩn v&agrave; mang đậm dấu ấn ri&ecirc;ng.</p>\r\n</li>\r\n</ul>\r\n<p class=\"\" data-start=\"2218\" data-end=\"2414\">Đặc biệt, c&ocirc; l&agrave; <strong data-start=\"2234\" data-end=\"2325\">VTuber đầu ti&ecirc;n xuất hiện tr&ecirc;n k&ecirc;nh YouTube &acirc;m nhạc nổi tiếng thế giới \"THE FIRST TAKE\"</strong> &ndash; nơi c&aacute;c nghệ sĩ biểu diễn live một lần duy nhất, thể hiện thực lực giọng h&aacute;t đỉnh cao.</p>\r\n<hr class=\"\" data-start=\"2416\" data-end=\"2419\">\r\n<p class=\"\" data-start=\"2421\" data-end=\"2448\"><strong data-start=\"2421\" data-end=\"2446\">Những cột mốc nổi bật</strong></p>\r\n<ul data-start=\"2449\" data-end=\"2797\">\r\n<li class=\"\" data-start=\"2449\" data-end=\"2508\">\r\n<p class=\"\" data-start=\"2451\" data-end=\"2508\">Đạt <strong data-start=\"2455\" data-end=\"2480\">1 triệu người đăng k&yacute;</strong> YouTube v&agrave;o th&aacute;ng 6/2021.</p>\r\n</li>\r\n<li class=\"\" data-start=\"2509\" data-end=\"2560\">\r\n<p class=\"\" data-start=\"2511\" data-end=\"2560\">Đạt <strong data-start=\"2515\" data-end=\"2540\">2 triệu người đăng k&yacute;</strong> v&agrave;o th&aacute;ng 9/2023.</p>\r\n</li>\r\n<li class=\"\" data-start=\"2561\" data-end=\"2699\">\r\n<p class=\"\" data-start=\"2563\" data-end=\"2699\">Biểu diễn tại s&acirc;n khấu danh gi&aacute; <strong data-start=\"2595\" data-end=\"2613\">Nippon Budokan</strong> v&agrave;o th&aacute;ng 2/2025 &ndash; một giấc mơ th&agrave;nh hiện thực đối với bất kỳ nghệ sĩ Nhật Bản n&agrave;o.</p>\r\n</li>\r\n<li class=\"\" data-start=\"2700\" data-end=\"2797\">\r\n<p class=\"\" data-start=\"2702\" data-end=\"2797\">Nhiều MV của c&ocirc; đạt h&agrave;ng triệu lượt xem trong thời gian ngắn (v&iacute; dụ: <em data-start=\"2771\" data-end=\"2782\">Bibbidiba</em>, <em data-start=\"2784\" data-end=\"2795\">Michizure</em>).</p>\r\n</li>\r\n</ul>\r\n<hr class=\"\" data-start=\"2799\" data-end=\"2802\">\r\n<p class=\"\" data-start=\"2804\" data-end=\"3125\"><strong data-start=\"2804\" data-end=\"2826\">Kh&ocirc;ng chỉ l&agrave; ca sĩ</strong><br data-start=\"2826\" data-end=\"2829\">Ngo&agrave;i &acirc;m nhạc, Suisei c&ograve;n nổi tiếng trong cộng đồng game thủ với khả năng chơi <strong data-start=\"2908\" data-end=\"2918\">Tetris</strong> chuy&ecirc;n nghiệp &ndash; từng xếp hạng cao tr&ecirc;n nhiều bảng xếp hạng Nhật Bản. T&iacute;nh c&aacute;ch của c&ocirc; được y&ecirc;u th&iacute;ch bởi sự \"tsundere\" (ngo&agrave;i lạnh trong n&oacute;ng), th&ocirc;ng minh v&agrave; thường xuy&ecirc;n &ldquo;troll&rdquo; bạn b&egrave; tr&ecirc;n s&oacute;ng trực tiếp.</p>\r\n<hr class=\"\" data-start=\"3127\" data-end=\"3130\">\r\n<p class=\"\" data-start=\"3132\" data-end=\"3470\"><strong data-start=\"3132\" data-end=\"3144\">Kết luận</strong><br data-start=\"3144\" data-end=\"3147\">Từ một c&ocirc; g&aacute;i độc lập với giấc mơ l&agrave;m idol, <strong data-start=\"3191\" data-end=\"3212\">Hoshimachi Suisei</strong> đ&atilde; vươn l&ecirc;n trở th&agrave;nh một biểu tượng to&agrave;n cầu trong l&agrave;ng VTuber, truyền cảm hứng cho h&agrave;ng triệu người bằng t&agrave;i năng v&agrave; sự ki&ecirc;n định. C&ocirc; kh&ocirc;ng chỉ l&agrave; một VTuber, m&agrave; c&ograve;n l&agrave; minh chứng cho việc theo đuổi đam m&ecirc; đến c&ugrave;ng sẽ mang lại th&agrave;nh c&ocirc;ng vượt xa mong đợi.</p>', 'approved', 2, '2025-05-13 22:13:30', '2025-05-14 09:28:24', NULL, 'Test', 'uploads/posts/Wusty82xuBhyjbSEsi6bbamcqvD4R2z1GTFtQdRs.jpg', '\"[\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/DdOSYv7N5qhliMW14Ry8lqHiWYFDnnEZpZj3Q1HD.png\\\",\\\"gallery\\\\\\/Sbrnv45eSqOkr1Gui7yS1kFhKWK64WbSkpmxxKWz.png\\\",\\\"gallery\\\\\\/hnmuIdmHu5FnUFLzyTKNTwlcJG1VqRIDuKdB64tC.png\\\",\\\"gallery\\\\\\/aRyRhpgBjbNQaTEA8W60QYPwFouM5JSoCiX88TEl.png\\\"]\"'),
(5, '23q4e5uoiuytr', '<p>43tyue53tyujoit54r3yuil;</p>', 'approved', 1, '2025-05-14 00:57:51', '2025-05-14 00:58:25', NULL, '3356ty7uoe3', 'uploads/posts/BPpx7p77suUvsV2T5hPIgtKuZ0qcWocRHpXUcWc2.png', '\"[\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/VkfTlsCPVeGw7w5VhX3YmjFcbh3KrgDOHlyfndm6.png\\\",\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/JUnYxTjqyGiUxxTkjk6LDGDNFarDZe98VzqdhFNp.png\\\",\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/8GRTcHgXtW3Q7QeDEH4CjSOsBV61ENi5g6LgekpX.png\\\"]\"'),
(6, 'Giới Trẻ Hiện Nay: Năng Động, Sáng Tạo Nhưng Cũng Đầy Thách Thức', '<p class=\"\" data-start=\"458\" data-end=\"747\">Trong bối cảnh thế giới kh&ocirc;ng ngừng biến đổi, giới trẻ hiện nay đang đ&oacute;ng một vai tr&ograve; quan trọng trong mọi lĩnh vực của đời sống &mdash; từ gi&aacute;o dục, c&ocirc;ng nghệ, nghệ thuật đến hoạt động x&atilde; hội. Họ l&agrave; thế hệ được tiếp cận sớm với c&ocirc;ng nghệ, c&oacute; tư duy mở, th&iacute;ch nghi nhanh v&agrave; kh&ocirc;ng ngừng s&aacute;ng tạo.</p>\r\n<p class=\"\" data-start=\"749\" data-end=\"1031\"><strong data-start=\"749\" data-end=\"777\">1. Năng động v&agrave; S&aacute;ng tạo</strong><br data-start=\"777\" data-end=\"780\">Kh&ocirc;ng giống như thế hệ trước, giới trẻ hiện đại chủ động t&igrave;m kiếm cơ hội, sẵn s&agrave;ng khởi nghiệp, v&agrave; lu&ocirc;n cập nhật c&aacute;c xu hướng mới. Mạng x&atilde; hội, AI, học trực tuyến v&agrave; c&aacute;c nền tảng số gi&uacute;p họ kết nối, học hỏi v&agrave; thể hiện bản th&acirc;n theo c&aacute;ch chưa từng c&oacute;.</p>\r\n<p class=\"\" data-start=\"1033\" data-end=\"1298\"><strong data-start=\"1033\" data-end=\"1070\">2. Nhận thức x&atilde; hội ng&agrave;y c&agrave;ng cao</strong><br data-start=\"1070\" data-end=\"1073\">Nhiều bạn trẻ kh&ocirc;ng chỉ quan t&acirc;m đến th&agrave;nh c&ocirc;ng c&aacute; nh&acirc;n m&agrave; c&ograve;n t&iacute;ch cực tham gia v&agrave;o c&aacute;c hoạt động thiện nguyện, bảo vệ m&ocirc;i trường, l&ecirc;n tiếng cho c&aacute;c vấn đề x&atilde; hội như b&igrave;nh đẳng giới, sức khỏe tinh thần hay quyền con người.</p>\r\n<p class=\"\" data-start=\"1300\" data-end=\"1620\"><strong data-start=\"1300\" data-end=\"1347\">3. &Aacute;p lực từ m&ocirc;i trường sống v&agrave; mạng x&atilde; hội</strong><br data-start=\"1347\" data-end=\"1350\">Tuy nhi&ecirc;n, mặt tr&aacute;i của thời đại số l&agrave; những &aacute;p lực v&ocirc; h&igrave;nh. Mạng x&atilde; hội tạo ra kỳ vọng kh&ocirc;ng thực tế về th&agrave;nh c&ocirc;ng, sắc đẹp v&agrave; cuộc sống ho&agrave;n hảo. Nhiều bạn trẻ cảm thấy lo &acirc;u, tự ti v&agrave; thậm ch&iacute; rơi v&agrave;o trầm cảm nếu kh&ocirc;ng đạt được những \"chuẩn mực\" m&agrave; x&atilde; hội ảo đặt ra.</p>\r\n<p class=\"\" data-start=\"1622\" data-end=\"1914\"><strong data-start=\"1622\" data-end=\"1665\">4. Gi&aacute;o dục v&agrave; sự chuẩn bị chưa đồng bộ</strong><br data-start=\"1665\" data-end=\"1668\">D&ugrave; c&oacute; nhiều cơ hội, kh&ocirc;ng &iacute;t bạn trẻ vẫn gặp kh&oacute; khăn trong việc định hướng nghề nghiệp, thiếu kỹ năng thực tiễn hoặc gặp r&agrave;o cản t&agrave;i ch&iacute;nh. Điều n&agrave;y đ&ograve;i hỏi sự hỗ trợ nhiều hơn từ gia đ&igrave;nh, nh&agrave; trường v&agrave; x&atilde; hội để họ c&oacute; thể ph&aacute;t triển to&agrave;n diện.</p>\r\n<p class=\"\" data-start=\"1622\" data-end=\"1914\">&nbsp;</p>\r\n<h3 class=\"\" data-start=\"1921\" data-end=\"1941\"><strong data-start=\"1928\" data-end=\"1941\">Kết luận:</strong></h3>\r\n<p class=\"\" data-start=\"1942\" data-end=\"2234\">Giới trẻ h&ocirc;m nay l&agrave; tương lai của đất nước. Việc thấu hiểu, đồng h&agrave;nh v&agrave; tạo điều kiện cho họ ph&aacute;t triển ch&iacute;nh l&agrave; ch&igrave;a kh&oacute;a để x&acirc;y dựng một x&atilde; hội văn minh, s&aacute;ng tạo v&agrave; bền vững. Họ cần được lắng nghe, hỗ trợ đ&uacute;ng c&aacute;ch để c&oacute; thể ph&aacute;t huy hết tiềm năng trong một thế giới kh&ocirc;ng ngừng thay đổi.</p>', 'approved', 2, '2025-05-14 01:32:00', '2025-05-14 01:32:27', NULL, 'Giới trẻ ngày nay không chỉ là lực lượng nòng cốt trong sự phát triển của xã hội mà còn mang trong mình nhiều khát vọng, hoài bão và cũng đối mặt với không ít áp lực trong thời đại số hóa, toàn cầu hóa.', 'uploads/posts/vawNOWKCS4cPs5mWjEjKjBMlTcVS2dcdQGFgC5JO.jpg', '\"[\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/D32lPvuoHsRuHJtxAc0mt6CUgT4gnZZG0I3imoXP.jpg\\\",\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/y3dcf5rzJDw1gyAibQzck7EUS73ocp2zTHuKHSVW.jpg\\\",\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/7mRBjr8hsMBB7x6wxd1t8V4vP1w4E18F8PSBmK71.jpg\\\"]\"'),
(7, 'Học Online – Cơ Hội Hay Thử Thách?', '<p>Trong thời đại c&ocirc;ng nghệ ph&aacute;t triển, học online đang dần thay thế c&aacute;c h&igrave;nh thức học truyền thống. Với sự linh hoạt về thời gian v&agrave; kh&ocirc;ng gian, học sinh, sinh vi&ecirc;n c&oacute; thể tiếp cận kiến thức từ bất cứ đ&acirc;u. Tuy nhi&ecirc;n, h&igrave;nh thức học n&agrave;y cũng đặt ra nhiều th&aacute;ch thức, như thiếu sự tương t&aacute;c trực tiếp, giảm động lực học tập v&agrave; đ&ograve;i hỏi t&iacute;nh tự gi&aacute;c cao. Để học online hiệu quả, người học cần trang bị kỹ năng quản l&yacute; thời gian, c&ocirc;ng nghệ v&agrave; khả năng tự học tốt.</p>', 'approved', 1, '2025-05-14 01:50:40', '2025-05-14 01:52:25', NULL, 'Học online đang trở thành xu hướng phổ biến, nhưng liệu đây có phải là lựa chọn lý tưởng cho tất cả sinh viên?', 'uploads/posts/iTRlUG8i9U7Q3ieLqvgyCht18i5gdIE4feg3PSBf.jpg', '\"[\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/L7Lzj59ShT2uwBL4afEsYmVm2Ll4O1ODBSauR2GD.png\\\",\\\"uploads\\\\\\/posts\\\\\\/gallery\\\\\\/iRP4i7iWd1b2hO3mCReAKCso9dkumTUtaGttNQ6R.png\\\"]\"');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GwIXtyiLAxJCq821qBdI1KTwfLozUXrjdhCGvJJ1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmNnSkJWa2xoSWJDdU1rWmZ6WXRvQlBDb29idEtpRkpYQTNHY09tWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747214234),
('RSOGYwybSRfXxkLjHgB4to9vLaOsEsnR8LZkFaDF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNkt1bW5RYllxaUVJRHJXbGY4TlNHVWJ6MHFQdmQ4S2RkZmJZTWRUdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1747242109);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$WLpowjeP6kVJ0vCKt6Up1eL8DUjH4esZ8GkjOyKQeAM8RNl/B/eSG', 'admin', NULL, '2025-05-13 22:00:12', '2025-05-14 10:00:12'),
(2, 'User', 'user@example.com', NULL, '$2y$12$6ajhOG4bM3MFNJR7Tn3uXOwmEvsUdYHIg6IrsWkGsLRFOCHGsdIlC', 'user', NULL, '2025-05-13 22:00:12', '2025-05-13 22:00:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
