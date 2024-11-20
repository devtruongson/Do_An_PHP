-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 04:38 AM
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
-- Database: `suaschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'truongsondev', 'truongson2003');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Id` varchar(255) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `thumbnail` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Id`, `Title`, `Address`, `PhoneNumber`, `Email`, `thumbnail`) VALUES
('Sữa Youtobe Cho Em', 'Vinalk', 'Khu Suông 2 - Xã Hương Lung - Huyện Cẩm Khê - Tỉnh Phú Thọ\r\n29b Định Công Thượng - Quận Hoàng Mai - Thành Phố Hà Nội', '0869224813', 'fstack.edu@gmail.com', 'http://localhost/php/Do_An_PHP/admin/uploads/file_673d5956521eb1.84050480.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` varchar(255) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Gender` bit(1) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `FullName`, `Gender`, `Address`, `PhoneNumber`) VALUES
('KH001', 'Nguyễn Trường Sơn', b'0', 'Hoàng Mai - Định Công - Hà Nội', '0869224813'),
('KH002', 'Lê Thị Hoa', b'1', 'Nam Đàn - Nghệ An - Việt Nam', '0869224814'),
('KH003', 'Nguyễn Tuân Tiến', b'0', 'Khu 2 - Hoàng Cương - Thanh Ba - Phú Thọ', '0869224815'),
('KH004', 'Nguyễn Đức Thành', b'0', 'Khu 2 - Hoàng Cương - Thanh Ba - Phú Thọ', '0869224816'),
('KH005', 'Ngô Ngọc Văn', b'0', 'Trùm Hải Phòng', '0869224817');

-- --------------------------------------------------------

--
-- Table structure for table `sua`
--

CREATE TABLE `sua` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `thumbnail` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `brand` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sua`
--

INSERT INTO `sua` (`id`, `title`, `weight`, `price`, `is_active`, `thumbnail`, `content`, `brand`) VALUES
(5, 'Sữa tươi Australia’s OWN A2 nhập từ Úc thùng 24 hộp', 500, 14444, 1, 'https://file.hstatic.net/200000700229/article/1114510-15583224785381977809742-1_bf76d1d336f64efd8b2193a7678b41e9.jpg', '\r\n                                    \r\n                                    \r\n                                    \r\n                                    ✅Được chế biến 100% từ sữa bò nguyên chất, sữa tươi tiệt trùng nguyên kem Australia\'s Own có được hương vị thơm ngon, béo ngậy tự nhiên và nguồn dinh dưỡng tối ưu. Sản phẩm đặc biệt tốt cho trẻ đang độ tuổi phát triển hoặc những người gầy. Nếu đã thừa cân, bạn không nên sử dụng thường xuyên dòng sữa này để tránh dư thừa dinh dưỡng\r\n✅Australia’s Own là thương hiệu sữa nổi tiếng đến từ Úc, được nhiều người ưa chuộng bởi các dòng sữa dinh dưỡng tốt cho sức khỏe người dùng. Đây là nhãn hàng danh tiếng thuộc tập đoàn Freedom Food Group nổi tiếng của đất nước này. Với hệ thống phân phối toàn cầu, không khó để bạn bắt gặp các sản phẩm mang tên thương hiệu này trên kệ của các cửa hàng tiện lợi hay siêu thị lớn ở nhiều quốc gia trên thế giới. Tại Việt Nam, Australia’s Own luôn nằm trong top những loại sữa nhập khẩu được người tiêu dùng yêu thích nhất.\r\n✅Với sự phong phú và đa dạng của các dòng sản phẩm, Australia\'s Own cũng sử dụng những nguồn nguyên liệu khác nhau. Trong đó tất cả đều được kiểm soát chặt chẽ từ khâu chọn lựa, nuôi trồng, thu hoạch cho đến khi tạo ra sản phẩm cuối cùng. Nhờ vậy những đánh giá sữa Australia\'s Own về nguyên liệu hay thành phần đều đạt được kết quả tích cực.\r\n\r\n✅Đối với sữa động vật, nguồn nguyên liệu chính là sữa tươi được vắt trực tiếp từ những con bò trong trang trại thuộc sở hữu của hãng. Chúng được chọn lựa kỹ lưỡng về giống và nuôi tại môi trường lý tưởng về dinh dưỡng, khí hậu, cách chăm sóc. Kết hợp với quy trình sản xuất hiện đại, được kiểm định chặt chẽ và bảo quản khoa học, sữa không chỉ thơm ngon về hương vị mà còn có giá trị cao về dinh dưỡng\r\n✅Với các thành phần phong phú và tốt cho sức khỏe, uống sữa tươi sạch mỗi ngày là cách giúp cả gia đình bổ sung thêm canxi, vitamin D, protein, vitamin và hàng loạt khoáng chất cần thiết cho cơ thể. Tùy từng dòng sản phẩm mà thích hợp với mỗi đối tượng cụ thể, từ trẻ em cho tới người cao tuổi.                                                                                                                                ', 'SUA001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sua`
--
ALTER TABLE `sua`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sua`
--
ALTER TABLE `sua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
