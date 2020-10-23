-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th2 24, 2019 lúc 05:03 PM
-- Phiên bản máy phục vụ: 10.3.12-MariaDB
-- Phiên bản PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `id6829933_qlbansach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `BINHLUAN`
--

USE bansach

CREATE TABLE `BINHLUAN` (
  `MASACH` int(11) NOT NULL,
  `ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `PARENT` int(11) DEFAULT NULL,
  `CREATED` date DEFAULT NULL,
  `MODIFIED` date DEFAULT NULL,
  `CONTENT` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FULLNAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPVOTE_COUNT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `BINHLUAN`
--

INSERT INTO `BINHLUAN` (`MASACH`, `ID`, `PARENT`, `CREATED`, `MODIFIED`, `CONTENT`, `FULLNAME`, `UPVOTE_COUNT`) VALUES
(12, 'c1', NULL, '2017-01-06', '2017-01-06', 'Quyển sách rất hay.\n', 'user123', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `CHITIETHOADON`
--

CREATE TABLE `CHITIETHOADON` (
  `MASACH` int(11) NOT NULL,
  `MAHD` int(11) NOT NULL,
  `SOLUONG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `CHITIETHOADON`
--

INSERT INTO `CHITIETHOADON` (`MASACH`, `MAHD`, `SOLUONG`) VALUES
(10, 9, 2),
(11, 11, 1),
(12, 11, 1);

--
-- Bẫy `CHITIETHOADON`
--
DELIMITER $$
CREATE TRIGGER `capnhatconlai_insert` AFTER INSERT ON `CHITIETHOADON` FOR EACH ROW BEGIN
	DECLARE SL INT DEFAULT 0;
    DECLARE DABAN INT DEFAULT 0;
    SELECT SOLUONG INTO SL FROM SACH WHERE MASACH = NEW.MASACH;
   	SELECT SUM(SOLUONG) INTO DABAN FROM CHITIETHOADON WHERE MASACH = NEW.MASACH;
    UPDATE SACH SET CONLAI = SL - DABAN WHERE MASACH = NEW.MASACH;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `capnhatconlai_update` AFTER UPDATE ON `CHITIETHOADON` FOR EACH ROW BEGIN
	DECLARE SL INT DEFAULT 0;
    DECLARE DABAN INT DEFAULT 0;
    SELECT SOLUONG INTO SL FROM SACH WHERE MASACH = NEW.MASACH;
   	SELECT SUM(SOLUONG) INTO DABAN FROM CHITIETHOADON WHERE MASACH = NEW.MASACH;
    UPDATE SACH SET CONLAI = SL - DABAN WHERE MASACH = NEW.MASACH;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DANHGIA`
--

CREATE TABLE `DANHGIA` (
  `MASACH` int(11) NOT NULL,
  `MAKH` int(11) NOT NULL,
  `DIEM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `DANHGIA`
--

INSERT INTO `DANHGIA` (`MASACH`, `MAKH`, `DIEM`) VALUES
(2, 1, 4),
(5, 1, 3),
(6, 1, 4),
(6, 17, 5),
(8, 1, 4),
(11, 1, 4),
(11, 17, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DANHMUCSACH`
--

CREATE TABLE `DANHMUCSACH` (
  `MADMS` int(11) NOT NULL,
  `TENDMS` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `DANHMUCSACH`
--

INSERT INTO `DANHMUCSACH` (`MADMS`, `TENDMS`) VALUES
(1, 'Văn học Việt Nam'),
(2, 'Văn học Nước Ngoài'),
(3, 'Tham khảo'),
(4, 'Thiếu nhi'),
(5, 'Khoa học tự nhiên - Nhân văn');

--
-- Bẫy `DANHMUCSACH`
--
DELIMITER $$
CREATE TRIGGER `xoasach_dms` BEFORE DELETE ON `DANHMUCSACH` FOR EACH ROW DELETE FROM SACH WHERE MADMS = OLD.MADMS
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `HOADON`
--

CREATE TABLE `HOADON` (
  `MAHD` int(11) NOT NULL,
  `MAKH` int(11) DEFAULT NULL,
  `NGAYHD` date DEFAULT NULL,
  `TONGTIEN` bigint(20) DEFAULT NULL,
  `TENNN` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DIACHI` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SDT` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `HOADON`
--

INSERT INTO `HOADON` (`MAHD`, `MAKH`, `NGAYHD`, `TONGTIEN`, `TENNN`, `DIACHI`, `SDT`, `EMAIL`) VALUES
(8, 1, '2016-12-29', 92000, 'Nguyễn Văn A', 'TPHCM', '090123456', 'user@user.com'),
(9, 1, '2016-12-29', 96000, 'Nguyễn Văn A', 'TPHCM', '090123456', 'user@user.com'),
(11, 17, '2016-12-30', 132400, 'Nguyễn Văn B', 'TPHCM', '1234567', 'user@user.com'),
(17, 1, '2019-02-24', 92000, 'Nguyễn Văn A', 'TPHCM', '1234567', 'user@user.com');

--
-- Bẫy `HOADON`
--
DELIMITER $$
CREATE TRIGGER `xoacthd` BEFORE DELETE ON `HOADON` FOR EACH ROW DELETE FROM CHITIETHOADON WHERE MAHD = OLD.MAHD
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `KHACHHANG`
--

CREATE TABLE `KHACHHANG` (
  `MAKH` int(11) NOT NULL,
  `TENKH` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DIACHI` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SDT` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MATKHAU` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TENTK` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYSINH` date NOT NULL,
  `GIOITINH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `KHACHHANG`
--

INSERT INTO `KHACHHANG` (`MAKH`, `TENKH`, `DIACHI`, `SDT`, `EMAIL`, `MATKHAU`, `TENTK`, `NGAYSINH`, `GIOITINH`) VALUES
(1, 'Nguyễn Văn A', 'TPHCM', '1234567', 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 'user123', '1998-12-01', 1),
(15, 'Nguyễn Văn B', 'TPHCM', '1234567', 'user@user.com', '670b14728ad9902aecba32e22fa4f6bd', 'useruser', '2000-02-01', 1),
(17, 'Nguyễn Văn B', 'TPHCM', '', 'user@user.com', '670b14728ad9902aecba32e22fa4f6bd', 'nguyenvana', '1998-12-01', 1),
(18, 'Nguyễn Văn B', 'TPHCM', '12345678', 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 'user124', '1998-12-01', 1);

--
-- Bẫy `KHACHHANG`
--
DELIMITER $$
CREATE TRIGGER `xoahd` BEFORE DELETE ON `KHACHHANG` FOR EACH ROW DELETE FROM HOADON WHERE MAKH = OLD.MAKH
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `LOAISACH`
--

CREATE TABLE `LOAISACH` (
  `MALOAI` int(11) NOT NULL,
  `TENLOAI` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `LOAISACH`
--

INSERT INTO `LOAISACH` (`MALOAI`, `TENLOAI`) VALUES
(1, 'Tiểu thuyết'),
(2, 'Truyện ngắn'),
(4, 'Đương đại'),
(5, 'Kinh điển'),
(6, 'Truyện tranh'),
(7, 'Phiêu lưu'),
(8, 'Lịch sử'),
(9, 'Trinh thám'),
(10, 'Tâm lý học');

--
-- Bẫy `LOAISACH`
--
DELIMITER $$
CREATE TRIGGER `xoasach_ls` BEFORE DELETE ON `LOAISACH` FOR EACH ROW DELETE FROM SACH WHERE MALOAI = OLD.MALOAI
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `NHAXUATBAN`
--

CREATE TABLE `NHAXUATBAN` (
  `MANXB` int(11) NOT NULL,
  `TENNXB` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DIACHI` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `NHAXUATBAN`
--

INSERT INTO `NHAXUATBAN` (`MANXB`, `TENNXB`, `DIACHI`) VALUES
(1, 'Hội Nhà Văn', ''),
(2, 'Văn Học', NULL),
(4, 'Hà Nội', ''),
(5, 'Kim Đồng', ''),
(6, 'NXB Trẻ', ''),
(7, 'NXB Phụ Nữ', ''),
(8, 'Mỹ thuật', ''),
(9, 'Thế giới', '');

--
-- Bẫy `NHAXUATBAN`
--
DELIMITER $$
CREATE TRIGGER `xoasach_nxb` BEFORE DELETE ON `NHAXUATBAN` FOR EACH ROW DELETE FROM SACH WHERE MANXB = OLD.MANXB
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `SACH`
--

CREATE TABLE `SACH` (
  `MASACH` int(11) NOT NULL,
  `MANXB` int(11) DEFAULT NULL,
  `MALOAI` int(11) DEFAULT NULL,
  `MADMS` int(11) DEFAULT NULL,
  `MATG` int(11) DEFAULT NULL,
  `TENSACH` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GIABAN` bigint(20) DEFAULT NULL,
  `BAIGIOITHIEU` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `HINH` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KICHTHUOC` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SOTRANG` int(11) DEFAULT NULL,
  `SOLUONG` int(11) DEFAULT NULL,
  `CONLAI` int(11) DEFAULT NULL,
  `NGAYXB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `SACH`
--

INSERT INTO `SACH` (`MASACH`, `MANXB`, `MALOAI`, `MADMS`, `MATG`, `TENSACH`, `GIABAN`, `BAIGIOITHIEU`, `HINH`, `KICHTHUOC`, `SOTRANG`, `SOLUONG`, `CONLAI`, `NGAYXB`) VALUES
(1, 1, 1, 1, 1, 'Nhiều sách sống', 46000, '<p>Nhờ l&agrave;m ph&oacute;ng vi&ecirc;n, L&acirc;m L&acirc;m c&oacute; cơ hội bước ch&acirc;n v&agrave;o thế giới của c&aacute;c họa sĩ trẻ ở H&agrave; Nội cũng như TP. Hồ Ch&iacute; Minh, kh&aacute;m ph&aacute; t&aacute;c phẩm v&agrave; con người của họ. Thế giới đ&oacute;, theo cảm nhận của L&acirc;m L&acirc;m, kh&ocirc;ng h&agrave;o nho&aacute;ng như vẻ b&ecirc;n ngo&agrave;i m&agrave; c&oacute; những điều rất ch&acirc;n thực; nhưng cũng kh&ocirc;ng b&igrave;nh lặng như nhiều người tưởng m&agrave; lu&ocirc;n bị khuấy động, hoặc bởi sự đi&ecirc;n rồ của mỗi c&aacute; nh&acirc;n hoặc bởi sự phức tạp của những mối quan hệ rắc rối. C&aacute;c h&igrave;nh thức nghệ thuật mới mẻ của phương T&acirc;y du nhập v&agrave;o Việt Nam sẽ được mi&ecirc;u tả dưới con mắt của một nữ ph&oacute;ng vi&ecirc;n trẻ, sẵn s&agrave;ng tiếp nhận c&aacute;i mới, qua những g&igrave; c&ocirc; thấy được từ c&aacute;c cuộc triển l&atilde;m, tr&igrave;nh diễn chung hoặc t&aacute;c phẩm của bạn m&igrave;nh.</p>', 'nhieu_cach_song-4545454.jpg', '14 x 20,5 cm', 278, 100, 98, '2016-12-02'),
(2, 2, 1, 1, 2, 'Săn cá thần', 85000, '<p>Kịch t&iacute;nh, hoang đường, phi&ecirc;u lưu v&agrave; đượm chất kinh dị, Săn c&aacute; thần l&agrave; kiểu tiểu thuyết m&agrave; khi cầm l&ecirc;n người ta phải đọc cho kỳ hết. Cuộc đi săn trưng ra một hiện thực cuộc sống trần trụi của tiền v&agrave; dục vọng, của những con người hiện đại đầy tự tin, kh&ocirc;ng sợ bất cứ điều g&igrave;, v&agrave; muốn chiếm hữu những thứ &ldquo;đỉnh&rdquo; nhất. Đ&aacute;m người ấy cuối c&ugrave;ng cũng đ&atilde; gi&aacute;p mặt c&aacute; thần, nhưng chỉ để nhận về một nỗi khinh bỉ kh&ocirc;n c&ugrave;ng. Ng&otilde; hầu mỗi ch&uacute;ng ta, trong cuộc sống, chẳng phải đều đang đi săn một con c&aacute; thần n&agrave;o đ&oacute; của ri&ecirc;ng ta, biến cuộc sống của ta th&agrave;nh một cuộc đuổi bắt ham hố nhọc nhằn, m&agrave; kết quả chỉ l&agrave; nỗi nhục nh&atilde; bẽ b&agrave;ng kh&ocirc;ng thể gỡ gạc? Nhưng rồi mọi thứ cũng qua đi, chỉ t&igrave;nh y&ecirc;u v&agrave; vẻ đẹp vĩnh hằng của tự nhi&ecirc;n l&agrave; ở lại.</p>', 'san_ca_than.jpg', '14 x 20.5cm', 324, 100, 100, '2016-12-10'),
(4, 1, 2, 1, 4, 'Nắng trong vườn', 42000, '\"Khi tôi quay lại nhìn chồng nàng, tôi thấy rõ cái lãnh đạm của người đàn ông ấy... Nàng có sung sướng không? Nàng có còn nhớ đến tôi không? Ngậm ngùi, tôi nghĩ đến cuộc ái ân ngắn ngủi...trong mấy tháng hè: cái tình yêu biết đâu chẳng vẫn còn để lại trong lòng nàng một vẻ rực rỡ như ánh nắng trong vườn.\"\r\n', 'nang_trong_vuon-01.jpg', '14.5 x 20.5 cm', 172, 100, 100, NULL),
(5, 1, 4, 2, 5, 'Con của Noé', 59000, '<div style=\"font-family: arial; font-size: 12px; text-align: justify;\">\r\n<div><span style=\"font-weight: bold;\">Sơ lược về t&aacute;c phẩm</span></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>&ldquo;<em style=\"margin: 0px; padding: 0px;\">- Ch&uacute;ng ta sẽ thỏa thuận như n&agrave;y nh&eacute;, con đồng &yacute; kh&ocirc;ng? Con, Joseph, con sẽ giả vờ l&agrave; người C&ocirc;ng gi&aacute;o c&ograve;n ta, ta sẽ giả vờ l&agrave; người Do th&aacute;i&hellip; Đ&acirc;y l&agrave; b&iacute; mật của ch&uacute;ng ta, b&iacute; mật lớn nhất của c&aacute;c b&iacute; mật. Ta v&agrave; con c&oacute; thể chết nếu phản bội b&iacute; mật n&agrave;y nh&eacute;. Thề kh&ocirc;ng n&agrave;o?</em></div>\r\n<div><em style=\"margin: 0px; padding: 0px;\">- Con xin thề.&rdquo;</em></div>\r\n<div>&nbsp;Nơi đ&acirc;y, Joseph đ&atilde; kh&aacute;m ph&aacute; ra t&igrave;nh bạn, kh&aacute;m ph&aacute; ra một thế giới ho&agrave;n to&agrave;n kh&aacute;c với thế giới cậu từng sống, v&agrave; tr&ecirc;n tất cả, những gi&aacute; trị văn h&oacute;a qu&yacute; gi&aacute; của nh&acirc;n loại hiện diện trong những cổ vật cha Pons đang cố gắng lưu giữ. Hai con người, một gi&agrave; một trẻ thuộc hai t&ocirc;n gi&aacute;o kh&aacute;c nhau đi b&ecirc;n nhau để bổ trợ nhau, liệu c&oacute; thể c&ugrave;ng nhau vượt qua cơn đại hồng thủy bạo lực t&agrave;n khốc nhất trong lịch sử lo&agrave;i người?&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Một cuốn tiểu thuyết ngắn đầy x&aacute;o động trong c&ugrave;ng mạch truyện với&nbsp;<em style=\"margin: 0px; padding: 0px;\">Oscar v&agrave; b&agrave; &aacute;o hồng</em>, đ&atilde; đưa Eric-Emmanuel Schmitt trở th&agrave;nh một trong những t&aacute;c gia Ph&aacute;p được đọc nhiều nhất tr&ecirc;n thế giới.</div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"font-weight: bold;\">Nhận định&nbsp;</span></div>\r\n<div>&nbsp;</div>\r\n<div>&ldquo;Eric r&otilde; r&agrave;ng đ&atilde; th&agrave;nh c&ocirc;ng khi &lsquo;buộc&rsquo; độc giả phải cười nghi&ecirc;ng ngả ở một số đoạn xong rồi lại rơm rớm nước mắt được ngay...&rdquo;</div>\r\n<div><em style=\"margin: 0px; padding: 0px;\">- Le T&eacute;l&eacute;gramme</em></div>\r\n<div>&ldquo;Một cuốn tiểu thuyết ngắn nhưng thuần khiết v&agrave; đượm chất triết học...&rdquo;</div>\r\n<div><em style=\"margin: 0px; padding: 0px;\">- La Derni&egrave;re Heure</em></div>\r\n</div>\r\n</div>', 'con_cua_noe-02.jpg', '13 x 20.5 cm', 160, 100, 100, '2016-11-15'),
(6, 1, 5, 2, 6, 'Không gia đình', 77000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-size: medium; color: #ff6600;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Kh&ocirc;ng Gia Đ&igrave;nh</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Remi l&agrave; một đứa trẻ bị bỏ rơi được mẹ Barberin nu&ocirc;i v&agrave; thương y&ecirc;u như con đẻ. Năm l&ecirc;n t&aacute;m, Remi bị l&atilde;o Barberin b&aacute;n cho cụ Vitalis, để c&ugrave;ng đi diễn tr&ograve; rong với con khỉ Joli Coeur v&agrave; ba con ch&oacute; Capi, Zerbino v&agrave; Dolce. Cụ Vitalis vốn l&agrave; một danh ca, rất y&ecirc;u thương y&ecirc;u Remi, r&egrave;n luyện cho em đức t&iacute;nh lao động, tự lập, tự trọng, lại dạy cho em học chữ, học nhạc.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">V&igrave; chống lại t&ecirc;n cảnh s&aacute;t đ&aacute;nh đập Remi, cụ Vitalis phải ở t&ugrave;. Remi một m&igrave;nh cưu mang bốn con vật, may nhờ b&agrave; Milligan v&agrave; đứa con t&agrave;n tật rước l&ecirc;n t&agrave;u Thi&ecirc;n Nga. Ra t&ugrave;, cụ Vitalis nhận lại đo&agrave;n. Nhưng c&aacute;i rủi lại đến &nbsp;hai con ch&oacute; bị s&oacute;i ăn thịt, tiếp đến con khỉ bị cảm lạnh, ốm, chết. Hết tiền, cụ định đi Paris, gửi Remi cho Garofoli, một người nu&ocirc;i trẻ con đi l&agrave;m mướn, trong khi chờ m&igrave;nh dạy lại v&agrave;i con ch&oacute; kh&aacute;c. Thấy t&ecirc;n n&agrave;y qu&aacute; t&agrave;n &aacute;c, cụ lại đưa b&eacute; Remi đi. Đ&oacute;i, r&eacute;t, kiệt sức, cụ chết trước cổng vườn b&aacute;c trồng hoa Acquin.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Remi được b&aacute;c Acquin cứu sống. C&aacute;c con b&aacute;c coi Remi như anh em như anh em v&agrave; Remi lao động, hưởng thụ như họ. Một trận mưa tuyết bất ngờ ập đến trong l&uacute;c cả nh&agrave; vắng mặt l&agrave;m tan t&agrave;nh cơ nghiệp của họ. B&aacute;c Acquin ở t&ugrave; v&igrave; nợ, c&aacute;c con đi ph&acirc;n t&aacute;n lao động để nu&ocirc;i th&acirc;n hoặc nhờ họ h&agrave;ng. Remi lại l&ecirc;n đường với con ch&oacute; v&agrave; c&acirc;y đ&agrave;n..</p>', '8935212320887.jpg', '14.5 x 20.5 cm', 626, 100, 100, '2016-09-01'),
(7, 1, 6, 4, 8, 'Bí mật rất cần bí mật', 28000, '<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Cậu b&eacute; Alfred c&oacute; một b&iacute; mật cực kỳ kh&oacute; chịu về người chủ nh&agrave; đang thu&ecirc; mẹ cậu dọn dẹp. Nếu n&oacute;i ra, mẹ cậu sẽ mất việc; nếu kh&ocirc;ng n&oacute;i, cậu phải tiếp tục sự chịu đựng kinh khủng.</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\"><strong style=\"padding: 0px; margin: 0px;\">C&oacute; những&nbsp;B&Iacute; MẬT rất cần BẬT M&Iacute;!</strong></p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\"><em style=\"padding: 0px; margin: 0px;\">Rất nhiều khi kẻ lạm dụng trẻ em ch&iacute;nh l&agrave; những người quen. Rất nhiều trường hợp, trẻ kh&ocirc;ng d&aacute;m n&oacute;i r&otilde; b&iacute; mật với ch&iacute;nh bố mẹ m&igrave;nh.&nbsp;Cuốn s&aacute;ch n&agrave;y cung cấp kỹ năng cần thiết để trẻ tự bảo vệ bản th&acirc;n, s&aacute;ch c&ograve;n khuyến kh&iacute;ch trẻ l&ecirc;n tiếng.</em></p>', 'MIGLD8LB.jpg', '16 x 24 cm', 40, 100, 100, '2016-05-25'),
(8, 2, 5, 2, 9, 'Đồi gió hú', 79200, '<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\"><strong style=\"padding: 0px; margin: 0px;\">Sơ lược về t&aacute;c phẩm</strong></div>\r\n<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">\r\n<div style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\"><strong style=\"padding: 0px; margin: 0px;\">Đồi gi&oacute; h&uacute;</strong></em>, c&acirc;u chuyện cổ điển về t&igrave;nh y&ecirc;u ngang tr&aacute;i v&agrave; tham vọng chiếm hữu, cuốn tiểu thuyết dữ dội v&agrave; b&iacute; ẩn về Catherine Earnshaw, c&ocirc; con g&aacute;i nổi loạn của gia đ&igrave;nh Earnshaw, với g&atilde; đ&agrave;n &ocirc;ng th&ocirc; r&aacute;p v&agrave; đi&ecirc;n rồ m&agrave; cha c&ocirc; mang về nh&agrave; rồi đặt t&ecirc;n l&agrave; Heathcliff, được tr&igrave;nh diễn tr&ecirc;n c&aacute;i nền những đồng tru&ocirc;ng, quả đồi nước Anh c&ocirc; quạnh v&agrave; ban sơ kh&ocirc;ng k&eacute;m g&igrave; ch&iacute;nh t&igrave;nh y&ecirc;u của họ. Từ nhỏ đến lớn, sự gắn b&oacute; của họ ng&agrave;y c&agrave;ng trở n&ecirc;n &aacute;m ảnh. Gia đ&igrave;nh, địa vị x&atilde; hội, v&agrave; cả số phận rắp t&acirc;m chống lại họ, bản t&iacute;nh dữ dội v&agrave; ghen tu&ocirc;ng tột độ cũng hủy diệt họ, vậy n&ecirc;n to&agrave;n bộ thời gian hai con người y&ecirc;u nhau đ&oacute; đ&atilde; sống trong th&ugrave; hận v&agrave; tuyệt vọng, m&agrave; c&aacute;i chết chỉ c&oacute; &yacute; nghĩa khởi đầu. Một khởi đầu mới để hai linh hồn m&atilde;nh liệt đ&oacute; được tự do t&aacute;i ngộ, khi những cơn gi&oacute; hoang vắng v&agrave; đi&ecirc;n cuồng tr&agrave;n về quanh c&aacute;c l&acirc;u đ&agrave;i trong Đồi gi&oacute; h&uacute;...</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">Cuốn tiểu thuyết duy nhất của Emily Bront&euml;, l&agrave; cuốn s&aacute;ch đ&atilde; tới tay c&ocirc;ng ch&uacute;ng với nhiều lời b&igrave;nh tr&aacute;i ngược v&agrave;o năm 1847, một năm trước khi nữ t&aacute;c giả qua đời ở tuổi ba mươi. Th&ocirc;ng qua mối t&igrave;nh giũa Cathy v&agrave; Heathcliff, với bối cảnh l&agrave; đồng qu&ecirc; Yorkshire hoang vu trống trải, Đồi gi&oacute; h&uacute; đ&atilde; tạo n&ecirc;n cả một thế giới ri&ecirc;ng với xu hướng bỏ qua lề th&oacute;i, vươn tới thi ca cũng như tới những chiều s&acirc;u tăm tối của l&ograve;ng người, gi&uacute;p t&aacute;c phẩm trở th&agrave;nh một trong những tiểu thuyết vĩ đại nhất, bi thương nhất m&agrave; con người từng viết ra về nỗi đam m&ecirc; ch&aacute;y bỏng.</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><strong style=\"padding: 0px; margin: 0px;\">Nhận định</strong></div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">\"Tựa như Emily Bront&euml; c&oacute; thể mở toang những g&igrave; thuộc về con người, v&agrave; lấp đầy những khoảng trống kh&ocirc;ng thể nh&igrave;n ra được bằng một luồng gi&oacute; mạnh của cuộc đời.&rdquo;</div>\r\n<div class=\"rteright\" style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">- Virginia Woolt</em></div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><strong style=\"padding: 0px; margin: 0px;\">\"Đồi gi&oacute; h&uacute;</strong>&nbsp;l&agrave; tiểu thuyết duy nhất của Emily Bront<em style=\"padding: 0px; margin: 0px;\">&euml;</em>, người đ&atilde; chết ngay sau khi t&aacute;c phẩm được xuất bản, ở tuổi ba mươi. Một c&acirc;u chuyện u sầu v&ugrave;ng Yorrkshire về một mối t&igrave;nh mạnh hơn cả c&aacute;i chết, cũng l&agrave; một c&aacute;i nh&igrave;n dữ dội về dục vọng si&ecirc;u h&igrave;nh m&agrave; theo đ&oacute;, cả thi&ecirc;n đường, địa ngục, thi&ecirc;n nhi&ecirc;n v&agrave; x&atilde; hội c&ugrave;ng gắn b&oacute; m&atilde;nh liệt. Độc nhất, huyền b&iacute;, với một văn phong phi thời, tiểu thuyết đ&atilde; trở th&agrave;nh t&aacute;c phẩm kinh điển của văn học Anh.&rdquo;</div>\r\n<div style=\"padding: 0px; margin: 0px;\" align=\"right\"><em style=\"padding: 0px; margin: 0px;\">- The Oxford University Press</em></div>\r\n</div>', 'H23MBK4G.jpg', '13 x 20,5 cm', 492, 100, 100, '2016-08-31'),
(10, 1, 5, 2, 11, 'Hoàng tử bé', 48000, '<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\"><strong style=\"padding: 0px; margin: 0px;\">Sơ lược về t&aacute;c phẩm</strong></div>\r\n<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">&nbsp;</div>\r\n<div class=\"rtecenter\" style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">LẦN ĐẦU TI&Ecirc;N C&Oacute; BẢN QUYỀN CH&Iacute;NH THỨC TẠI VIỆT NAM</div>\r\n<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px; color: #333344; font-family: arial;\">\r\n<div style=\"padding: 0px; margin: 0px;\">\r\n<div style=\"padding: 0px; margin: 0px;\"><strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;&nbsp;</strong>được viết ở New York trong những ng&agrave;y t&aacute;c giả sống lưu vong v&agrave; được xuất bản lần đầu ti&ecirc;n tại New York v&agrave;o năm 1943, rồi đến năm 1946 mới được xuất bản tại Ph&aacute;p. Kh&ocirc;ng nghi ngờ g&igrave;, đ&acirc;y l&agrave; t&aacute;c phẩm nổi tiếng nhất, được đọc nhiều nhất v&agrave; cũng được y&ecirc;u mến nhất của Saint-Exup&eacute;ry. Cuốn s&aacute;ch được b&igrave;nh chọn l&agrave; t&aacute;c phẩm hay nhất thế kỉ 20 ở Ph&aacute;p, đồng thời cũng l&agrave; cuốn s&aacute;ch Ph&aacute;p được dịch v&agrave; được đọc nhiều nhất tr&ecirc;n thế giới. Với 250 ng&ocirc;n ngữ dịch kh&aacute;c nhau kể cả phương ngữ c&ugrave;ng hơn 200 triệu bản in tr&ecirc;n to&agrave;n thế giới,&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;</strong>&nbsp;được coi l&agrave; một trong những t&aacute;c phẩm b&aacute;n chạy nhất của nh&acirc;n loại.&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">Ở Việt Nam,&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;</strong>&nbsp;được dịch v&agrave; xuất bản kh&aacute; sớm. Từ năm 1966 đ&atilde; c&oacute; &nbsp;đồng thời hai bản dịch:&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;&nbsp;</strong>của B&ugrave;i Gi&aacute;ng do An Ti&ecirc;m xuất bản v&agrave;&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Cậu ho&agrave;ng con</strong>&nbsp;của Trần Thiện Đạo do Khai Tr&iacute; xuất bản. Từ đ&oacute; đến nay đ&atilde; c&oacute; th&ecirc;m nhiều bản dịch&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;&nbsp;</strong>mới của c&aacute;c dịch giả kh&aacute;c nhau. Bản dịch&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;</strong>&nbsp;lần n&agrave;y, xuất bản nh&acirc;n dịp kỷ niệm 70 năm&nbsp;<strong style=\"padding: 0px; margin: 0px;\">Ho&agrave;ng tử b&eacute;</strong>&nbsp;ra đời, cũng l&agrave; ấn bản đầu ti&ecirc;n được Gallimard ch&iacute;nh thức chuyển nhượng bản quyền tại Việt Nam, hy vọng sẽ g&oacute;p phần l&agrave;m phong ph&uacute; th&ecirc;m việc dịch v&agrave; tiếp nhận t&aacute;c phẩm quan trọng n&agrave;y với c&aacute;c thế hệ độc giả.&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">\r\n<div style=\"padding: 0px; margin: 0px;\">\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">T&ocirc;i cứ sống c&ocirc; độc như vậy, chẳng c&oacute; một ai để chuyện tr&ograve; thật sự, cho tới một lần gặp nạn ở sa mạc Sahara c&aacute;ch đ&acirc;y s&aacute;u năm. C&oacute; thứ g&igrave; đ&oacute; bị vỡ trong động cơ m&aacute;y bay. V&agrave; v&igrave; ở b&ecirc;n cạnh chẳng c&oacute; thợ m&aacute;y cũng như h&agrave;nh kh&aacute;ch n&agrave;o n&ecirc;n một m&igrave;nh t&ocirc;i sẽ phải cố m&agrave; sửa cho bằng được vụ hỏng h&oacute;c nan giải n&agrave;y. Với t&ocirc;i đ&oacute; thật l&agrave; một việc sống c&ograve;n. T&ocirc;i chỉ c&oacute; vừa đủ nước để uống trong t&aacute;m ng&agrave;y.</em></div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">Thế l&agrave; đ&ecirc;m đầu ti&ecirc;n t&ocirc;i ngủ tr&ecirc;n c&aacute;t, c&aacute;ch mọi chốn c&oacute; người ở cả ngh&igrave;n dặm xa. T&ocirc;i c&ocirc; đơn hơn cả một kẻ đắm t&agrave;u sống s&oacute;t tr&ecirc;n b&egrave; giữa đại dương. Thế n&ecirc;n c&aacute;c bạn cứ tưởng tượng t&ocirc;i đ&atilde; ngạc nhi&ecirc;n l&agrave;m sao, khi &aacute;nh ng&agrave;y vừa rạng, th&igrave; một giọng n&oacute;i nhỏ nhẹ lạ l&ugrave;ng đ&atilde; đ&aacute;nh thức t&ocirc;i. Giọng ấy n&oacute;i:</em></div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">&ldquo;&Ocirc;ng l&agrave;m ơn&hellip; vẽ cho t&ocirc;i một con cừu!&rdquo;</em></div>\r\n</div>\r\n</div>\r\n<div class=\"rteright\" style=\"padding: 0px; margin: 0px;\">- Tr&iacute;ch \"Ho&agrave;ng tử b&eacute;\"</div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\"><strong style=\"padding: 0px; margin: 0px;\">Nhận định</strong></div>\r\n<div style=\"padding: 0px; margin: 0px;\">&nbsp;</div>\r\n<div style=\"padding: 0px; margin: 0px;\">\r\n<div style=\"padding: 0px; margin: 0px;\">\r\n<div style=\"padding: 0px; margin: 0px;\">&ldquo;Đ&acirc;y l&agrave; một c&acirc;u chuyện tự n&oacute; đ&atilde; rất đ&aacute;ng y&ecirc;u, ẩn giấu một triết l&yacute; qu&aacute; đỗi nhẹ nh&agrave;ng v&agrave; thi vị.&rdquo;</div>\r\n<div class=\"rteright\" style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">- The New York Times</em></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'hoang_tu_be.jpg', '15 x 23 cm', 104, 100, 98, '2013-05-09'),
(11, 2, 7, 2, 12, 'Những Cuộc Phiêu Lưu Của Tom Sawyer (Tái Bản)', 50400, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; color: #ff6600;\"><strong style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-size: medium;\">Những Cuộc Phi&ecirc;u Lưu Của Tom Sawyer (T&aacute;i Bản)</span></strong></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-size: small;\">Với bản t&iacute;nh hiếu động, Tom Sawyer kh&ocirc;ng l&uacute;c n&agrave;o chịu y&ecirc;n. Ch&uacute; quậy ph&aacute; đủ tr&ograve; tai qu&aacute;i từ trốn học, lừa bạn b&egrave; sơn h&agrave;ng r&agrave;o, cầm đầu lũ trẻ đ&aacute;nh nhau cho đến chữa mụn c&oacute;c ngo&agrave;i nghĩa trang,&nbsp;</span>\"<span style=\"box-sizing: border-box; font-size: small;\">đ&iacute;nh h&ocirc;n</span>\"<span style=\"box-sizing: border-box; font-size: small;\">&nbsp;với c&ocirc; bạn Becky, hay ra đảo sống đời cướp biển. Thế nhưng, cũng trong những chuyến phi&ecirc;u lưu ấy, Tom v&agrave; bạn b&egrave; đ&atilde; kh&aacute;m ph&aacute; ra một vụ giết người, ph&aacute; tan &acirc;m mưu của to&aacute;n cướp, cứu được Becky, t&igrave;m thấy kho b&aacute;u v&agrave; trở th&agrave;nh anh h&ugrave;ng của thị trấn.</span><br style=\"box-sizing: border-box;\" /><br style=\"box-sizing: border-box;\" /><span style=\"box-sizing: border-box; font-size: small;\">To&agrave;n bộ t&aacute;c phẩm&nbsp;<strong style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\">Những Cuộc Phi&ecirc;u Lưu Của Tom Sawyer</span></strong>&nbsp;tắm trong một kh&ocirc;ng kh&iacute; hoạt n&aacute;o, tươi vui v&agrave; lấp l&aacute;nh những m&agrave;u sắc rực rỡ của trẻ em. T&agrave;i kể chuyện của&nbsp;<strong style=\"box-sizing: border-box;\">Mark Twain</strong>&nbsp;khiến người đọc vừa bị cuốn h&uacute;t, vừa lo &acirc;u đồng thời li&ecirc;n tục bật cười trước những t&igrave;nh huống kịch t&iacute;nh li&ecirc;n tiếp. T&aacute;c giả c&ograve;n lồng v&agrave;o những đoạn văn ch&acirc;m biếm x&atilde; hội v&ocirc; c&ugrave;ng h&agrave;i hước v&agrave; s&acirc;u sắc. Tr&ecirc;n hết, &ocirc;ng mi&ecirc;u tả xuất sắc t&iacute;nh c&aacute;ch, t&acirc;m l&yacute;, h&agrave;nh động của một Tom Sawyer th&ocirc;ng minh, nghịch ngợm nhưng dũng cảm v&agrave; c&oacute; một tấm l&ograve;ng nh&acirc;n hậu, gi&agrave;u t&igrave;nh nghĩa.</span><br style=\"box-sizing: border-box;\" /><br style=\"box-sizing: border-box;\" /><span style=\"box-sizing: border-box; font-size: small;\">Từ khi ra đời cho đến nay, Tom Sawyer đ&atilde; trở th&agrave;nh người bạn th&acirc;n thiết của c&aacute;c thế hệ trẻ em tr&ecirc;n khắp thế giới. T&aacute;c phẩm n&agrave;y cũng nhiều lần được chuyển thể th&agrave;nh phim v&agrave; hoạt h&igrave;nh tại nhiều quốc gia.</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><strong style=\"box-sizing: border-box;\">T&aacute;c giả:&nbsp;</strong><br style=\"box-sizing: border-box;\" /><br style=\"box-sizing: border-box;\" /><span style=\"box-sizing: border-box; font-size: small;\"><strong style=\"box-sizing: border-box;\">Mark Twain&nbsp;<strong style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\">(1835 - 1910)&nbsp;</span></strong></strong>t&ecirc;n thật l&agrave; Samuel Langhorne Clemens, sinh tại Florida, thuộc tiểu bang Missouri, Mỹ.</span><br style=\"box-sizing: border-box;\" /><br style=\"box-sizing: border-box;\" /><span style=\"box-sizing: border-box; font-size: small;\">Sau khi tham gia qu&acirc;n đội miền Nam trong thời nội chiến Mỹ v&agrave; trải qua nhiều nghề kh&aacute;c nhau, năm 1863, &ocirc;ng bắt đầu viết văn, d&ugrave;ng b&uacute;t danh&nbsp;</span>\"<span style=\"box-sizing: border-box; font-size: small;\">Mark Twain</span>\"<span style=\"box-sizing: border-box; font-size: small;\">, c&oacute; nghĩa l&agrave;&nbsp;</span>\"<span style=\"box-sizing: border-box; font-size: small;\">s&acirc;u hai sải</span>\"<span style=\"box-sizing: border-box; font-size: small;\">, bắt&nbsp; nguồn từ kỉ niệm l&aacute;i t&agrave;u tr&ecirc;n s&ocirc;ng Mississippi.</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-size: small;\"><strong style=\"box-sizing: border-box;\">Mark Twain&nbsp;</strong>để lại một sự nghiệp đồ sộ gồm nhiều tiểu thuyết</span>,<span style=\"box-sizing: border-box; font-size: small;\"> truyện ngắn, tiểu luận ch&acirc;m biếm ch&iacute;nh trị&hellip;, trong đ&oacute; c&oacute; Những cuộc phi&ecirc;u lưu của Tom Sawyer (tiểu thuyết, 1876), Ho&agrave;ng tử t&iacute; hon v&agrave; ch&uacute; b&eacute; ngh&egrave;o khổ (tiểu thuyết, 1882), Những cuộc phi&ecirc;u lưu của Huck Finn (tiểu thuyết, 1885)&hellip;</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><br style=\"box-sizing: border-box;\" /><span style=\"box-sizing: border-box; font-size: small;\"><strong style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\">Những Cuộc Phi&ecirc;u Lưu Của Tom Sawyer</span></strong>&nbsp;được coi l&agrave; t&aacute;c phẩm th&agrave;nh c&ocirc;ng nhất của Mark Twain. C&acirc;u chuyện hấp dẫn v&agrave; sự h&agrave;i hước kh&oacute; qu&ecirc;n khiến tiểu thuyết n&agrave;y trở th&agrave;nh cuốn s&aacute;ch gối đầu giường của nhiều thế hệ thiếu nhi tại Mỹ v&agrave; tr&ecirc;n thế giới.</span></p>', 'cuoc-phieu-luu-cua-tom-sawyer.jpg', '13.5 x 20.5 cm', 396, 100, 99, '2012-05-01'),
(12, 2, 5, 2, 13, 'Giết con chim nhại', 82000, '<div style=\"font-family: arial; font-size: 12px; text-align: justify;\"><span style=\"font-weight: bold;\">Sơ lược về t&aacute;c phẩm</span></div>\r\n<div style=\"font-family: arial; font-size: 12px; text-align: justify;\">&nbsp;</div>\r\n<div style=\"font-family: arial; font-size: 12px; text-align: justify;\"><span style=\"font-family: Arial; font-size: 10pt;\">N&agrave;o, h&atilde;y mở cuốn s&aacute;ch n&agrave;y ra. Bạn phải l&agrave;m quen ngay với bố Atticus của hai anh em - Jem v&agrave; Scout, &ocirc;ng bố luật sư c&oacute; một c&aacute;ch ri&ecirc;ng, để những đứa trẻ của m&igrave;nh cứng c&aacute;p v&agrave; vững v&agrave;ng hơn khi đ&oacute;n nhận những bức x&uacute;c kh&ocirc;ng sao hiểu nổi trong cuộc sống. Bạn sẽ nhớ rất l&acirc;u người đ&agrave;n &ocirc;ng th&iacute;ch trốn trong nh&agrave; Boo Radley, kẻ bị đ&aacute;m đ&ocirc;ng coi l&agrave; lập dị đ&atilde; chọn một c&aacute;ch rất ri&ecirc;ng để gửi những m&oacute;n qu&agrave; nhỏ cho Jem v&agrave; Scout, v&agrave; khi ch&uacute;ng l&acirc;m nguy, đ&atilde; đột nhi&ecirc;n xuất hiện để che chở. V&agrave; tất nhi&ecirc;n, bạn kh&ocirc;ng thể bỏ qua anh ch&agrave;ng Tom Robinson, kẻ bị kết &aacute;n tử h&igrave;nh v&igrave; tội h&atilde;m hiếp một c&ocirc; g&aacute;i da trắng, sự thật th&agrave; v&agrave; suy nghĩ qu&aacute; đỗi đơn giản của anh lại dẫn đến một c&aacute;i kết hết sức đau l&ograve;ng, chỉ v&igrave; l&yacute; do anh l&agrave; một người da đen.</span><br style=\"font-family: Arial;\" /><br style=\"font-family: Arial;\" /><span style=\"font-family: Arial; font-size: 10pt;\">Cho d&ugrave; được kể dưới g&oacute;c nh&igrave;n của một c&ocirc; b&eacute;, cuốn s&aacute;ch&nbsp;</span><span style=\"font-style: italic; font-family: Arial; font-size: 10pt;\">Giết con chim nhại</span><span style=\"font-family: Arial; font-size: 10pt;\">&nbsp;</span><span style=\"font-family: Arial; font-size: 10pt;\">kh&ocirc;ng n&eacute; tr&aacute;nh bất kỳ&nbsp;</span><span style=\"font-size: 10pt;\"><span style=\"font-family: Arial; font-size: 10pt;\">vấn đề n&agrave;o, gai g&oacute;c hay lớn lao, s&acirc;u xa hay phức tạp: nạn ph&acirc;n biệt chủng tộc, những định kiến khắt khe, sự trọng nam khinh nữ&hellip; G&oacute;c nh&igrave;n trẻ thơ l&agrave; một dấu ấn đậm n&eacute;t v&agrave; cũng l&agrave; đặc sắc trong&nbsp;</span><em style=\"margin: 0px; padding: 0px; font-family: Arial;\">Giết con chim nhại</em><span style=\"font-family: Arial; font-size: 10pt;\">. Trong s&aacute;ng, hồn nhi&ecirc;n v&agrave; đầy cảm x&uacute;c, những c&acirc;u chuyện tưởng như chẳng c&oacute; g&igrave; to t&aacute;t gieo v&agrave;o người đọc hạt mầm y&ecirc;u thương.</span><br style=\"font-family: Arial;\" /><br style=\"font-family: Arial;\" /><span style=\"font-family: Arial; font-size: 10pt;\">Gần 50 năm từ ng&agrave;y đầu ra&nbsp;<span style=\"font-size: 10pt;\">mắt,</span><em style=\"margin: 0px; padding: 0px;\">&nbsp;Giết con chim nhại</em><span style=\"font-size: 10pt;\">,&nbsp;</span>t&aacute;c phẩm đầu tay v&agrave; cũng l&agrave; cuối c&ugrave;ng của nữ nh&agrave; văn Mỹ Harper Lee vẫn đầy sức h&uacute;t với độc giả ở nhiều lứa tuổi. Th&ocirc;ng điệp y&ecirc;u thương trải khắp c&aacute;c chương s&aacute;ch l&agrave; một trong những l&yacute; do khiến&nbsp;</span><em style=\"margin: 0px; padding: 0px; font-family: Arial;\">Giết con chim nhại</em><span style=\"font-family: Arial; font-size: 10pt;\">&nbsp;giữ sức</span></span><span style=\"font-family: Arial; font-size: 10pt;\">&nbsp;sống l&acirc;u bền của m&igrave;nh trong tr&aacute;i tim độc giả ở nhiều quốc gia, nhiều thế hệ. Những độc giả nh&iacute; t&igrave;m cho m&igrave;nh c&aacute;c tr&ograve; nghịch ngợm v&agrave; c&aacute;ch nh&igrave;n d&iacute; dỏm về thế giới xung quanh. Người lớn lại t&igrave;m ra điều th&uacute; vị s&acirc;u xa trong t&igrave;nh cha con nh&agrave; Atticus, v&agrave; đặc biệt l&agrave; t&igrave;nh người trong cuộc sống, như b&eacute; Scout quả quyết n&oacute;i &ldquo;em nghĩ chỉ c&oacute; một hạng người. Đ&oacute; l&agrave; người&rdquo;.</span></div>', 'giet_con_chim_nhai_0.jpg', '14 x 20,5 cm', 492, 100, 99, '0000-00-00'),
(13, 4, 8, 5, 14, 'Hà Nội thanh lịch', 52000, '<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">&ldquo;C&aacute;c d&atilde;y l&agrave;ng quanh th&agrave;nh c&oacute; t&ecirc;n l&agrave; Kẻ Bưởi, Kẻ Mọc, Kẻ Lủ, Kẻ Mơ, th&igrave; b&agrave; con n&ocirc;ng th&ocirc;n cũng hay gọi H&agrave; Nội l&agrave; &ldquo;Kẻ Chợ&rdquo;. V&igrave; l&agrave; kẻ chợ, n&ecirc;n lịch l&atilde;m c&oacute; khi h&oacute;a ra k&ecirc;nh kiệu, bu&ocirc;n b&aacute;n cũng c&oacute; l&uacute;c l&aacute; phải, l&aacute; tr&aacute;i.</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Nhưng &lsquo;người Tr&agrave;ng An&rsquo; r&otilde; r&agrave;ng l&agrave; người cần c&ugrave;, cứng rắn, vẻ thanh lịch, đ&ocirc;i l&uacute;c h&agrave;o hoa, y&ecirc;u văn, y&ecirc;u hoa, s&agrave;nh mỹ thuật, ăn mặc đơn sơ v&agrave; trang nh&atilde;, n&oacute;i lời văn vẻ dễ nghe, dễ h&ograve;a hợp với b&agrave; con phường, x&oacute;m, hay động l&ograve;ng v&igrave; việc nghĩa, t&igrave;nh người, gh&eacute;t cay gh&eacute;t đắng những chuyện tục tằn kệch cỡm, hoạnh họe, lố lăng, đ&ecirc; tiện. Người Tr&agrave;ng An ở với nhau, &lsquo;biết nhịn&rsquo;, &lsquo;biết nể&rsquo;, &lsquo;biết ngượng&rsquo;, &lsquo;suy bụng ta ra bụng người&rsquo;. Trong th&ocirc;n phố, c&oacute; việc l&agrave; chạy sang thăm hỏi ngay, ở với nhau chu tất, ăn &yacute;, kh&ocirc;ng &lsquo;bỏ được l&ograve;ng nhau&rsquo; [...]&nbsp;</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Kh&aacute;ch nh&agrave; qu&ecirc; ra, đi m&atilde;i, n&oacute;ng, nhọc th&igrave; thấy ngay b&ecirc;n đường một vại nước vối ngon với mấy c&aacute;i b&aacute;t sạch. Người ta t&oacute;m cả c&aacute;i thanh, c&aacute;i cao, c&aacute;i lịch sự, ẩn &yacute; v&agrave;o hai chữ &lsquo;thanh lịch&rsquo;.</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">V&agrave; khi đ&oacute;n b&agrave; con c&aacute;c tỉnh về, tiếp c&aacute;c kh&aacute;ch phương xa đến, người ta nhắc nhau giữ lấy &lsquo;vẻ thanh lịch của người Tr&agrave;ng An&rsquo;.&rdquo;</p>', 'O8CB2F9T.jpg', '14 x 20,5', 280, 100, 100, '2016-10-07'),
(14, 2, 1, 2, 15, 'Trăm Năm Cô Đơn', 83000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-size: medium; color: #ff6600;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Trăm Năm C&ocirc; Đơn</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Cho đến nay&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Trăm Năm C&ocirc; Đơn</span>&nbsp;vẫn l&agrave; cuốn&nbsp;tiểu thuyết lớn nhất của Gabriel Garcia M&aacute;rquez, nh&agrave; văn Columbia, người được giải Nobel về văn học năm 1982.&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Trăm Năm C&ocirc; Đơn</span>&nbsp;ra đời (1967) đ&atilde; g&acirc;y dư luận s&ocirc;i nổi tr&ecirc;n văn đ&agrave;n Mỹ Latinh v&agrave; lập tức được cả thế giới h&acirc;m mộ. Sau gần hai mươi năm, Trăm Năm C&ocirc; Đơn đ&atilde; c&oacute; mặt ở khắp nơi tr&ecirc;n h&agrave;nh tinh ch&uacute;ng ta để đến với mọi người v&agrave; mọi nh&agrave;.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Trăm Năm C&ocirc; Đơn</span>&nbsp;l&agrave; lời k&ecirc;u gọi mọi người h&atilde;y sống đ&uacute;ng bản chất người - tổng h&ograve;a c&aacute;c mối quan hệ x&atilde; hội - của m&igrave;nh, h&atilde;y vượt qua mọi định kiến, th&agrave;nh kiến c&aacute; nh&acirc;n, h&atilde;y lấp bằng mọi hố ngăn c&aacute;ch c&aacute; nh&acirc;n để c&aacute; nh&acirc;n m&igrave;nh tự h&ograve;a đồng với gia đ&igrave;nh, với cộng đồng x&atilde; hội. V&igrave; lẽ đ&oacute; Garcia M&aacute;rquez từng tuy&ecirc;n bố cuốn s&aacute;ch m&agrave; &ocirc;ng để cả đời s&aacute;ng t&aacute;c l&agrave; cuốn s&aacute;ch về c&aacute;i c&ocirc; đơn v&agrave; th&ocirc;ng qua c&aacute;i c&ocirc; đơn &ocirc;ng k&ecirc;u gọi mọi người đo&agrave;n kết, đo&agrave;n kết để đấu tranh, đo&agrave;n kết để chiến thắng t&igrave;nh trạng chậm ph&aacute;t triển của Mỹ Latinh, đo&agrave;n kết để s&aacute;ng tạo ra một thi&ecirc;n huyền thoại kh&aacute;c hẳn. Một huyền thoại mới, hấp dẫn của cuộc sống, nơi kh&ocirc;ng ai bị kẻ kh&aacute;c định đoạt số phận m&igrave;nh ngay cả c&aacute;i c&aacute;ch thức chết, nơi&nbsp;t&igrave;nh y&ecirc;u c&oacute; lối tho&aacute;t v&agrave; hạnh ph&uacute;c l&agrave; c&aacute;i c&oacute; khả năng thực sự, v&agrave; nơi những d&ograve;ng họ bị kết &aacute;n trăm năm c&ocirc; đơn cuối c&ugrave;ng v&agrave; m&atilde;i m&atilde;i sẽ c&oacute; vận may lần thứ hai để t&aacute;i sinh tr&ecirc;n mặt đất n&agrave;y.</p>', 'img196.u2377.d20161123.t143408.427556.jpg', '13.5 x 20.5 cm', 350, 100, 100, '2016-09-01'),
(15, 2, 1, 2, 16, 'Nhà giả kim', 44000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Tất cả những trải nghiệm trong chuyến phi&ecirc;u du theo đuổi vận mệnh của m&igrave;nh đ&atilde; gi&uacute;p Santiago thấu hiểu được &yacute; nghĩa s&acirc;u xa nhất của hạnh ph&uacute;c, h&ograve;a hợp với vũ trụ v&agrave; con người.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Tiểu thuyết&nbsp;</span><span style=\"box-sizing: border-box; font-weight: bold;\">Nh&agrave; giả kim&nbsp;</span>của&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Paulo Coelho&nbsp;</span>như một c&acirc;u chuyện cổ t&iacute;ch giản dị, nh&acirc;n &aacute;i, gi&agrave;u chất thơ, thấm đẫm những minh triết huyền b&iacute; của phương Đ&ocirc;ng. Trong lần xuất bản đầu ti&ecirc;n tại Brazil v&agrave;o năm 1988, s&aacute;ch chỉ b&aacute;n được 900 bản. Nhưng, với số phận đặc biệt của cuốn s&aacute;ch d&agrave;nh cho to&agrave;n nh&acirc;n loại, vượt ra ngo&agrave;i bi&ecirc;n giới quốc gia,&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Nh&agrave; giả kim&nbsp;</span>đ&atilde; l&agrave;m rung động h&agrave;ng triệu t&acirc;m hồn, trở th&agrave;nh một trong những cuốn s&aacute;ch b&aacute;n chạy nhất mọi thời đại, v&agrave; c&oacute; thể l&agrave;m thay đổi cuộc đời người đọc.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&ldquo;Nhưng nh&agrave; luyện kim đan kh&ocirc;ng quan t&acirc;m mấy đến những điều ấy. &Ocirc;ng đ&atilde; từng thấy nhiều người đến rồi đi, trong khi ốc đảo v&agrave; sa mạc vẫn l&agrave; ốc đảo v&agrave; sa mạc. &Ocirc;ng đ&atilde; thấy vua ch&uacute;a v&agrave; kẻ ăn xin đi qua biển c&aacute;t n&agrave;y, c&aacute;i biển c&aacute;t thường xuy&ecirc;n thay h&igrave;nh đổi dạng v&igrave; gi&oacute; thổi nhưng vẫn m&atilde;i m&atilde;i l&agrave; biển c&aacute;t m&agrave; &ocirc;ng đ&atilde; biết từ thuở nhỏ. Tuy vậy, tự đ&aacute;y l&ograve;ng m&igrave;nh, &ocirc;ng kh&ocirc;ng thể kh&ocirc;ng cảm thấy vui trước hạnh ph&uacute;c của mỗi người lữ kh&aacute;ch, sau bao ng&agrave;y chỉ c&oacute; c&aacute;t v&agrave;ng với trời xanh nay được thấy ch&agrave; l&agrave; xanh tươi hiện ra trước mắt. &lsquo;C&oacute; thể Thượng đế tạo ra sa mạc chỉ để cho con người biết qu&yacute; trọng c&acirc;y ch&agrave; l&agrave;,&rsquo; &ocirc;ng nghĩ.&rdquo;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">-&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Tr&iacute;ch Nh&agrave; giả kim</span></p>', 'nha-gia-kim.u84.d20161102.t102644.515752.jpg', '13 x 20.5 cm', 228, 100, 100, '2013-10-01'),
(16, 5, 6, 4, 17, 'Thám Tử Lừng Danh Conan (Tập 81)', 18000, '<p><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Giữa l&uacute;c cuộc điều tra vụ &aacute;n kẻ m&oacute;c t&uacute;i thuộc băng Kurobee đang diễn ra, những hồi ức về Akai chợt hiện l&ecirc;n sống động trong t&acirc;m tr&iacute; Jodie... Ẩn sau vụ &aacute;n, hoạt động b&iacute; mật g&igrave; đang được thực hiện? Cũng trong tập n&agrave;y, mời c&aacute;c bạn c&ugrave;ng kh&aacute; ph&aacute; vụ &aacute;n c&acirc;y phi ti&ecirc;u cứng với sự trở lại của th&aacute;m tử Kogoro sau một thời gian vắng b&oacute;ng, vụ điều tra ngoại t&igrave;nh dần l&agrave;m s&aacute;ng tỏ b&iacute; mật của Sera, v&agrave; vụ &aacute;n chết đuối trong nh&agrave; vệ sinh di động tới cuộc chạm tr&aacute;n giữa Sera v&agrave; kyogoku nh&eacute;!</span></p>', 'img358_1_3.jpg', '13 x 18 cm', 220, 100, 100, '2015-04-01'),
(17, 5, 6, 4, 18, 'Doraemon - Chú Mèo Máy Đến Từ Tương Lai (Tập 20)', 16000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; color: #ff6600; font-size: medium;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Doraemon - Ch&uacute; M&egrave;o M&aacute;y Đến Từ Tương Lai (Tập 20)</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Những c&acirc;u chuyện về ch&uacute; m&egrave;o m&aacute;y th&ocirc;ng minh Doraemon v&agrave; nh&oacute;m bạn Nobita, Shizuka, Suneo, Jaian, Dekisugi sẽ đưa ch&uacute;ng ta bước v&agrave;o thế giới hồn nhi&ecirc;n, trong s&aacute;ng đầy ắp tiếng cười với một kho bảo bối k&igrave; diệu - những bảo bối biến ước mơ của ch&uacute;ng ta th&agrave;nh sự thật. Nhưng tr&ecirc;n tất cả Doraemon l&agrave; hiện th&acirc;n của t&igrave;nh bạn cao đẹp, của niềm kh&aacute;t khao vương tới những tầm cao.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Căn cứ b&iacute; mật bằng giấy</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Cặp đ&ocirc;i thịnh vượng - bần h&agrave;n</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Chiếc cặp b&aacute;c sĩ</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">H&atilde;y cứu gi&uacute;p t&ocirc;i!</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Thi&ecirc;n nhi&ecirc;n trong ph&ograve;ng</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">C&aacute;i đầu Gorgon</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Ảnh năng lượng mặt trời lập thể</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">...</p>', 'tap-20.jpg', '11.3 x 17.6 cm', 191, 100, 100, '2014-07-01'),
(18, 6, 9, 2, 19, 'Mười Người Da Đen Nhỏ', 62000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-size: medium; color: #ff6600;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Mười Người Da Đen Nhỏ</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Mười người ph&aacute;t hiện rằng m&igrave;nh đ&atilde; bị lừa ra đảo để \"trả gi&aacute;\" cho \"tội &aacute;c\" đ&atilde; g&acirc;y ra, họ ứng với 10 bức tượng nhỏ đặt tr&ecirc;n b&agrave;n ở ph&ograve;ng kh&aacute;ch. Những ng&agrave;y sau đ&oacute; từng người lần lượt thiệt mạng tương tự c&aacute;i c&aacute;ch b&agrave;i đồng dao trong ph&ograve;ng mỗi người đ&atilde; m&ocirc; tả. Kỳ lạ hơn l&agrave; sau khi một người qua đời, số tượng trong ph&ograve;ng kh&aacute;ch bằng c&aacute;ch n&agrave;o đ&oacute; đều giảm đi một.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Người đầu ti&ecirc;n thiệt mạng l&agrave;&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Anthony Marston</span>, anh ta chết v&igrave; ngộ độc&nbsp;với triệu chứng tương tự người bị nghẹn. Sau&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Marston</span>&nbsp;l&agrave;<span style=\"box-sizing: border-box; font-weight: bold;\">&nbsp;Ethel Rogers</span>, b&agrave; quản gia chết được chồng ph&aacute;t hiện đ&atilde; chết v&igrave; d&ugrave;ng thuốc ngủ qu&aacute; liều.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Vị tướng&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Macarthur</span>&nbsp;dường như linh cảm được c&aacute;i chết sẽ đến n&ecirc;n đ&atilde; bỏ ăn m&agrave; ngồi nh&igrave;n ra biển v&agrave; lảm nhảm một m&igrave;nh, b&aacute;c sĩ&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Armstrong</span>&nbsp;sau đ&oacute; ph&aacute;t hiện &ocirc;ng đ&atilde; chết v&igrave; bị một vật cứng đập v&agrave;o sau đầu. Người thứ tư thiệt mạng l&agrave;&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Thomas Rogers</span>, trong l&uacute;c bổ củi chuẩn bị cho bữa s&aacute;ng, dường như&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Thomas</span>&nbsp;đ&atilde; để trượt tay v&agrave; l&agrave;m lưỡi b&uacute;a bay thẳng v&agrave;o đầu. L&agrave; người lu&ocirc;n tin rằng m&igrave;nh kh&ocirc;ng l&agrave;m g&igrave; tr&aacute;i với Đức tin, rằng những người kh&aacute;c chết l&agrave; do bị Ch&uacute;a trừng phạt, tuy nhi&ecirc;n&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Emily Brent&nbsp;</span>cũng kh&ocirc;ng thể sống s&oacute;t, b&agrave; bị ti&ecirc;m thuốc độc v&agrave;o cổ sau bữa ăn trưa, vết ti&ecirc;m tr&ecirc;n cổ b&agrave; tương tự như vết ong đốt.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Buổi tối h&ocirc;m đ&oacute; đến lượt quan t&ograve;a&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Wargrave</span>&nbsp;được b&aacute;c sĩ&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Armstrong&nbsp;</span>ph&aacute;t hiện đ&atilde; thiệt mạng v&igrave; bị bắn v&agrave;o đầu trong khi đang đội bộ t&oacute;c giả của quan t&ograve;a. Bản th&acirc;n b&aacute;c sĩ v&agrave;o ng&agrave;y h&ocirc;m sau cũng được những người c&ograve;n lại ph&aacute;t hiện đ&atilde; chết đuối ở v&aacute;ch đ&aacute;.&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Blore&nbsp;</span>l&agrave; người thứ t&aacute;m thiệt mạng tr&ecirc;n đảo, vi&ecirc;n th&aacute;m tử tư bị bức tượng trong ph&ograve;ng c&ocirc;&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Vera Claythorne</span>&nbsp;rơi tr&uacute;ng đầu trong l&uacute;c hai người c&ograve;n lại đang ở ngo&agrave;i bờ biển b&ecirc;n x&aacute;c b&aacute;c sĩ&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Armstrong</span>.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Rơi v&agrave;o trạng th&aacute;i hoảng loạn,&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Claythorne</span>&nbsp;lừa cướp được s&uacute;ng của&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Lombard</span>&nbsp;v&agrave; giết chết tay cựu l&iacute;nh đ&aacute;nh thu&ecirc;. Cuối c&ugrave;ng c&ocirc; trở lại ph&ograve;ng v&agrave; treo cổ tự tử với chiếc ghế v&agrave; d&acirc;y th&ograve;ng lọng do một ai đ&oacute; đ&atilde; b&agrave;y sẵn&hellip; Đ&acirc;y l&agrave; một vụ &aacute;n m&agrave; kh&ocirc;ng hề c&oacute; sự hiện diện hay dấu vết của thủ phạm.</p>', 'img487_1_3_1.jpg', '13 x 20 cm', 269, 100, 100, '2016-01-01'),
(19, 6, 9, 2, 19, 'Cây bách buồn', 74000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; color: #ff6600; font-size: medium;\"><span style=\"box-sizing: border-box; font-weight: bold;\">C&acirc;y B&aacute;ch Buồn</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Agatha Christie</span>&nbsp;được mệnh danh l&agrave; \"Nữ ho&agrave;ng truyện trinh th&aacute;m\" với số lượng t&aacute;c phẩm được xuất bản nhiều nhất mọi thời đại, chỉ xếp sau Kinh Th&aacute;nh v&agrave; Shakespeare. Tại Việt Nam, nhiều thế hệ độc giả đ&atilde; đọc v&agrave; say m&ecirc; s&aacute;ch của b&agrave;. S&aacute;ch của&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Agatha</span>&nbsp;c&oacute; mặt trong nhiều tủ s&aacute;ch gia đ&igrave;nh, được thế hệ n&agrave;y truyền sang thế hệ kh&aacute;c. Điều đ&oacute; cũng đủ để chứng minh c&aacute;c t&aacute;c phẩm của b&agrave; c&oacute; sức sống v&agrave; sức hấp dẫn đến mức n&agrave;o.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">C&ocirc; Elinor Carlisle đứng một c&aacute;ch b&igrave;nh thản ở vị tr&iacute; bị c&aacute;o trước t&ograve;a với tội danh mưu s&aacute;t t&igrave;nh địch của m&igrave;nh - c&ocirc; Mary Gerrard. Bằng chứng đ&atilde; mười mươi - chỉ c&oacute; c&ocirc; mới c&oacute; động cơ, cơ hội v&agrave; phương tiện giết người.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Tuy nhi&ecirc;n, trong ph&ograve;ng xử &aacute;n, chỉ c&oacute; duy nhất một người tin rằng c&ocirc; g&aacute;i trẻ đẹp ấy v&ocirc; tội: Th&aacute;m tử Hercule Poirot l&agrave; tất cả những g&igrave; đứng giữa Elinor v&agrave; gi&aacute; treo cổ.</p>', 'img292.u2377.d20161220.t112051.153721.jpg', '13 x 20 cm', 305, 100, 100, '2015-05-01');
INSERT INTO `SACH` (`MASACH`, `MANXB`, `MALOAI`, `MADMS`, `MATG`, `TENSACH`, `GIABAN`, `BAIGIOITHIEU`, `HINH`, `KICHTHUOC`, `SOTRANG`, `SOLUONG`, `CONLAI`, `NGAYXB`) VALUES
(20, 7, 9, 2, 19, 'Cô Gái Thứ Ba', 36000, '<p><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Agatha Christie kh&ocirc;ng c&ograve;n xa lạ g&igrave; với bạn đọc Việt Nam. B&agrave; được xem l&agrave; nh&agrave; văn nữ vĩ đại nhất trong lĩnh vực tiểu thuyết</span><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;truyện trinh th&aacute;m - vinh dự d&agrave;nh cho nh&agrave; văn nam c&oacute; lẽ thuộc về Conal Doyle.&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Agatha sinh năm 1890 tại Devonshire nước Anh. Năm 24 tuổi b&agrave; kết h&ocirc;n với đại &uacute;y phi c&ocirc;ng Archibad Christie v&agrave;&nbsp;khởi nghiệp&nbsp;</span><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">viết văn của m&igrave;nh v&agrave;o năm 30 tuổi. B&agrave; l&agrave; con g&aacute;i &uacute;t trong một gia đ&igrave;nh c&oacute; c&aacute;ch gi&aacute;o dục bảo thủ. Được cha mẹ thu&ecirc; gia sư về nh&agrave; dạy học, Agatha chưa bao giờ đến trường.&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Vốn l&agrave; người hay cả thẹn nhưng th&ocirc;ng minh v&agrave; đầy s&aacute;ng tạo, Agatha tự t&igrave;m c&aacute;ch giải khu&acirc;y cho &ldquo;thế giới b&oacute; buộc&rdquo; của m&igrave;nh bằng &acirc;m nhạc. Kh&ocirc;ng l&acirc;u sau đ&oacute;, b&agrave; chọn con đường viết văn. B&agrave; l&agrave; t&aacute;c giả của 66 tiểu thuyểt trinh th&aacute;m</span><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">, 6 tiểu thuyết l&atilde;ng mạn, 163 truyện ngắn, 19 vở kịch v&agrave; 4 truyện k&yacute;.&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</span><br style=\"box-sizing: border-box; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\" /><span style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Ở Việt Nam, c&aacute;c nh&agrave; xuất bản đ&atilde; lần lượt cho ra mắt gần 100 t&aacute;c phẩm mang t&ecirc;n b&agrave;, quả l&agrave; một con số đ&aacute;ng nể.</span></p>', 'img937.jpg', '11 x 20 cm', 270, 100, 100, '2010-10-01'),
(21, 2, 9, 2, 20, 'Những cuộc phiêu lưu của Sherlock Holmes', 36000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Sherlock Holmes l&agrave; một nh&acirc;n vật th&aacute;m tử hư cấu v&agrave;o cuối thế kỉ 19 v&agrave; đầu thế kỉ 20, xuất hiện lần đầu trong t&aacute;c phẩm của nh&agrave; văn Arthur Conan Doyle xuất bản 1887.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&Ocirc;ng l&agrave; một th&aacute;m tử ở Lu&acirc;n Đ&ocirc;n nổi tiếng nhờ tr&iacute; th&ocirc;ng minh, khả năng suy diễn logic v&agrave; quan s&aacute;t tinh tường trong khi ph&aacute; những vụ &aacute;n m&agrave; cảnh s&aacute;t phải b&oacute; tay. Nhiều người cho rằng Sherlock Holmes l&agrave; nh&acirc;n vật th&aacute;m tử hư cấu nổi tiếng nhất trong lịch sử văn học v&agrave; l&agrave; một trong những nh&acirc;n vật văn học được biết đến nhiều nhất tr&ecirc;n to&agrave;n thế giới.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Sherlock Homes đ&atilde; xuất hiện trong 4&nbsp;tiểu thuyết v&agrave; 56 truyện ngắn của nh&agrave; văn Conan Doyle. Hầu như tất cả c&aacute;c t&aacute;c phẩm đều được viết dưới dạng ghi ch&eacute;p của b&aacute;c sĩ John H. Watson, người bạn th&acirc;n thiết v&agrave; người ghi ch&eacute;p tiểu sử của Holmes, chỉ c&oacute; 2 t&aacute;c phẩm được viết dưới dạng ghi ch&eacute;p của ch&iacute;nh Homes v&agrave; 2 t&aacute;c phẩm kh&aacute;c dưới dạng ghi ch&eacute;p của người thứ ba.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Th&aacute;m tử Holmes trở n&ecirc;n cực k&igrave; nổi tiếng khi loạt truyện ngắn của Doyle được xuất bản tr&ecirc;n tạp ch&iacute; The Strand Magazine năm 1891. C&aacute;c t&aacute;c giả được viết xoay quanh thời gian từ năm 1878 đến năm 1903 với vụ &aacute;n cuối c&ugrave;ng v&agrave;o năm 1914.</p>', 'nhg-cuoc-phluu-cua-sherlock1.jpg', '13 x 20.5 cm', 348, 100, 100, '2009-03-01'),
(22, 8, 5, 2, 21, 'Ông Già Và Biển Cả', 51000, '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; color: #ff6600; font-size: medium;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Văn Học Kinh Điển Thế Giới - &Ocirc;ng Gi&agrave; V&agrave; Biển Cả</span></span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: bold;\"><em style=\"box-sizing: border-box;\">&Ocirc;ng gi&agrave; v&agrave; Biển cả</em></span>&nbsp;(t&ecirc;n&nbsp;tiếng anh:&nbsp;<em style=\"box-sizing: border-box;\">The Old Man and the Sea</em>) l&agrave; một&nbsp;tiểu thuyết ngắn được Ernest Hemingway&nbsp;viết ở&nbsp;Cuba&nbsp;năm&nbsp;1951&nbsp;v&agrave; xuất bản năm&nbsp;1952. N&oacute; l&agrave; truyện ngắn dạng viễn tưởng cuối c&ugrave;ng được viết bởi Hemingway (v&agrave; được xuất bản khi &ocirc;ng c&ograve;n sống). Đ&acirc;y cũng l&agrave; t&aacute;c phẩm nổi tiếng v&agrave; l&agrave; một trong những đỉnh cao trong sự nghiệp s&aacute;ng t&aacute;c của nh&agrave; văn. T&aacute;c phẩm n&agrave;y đoạt&nbsp;giải Pulitzer cho t&aacute;c phẩm hư cấu&nbsp;năm 1953. N&oacute; cũng g&oacute;p phần quan trọng để nh&agrave; văn được nhận&nbsp;Giải Nobel văn học&nbsp;năm&nbsp;1954.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Trong t&aacute;c phẩm n&agrave;y &ocirc;ng đ&atilde; triệt để d&ugrave;ng nguy&ecirc;n l&yacute; m&agrave; &ocirc;ng gọi l&agrave; \"tảng băng tr&ocirc;i\", chỉ m&ocirc; tả một phần nổi c&ograve;n lại bảy phần ch&igrave;m, khi m&ocirc; tả sức mạnh của con c&aacute;, sự ch&ecirc;nh lệch về lực lượng, về cuộc chiến đấu kh&ocirc;ng c&acirc;n sức giữa con c&aacute; hung dữ với &ocirc;ng gi&agrave;. T&aacute;c phẩm ca ngợi&nbsp;con người, sức&nbsp;lao động&nbsp;v&agrave;&nbsp;kh&aacute;t vọng&nbsp;của con người.</p>', '_ng_gi_v_bi_n_c_.jpg', '17 x 23.5 cm', 144, 100, 100, '2016-03-01'),
(23, 9, 10, 3, 22, 'Mắng con đến đâu là vừa', 55200, '<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\"><strong style=\"padding: 0px; margin: 0px;\">&ldquo;Kh&ocirc;ng c&oacute; c&aacute;ch nu&ocirc;i dạy con đ&uacute;ng!&rdquo;</strong></p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\"><strong style=\"padding: 0px; margin: 0px;\">&nbsp;</strong></p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Người mẹ n&agrave;o cũng mong con m&igrave;nh l&agrave; đứa trẻ c&oacute; đưa đi đ&acirc;u cũng kh&ocirc;ng phải xấu hổ v&agrave; bản th&acirc;n được nh&igrave;n nhận l&agrave; một người mẹ tốt. Mong muốn ấy đ&atilde; trở th&agrave;nh một thứ &aacute;p lực v&ocirc; h&igrave;nh, khiến người mẹ lu&ocirc;n để &yacute; uốn nắn nhất cử nhất động của con, v&agrave; khi con kh&ocirc;ng l&agrave;m được như &yacute;&nbsp; th&igrave; trở n&ecirc;n c&aacute;u gắt, qu&aacute;t mắng con.</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">&nbsp;</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Nhưng trẻ con vẫn cứ l&agrave; trẻ con. Bạn kh&ocirc;ng thể bắt một đứa trẻ mới v&agrave;i tuổi cư xử lịch sự, biết điều như một người lớn được. Trưởng th&agrave;nh cần phải c&oacute; qu&aacute; tr&igrave;nh. Chưa kể, qu&aacute; tr&igrave;nh trưởng th&agrave;nh ở mỗi đứa trẻ c&ograve;n lệch nhau đ&ocirc;i ch&uacute;t. Việc c&aacute;c b&agrave; mẹ cần l&agrave;m l&agrave; h&atilde;y nh&igrave;n nhận con đ&uacute;ng với lứa tuổi, với ho&agrave;n cảnh của ch&uacute;ng, từ đ&oacute; thấu hiểu con hơn.&nbsp;<strong style=\"padding: 0px; margin: 0px;\"><em style=\"padding: 0px; margin: 0px;\">Mắng con đến đ&acirc;u l&agrave; vừa?</em>&nbsp;</strong>ch&iacute;nh l&agrave; những lời khuy&ecirc;n bổ &iacute;ch d&agrave;nh cho những b&agrave; mẹ đang băn khoăn, trăn trở trong chuyện l&agrave;m thế n&agrave;o để thực sự gi&uacute;p con.</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">&nbsp;</p>\r\n<p style=\"padding: 0px; margin: 0px 0px 10px; color: #333344; font-family: arial;\">Kh&ocirc;ng ph&ecirc; ph&aacute;n &ldquo;việc mắng con&rdquo;, cũng kh&ocirc;ng b&agrave;n về &ldquo;kỹ thuật mắng con&rdquo;, th&ocirc;ng điệp xuy&ecirc;n suốt cuốn s&aacute;ch l&agrave;: &ldquo;Hỡi c&aacute;c b&agrave; mẹ, h&atilde;y dừng lại v&agrave; nghỉ ngơi đ&ocirc;i ch&uacute;t trước khi mắng con!&rdquo; Chỉ cần l&ugrave;i lại một ch&uacute;t th&ocirc;i, bạn sẽ thấy mọi thứ h&oacute;a ra kh&ocirc;ng qu&aacute; phức tạp v&agrave; &ldquo;đau đầu&rdquo; như bạn tưởng.</p>', 'PCQ95Q1N.jpg', '14 x 20,5', 158, 100, 100, '2016-12-26');

--
-- Bẫy `SACH`
--
DELIMITER $$
CREATE TRIGGER `xoacthd_danhgia_binhluan_sach` BEFORE DELETE ON `SACH` FOR EACH ROW BEGIN
DELETE FROM CHITIETHOADON WHERE MASACH = OLD.MASACH;
DELETE FROM DANHGIA WHERE MASACH = OLD.MASACH;
DELETE FROM BINHLUAN WHERE MASACH = OLD.MASACH;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `TACGIA`
--

CREATE TABLE `TACGIA` (
  `MATG` int(11) NOT NULL,
  `TENTG` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GIOITHIEU` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `TACGIA`
--

INSERT INTO `TACGIA` (`MATG`, `TENTG`, `GIOITHIEU`) VALUES
(1, 'Nguyễn Quỳnh Trang', '<p>Sinh năm 1981 tại H&agrave; Nội; Cử nh&acirc;n Sư phạm v&agrave; Cử nh&acirc;n văn chương; Hiện l&agrave;m việc tại b&aacute;o Thể thao &amp; Văn h&oacute;a (Th&ocirc;ng tấn x&atilde; Việt Nam).</p>'),
(2, 'Đăng Văn Thiều', NULL),
(3, 'Dương Hướng', ''),
(4, 'Thạch Lam', NULL),
(5, 'Eric-Emmanuel Schmitt', ''),
(6, 'Hector Malot', ''),
(8, 'Jayneen Sanders', ''),
(9, 'Emily Bronte', ''),
(11, 'Antoine de Saint-Exupéry', ''),
(12, 'Mark Twain', ''),
(13, 'Harper Lee', ''),
(14, 'Hoàng Đạo Thúy', ''),
(15, 'Gabriel Garcia Marquez', ''),
(16, 'Paulo Coelho', ''),
(17, 'Gosho Aoyama', ''),
(18, 'Fujiko-F-Fujio', ''),
(19, 'Agatha Christie', ''),
(20, 'Sir Arthur Conan Doyle', ''),
(21, 'Ernest Hemingway', ''),
(22, 'Aiko Shibata', '');

--
-- Bẫy `TACGIA`
--
DELIMITER $$
CREATE TRIGGER `xoasach_tg` BEFORE DELETE ON `TACGIA` FOR EACH ROW DELETE FROM SACH WHERE MATG = OLD.MATG
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `TAIKHOAN`
--

CREATE TABLE `TAIKHOAN` (
  `MATK` int(11) NOT NULL,
  `TENTK` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MATKHAU` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHUCVU` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `TAIKHOAN`
--

INSERT INTO `TAIKHOAN` (`MATK`, `TENTK`, `MATKHAU`, `CHUCVU`) VALUES
(1, 'admin123', '21232f297a57a5a743894a0e4a801fc3', 'Quản lý'),
(6, 'user123', 'e10adc3949ba59abbe56e057f20f883e', 'Khách hàng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `BINHLUAN`
--
ALTER TABLE `BINHLUAN`
  ADD PRIMARY KEY (`MASACH`,`ID`);

--
-- Chỉ mục cho bảng `CHITIETHOADON`
--
ALTER TABLE `CHITIETHOADON`
  ADD PRIMARY KEY (`MASACH`,`MAHD`),
  ADD KEY `FK_CHITIETHOADON2` (`MAHD`);

--
-- Chỉ mục cho bảng `DANHGIA`
--
ALTER TABLE `DANHGIA`
  ADD PRIMARY KEY (`MASACH`,`MAKH`),
  ADD KEY `FK_MAKH_DANHGIA` (`MAKH`);

--
-- Chỉ mục cho bảng `DANHMUCSACH`
--
ALTER TABLE `DANHMUCSACH`
  ADD PRIMARY KEY (`MADMS`);

--
-- Chỉ mục cho bảng `HOADON`
--
ALTER TABLE `HOADON`
  ADD PRIMARY KEY (`MAHD`),
  ADD KEY `FK_QH_HOADON_KHACHHANG` (`MAKH`);

--
-- Chỉ mục cho bảng `KHACHHANG`
--
ALTER TABLE `KHACHHANG`
  ADD PRIMARY KEY (`MAKH`);

--
-- Chỉ mục cho bảng `LOAISACH`
--
ALTER TABLE `LOAISACH`
  ADD PRIMARY KEY (`MALOAI`);

--
-- Chỉ mục cho bảng `NHAXUATBAN`
--
ALTER TABLE `NHAXUATBAN`
  ADD PRIMARY KEY (`MANXB`);

--
-- Chỉ mục cho bảng `SACH`
--
ALTER TABLE `SACH`
  ADD PRIMARY KEY (`MASACH`),
  ADD KEY `FK_QH_NXB_SACH` (`MANXB`),
  ADD KEY `FK_QH_SACH_DANHMUC` (`MADMS`),
  ADD KEY `FK_QH_SACH_LOAISACH` (`MALOAI`),
  ADD KEY `FK_QH_SACH_TACGIA` (`MATG`);

--
-- Chỉ mục cho bảng `TACGIA`
--
ALTER TABLE `TACGIA`
  ADD PRIMARY KEY (`MATG`);

--
-- Chỉ mục cho bảng `TAIKHOAN`
--
ALTER TABLE `TAIKHOAN`
  ADD PRIMARY KEY (`MATK`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `DANHMUCSACH`
--
ALTER TABLE `DANHMUCSACH`
  MODIFY `MADMS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `HOADON`
--
ALTER TABLE `HOADON`
  MODIFY `MAHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `KHACHHANG`
--
ALTER TABLE `KHACHHANG`
  MODIFY `MAKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `LOAISACH`
--
ALTER TABLE `LOAISACH`
  MODIFY `MALOAI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `NHAXUATBAN`
--
ALTER TABLE `NHAXUATBAN`
  MODIFY `MANXB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `SACH`
--
ALTER TABLE `SACH`
  MODIFY `MASACH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `TACGIA`
--
ALTER TABLE `TACGIA`
  MODIFY `MATG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `TAIKHOAN`
--
ALTER TABLE `TAIKHOAN`
  MODIFY `MATK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `BINHLUAN`
--
ALTER TABLE `BINHLUAN`
  ADD CONSTRAINT `FK_MASACH` FOREIGN KEY (`MASACH`) REFERENCES `SACH` (`MASACH`);

--
-- Các ràng buộc cho bảng `CHITIETHOADON`
--
ALTER TABLE `CHITIETHOADON`
  ADD CONSTRAINT `FK_CHITIETHOADON` FOREIGN KEY (`MASACH`) REFERENCES `SACH` (`MASACH`),
  ADD CONSTRAINT `FK_CHITIETHOADON2` FOREIGN KEY (`MAHD`) REFERENCES `HOADON` (`MAHD`);

--
-- Các ràng buộc cho bảng `DANHGIA`
--
ALTER TABLE `DANHGIA`
  ADD CONSTRAINT `FK_MAKH_DANHGIA` FOREIGN KEY (`MAKH`) REFERENCES `KHACHHANG` (`MAKH`),
  ADD CONSTRAINT `FK_MASACH_DANHGIA` FOREIGN KEY (`MASACH`) REFERENCES `SACH` (`MASACH`);

--
-- Các ràng buộc cho bảng `HOADON`
--
ALTER TABLE `HOADON`
  ADD CONSTRAINT `FK_QH_HOADON_KHACHHANG` FOREIGN KEY (`MAKH`) REFERENCES `KHACHHANG` (`MAKH`);

--
-- Các ràng buộc cho bảng `SACH`
--
ALTER TABLE `SACH`
  ADD CONSTRAINT `FK_QH_NXB_SACH` FOREIGN KEY (`MANXB`) REFERENCES `NHAXUATBAN` (`MANXB`),
  ADD CONSTRAINT `FK_QH_SACH_DANHMUC` FOREIGN KEY (`MADMS`) REFERENCES `DANHMUCSACH` (`MADMS`),
  ADD CONSTRAINT `FK_QH_SACH_LOAISACH` FOREIGN KEY (`MALOAI`) REFERENCES `LOAISACH` (`MALOAI`),
  ADD CONSTRAINT `FK_QH_SACH_TACGIA` FOREIGN KEY (`MATG`) REFERENCES `TACGIA` (`MATG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
