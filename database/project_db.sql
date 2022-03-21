-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 11:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `ID_an` int(11) NOT NULL,
  `text` varchar(6000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`ID_an`, `text`) VALUES
(1, 'โปรดระมัดระวังมิจฉาชิพ.. การพบเจอหรือการส่งของหายโปรดขอข้อมูลเพื่อยืนยันตัวตนทุกครั้ง');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ID_articles` int(11) NOT NULL,
  `authors_id` int(10) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ID_articles`, `authors_id`, `image`, `title`, `body`, `date`) VALUES
(1, 1, 'warning.jpg', 'Test', ' เตือนภัย \"การล่อลวงแบบฟิชชิ่ง\" หลอกเหยื่อให้กรอกข้อมูลส่วนตัว ก่อนปล้นเงินจากบัญชีหายเกลี้ยง\r\n\r\nปัจจุบันเทคโนโลยีดิจิทัลมีอิทธิพลต่อการใช้ชีวิต หลายคนใช้ช่องทางออนไลน์เพื่อติดต่อสื่อสารและทำธุรกรรมผ่าน e-Money อยู่เป็นประจำ โดย ข้อมูลจาก ธปท. ระบุ จำนวนบัญชี e-Money ณ ธ.ค.63 มีมากกว่า 107 ล้านบัญชี ยิ่งเทคโนโลยีดิจิทัลและกระแสการใช้จ่ายผ่านออนไลน์มีความสะดวกและเติบโตมากขึ้นเท่าไร กลโกงของมิจฉาชีพก็เพิ่มความแนบเนียนและมีความหลากหลายมากขึ้นเท่านั้น จนเกิดกรณีที่มีผู้ตกเป็นเหยื่ออยู่บ่อย ๆ\r\n\r\nอย่างไรก็ตาม สิ่งที่มิจฉาชีพต้องการจากเราหลัก ๆ นอกจากเงินแล้ว ก็ยังมีข้อมูลส่วนบุคคล ที่มักใช้กลลวงให้ได้มาโดยวิธีที่เรียกว่า ฟิชชิ่ง หรือ Phishing คือการเอาเหยื่อล่อให้เราหลงเชื่อและทำตาม โดยใช้ชั้นเชิงปลอมแปลงแม้กระทั่งชื่อผู้ส่งข้อความ SMS ไปที่เบอร์ของเหยื่อพร้อมแนบลิงก์ไปยังเว็บที่ทำขึ้นปลอมและแสร้งเป็นผู้ให้บริการต่าง ๆ เพื่อให้เหยื่อหลงกรอกข้อมูลส่วนบุคคล ซึ่งเป็นสิ่งที่ผู้ใช้ต้องมีสติและใช้ความระมัดระวังเป็นพิเศษเมื่อได้รับการติดต่อในรูปแบบดังกล่าว', '2022-02-04 12:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `item_found`
--

CREATE TABLE `item_found` (
  `ID_Item` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `detail` varchar(1000) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_found`
--

INSERT INTO `item_found` (`ID_Item`, `user_id`, `image`, `name`, `title`, `date`, `detail`) VALUES
(1, 4, 'jbl.jfif', 'ลำโพง', 'ลำโพง JBL 2', '2022-01-27 09:38:45', 'เมื่อวันที่ 24/1/2022 เวลาประมาณ บ่าย 3 พบลำโพง JBL go 3 สีน้ำเงิน บริเวณบรรไดชั้น3ของหอ สบาย อยู่ที่ซ.สมเด็จพระปิ่นเกล้า3 ถ.สมเด็จพระปิ่นเกล้า  บางกอกน้อย กรุงเทพมหานคร สามารถติดต่อรับของได้ที่ฝ่ายนิติบุคคลของหอพัก โดยนำบัตรประชาชนมายืนยัน');

-- --------------------------------------------------------

--
-- Table structure for table `item_lost`
--

CREATE TABLE `item_lost` (
  `ID_Item` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `detail` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `reward` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_lost`
--

INSERT INTO `item_lost` (`ID_Item`, `user_id`, `image`, `name`, `title`, `date`, `detail`, `reward`) VALUES
(5, 4, 'test1.jpg', 'มือถือ', 'มือถือหายแถว 7-11', '2022-01-27 09:27:00', 'มือถือ รุ่น samsung A8 สีดำ ใส่เคสรูปแมว ทำหายแถว 7-11 สาขา  เยาวราช  เยาวราช 11 แขวง จักรวรรดิ์ เขตสัมพันธวงศ์ กรุงเทพมหานคร ถ้ามีใครพบ โปรดแจ้ง \r\nE-mail: nana@hotmail.com\r\nPhone: 0123456789\r\nนาย xx นามสกุล xxx (ป๋อง)', 'มี'),
(6, 4, 'test2.jpg', 'กุญแจ', 'กุญแจรถยนต์หายแถวตลาดน้ำ', '2022-01-21 10:43:00', 'กุญแจรถยนต์ของ Honda civic มีพวงกุญแจตุ๊กตาหมาสีน้ำตาลคาบกระดูก หายแถวหน้าทางเข้า\r\nตลาดน้ำสะพานโค้ง ช่วงเวลา 18.00 ของวันที่ 20/01/2022 ถ้ามีใครพบเห็ยโปรดแจ้ง\r\nนาย xxx นามสกุล xxx ชื่อเล่น xx เบอร์ xxxxxxx ', 'ไม่ระบุ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_users` int(11) NOT NULL,
  `username` varchar(45) CHARACTER SET utf8 NOT NULL,
  `passwd` varchar(45) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `user_surname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(10) NOT NULL,
  `user_group` varchar(1) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_users`, `username`, `passwd`, `user_name`, `user_surname`, `email`, `phone`, `user_group`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kittiphon', 'Thanomsuksan', '61160086@hotmail.com', '822222222', 'A'),
(4, 'qw17906171', 'a402dd26a67ebaa79af0fa0391f5b1c4', 'Boxty', 'Dhana', 'qw17906171@hotmail.com', '0829289552', 'U');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `Del_user_fond` BEFORE DELETE ON `users` FOR EACH ROW DELETE FROM item_found
WHERE item_found.user_id=old.ID_users
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Del_user_lost` BEFORE DELETE ON `users` FOR EACH ROW DELETE FROM item_lost
WHERE item_lost.user_id=old.ID_users
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`ID_an`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID_articles`);

--
-- Indexes for table `item_found`
--
ALTER TABLE `item_found`
  ADD PRIMARY KEY (`ID_Item`);

--
-- Indexes for table `item_lost`
--
ALTER TABLE `item_lost`
  ADD PRIMARY KEY (`ID_Item`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `ID_an` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID_articles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_found`
--
ALTER TABLE `item_found`
  MODIFY `ID_Item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_lost`
--
ALTER TABLE `item_lost`
  MODIFY `ID_Item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
