-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 26, 2022 at 05:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MY_DATABASE`
--
CREATE DATABASE IF NOT EXISTS `MY_DATABASE` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `MY_DATABASE`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int NOT NULL,
  `Judul` varchar(64) NOT NULL,
  `Penyanyi` varchar(128) NOT NULL,
  `Total_duration` int NOT NULL,
  `Image_path` varchar(256) NOT NULL,
  `Tanggal_terbit` date NOT NULL,
  `Genre` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `Judul`, `Penyanyi`, `Total_duration`, `Image_path`, `Tanggal_terbit`, `Genre`) VALUES
(1, 'Blackpink Album', 'BLACKPINK', 0, 'images/blackpink album cover.png', '2022-10-23', 'Romance'),
(2, 'BTS Album', 'BTS', 0, 'images/bts album cover.jpg', '2012-10-10', 'Friendship'),
(3, 'Izone Album', 'IZONE', 0, 'images/izone album cover.jpg', '2012-10-10', 'Friendship'),
(4, 'Shawn Mendes Album', 'Shawn Mendes', 0, 'images/Shawn mendes album cover.jpg', '2012-10-10', 'Friendship');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `song_id` int NOT NULL,
  `Penyanyi` varchar(128) DEFAULT NULL,
  `Judul` varchar(128) DEFAULT NULL,
  `Tanggal_terbit` date NOT NULL,
  `Genre` varchar(64) DEFAULT NULL,
  `Duration` int NOT NULL,
  `Audio_path` varchar(256) NOT NULL,
  `Image_path` varchar(256) DEFAULT NULL,
  `album_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `Judul`, `Penyanyi`, `Tanggal_terbit`, `Genre`, `Duration`, `Audio_path`, `Image_path`, `album_id`) VALUES
(1, 'DDU DU DU DU','BLACKPINK', '2012-10-23', 'Rock', 0, 'song/BLACKPINK - \'DDU-DU DDU-DU (뚜두뚜두)\'.mp3', 'images/ddu-du-du-du.jpg', 1),
(2, 'FOREVER YOUNG','BLACKPINK', '2022-10-23', 'Pop', 0, 'song/BLACKPINK - \'FOREVER YOUNG\'.mp3', 'images/forever-young.png', 1),
(3, 'PLAYING WITH FIRE','BLACKPINK', '2022-10-23', 'Rock', 0, 'song/BLACKPINK - \'PLAYING WITH FIRE\'.mp3', 'images/playing-with-fire.jpg', 1),
(4, 'REALLY','BLACKPINK', '2012-10-23', 'Hip hop', 0, 'song/BLACKPINK - \'REALLY\'.mp3', 'images/really-bp.png', 1),
(5, 'AS IF IT YOUR LAST','BLACKPINK', '2012-10-22', 'Rock', 0, 'song/BLACKPINK - \'REALLY\'.mp3', 'images/aiiylast.jpg', 1),
(6, 'BOOMBAYAH','BLACKPINK', '2012-10-21', 'Rock', 0, 'song/Blackpink boombayah.mp3', 'images/boombayah.jpg', 1),
(7, 'WHISTLE','BLACKPINK', '2012-10-22', 'Rock', 0, 'song/blackpink whistle.mp3', 'images/whistle.jpg', 1),
(8, 'DNA','BTS', '2012-10-21', 'Romance', 0, 'song/BTS DNA.mp3', 'images/bts dna.jpg', 2),
(9, 'I NEED U','BTS', '2012-10-21', 'Romance', 0, 'song/BTS I NEED U.mp3', 'images/i need u.jpg', 2),
(10, 'IDOL','BTS', '2012-10-21', 'Romance', 0, 'song/BTS IDOL.mp3', 'images/bts idol.jpg', 2),
(11, 'LA VIE EN ROSE','BTS', '2012-10-21', 'Romance', 0, 'song/BTS LA VIE EN ROSE.mp3', 'images/bts la vie en rose.jpg', 2),
(12, 'MIC DROP (Cover by Gen Halilintar)','BTS', '2012-10-21', 'Rock', 0, 'song/BTS Mic Drop gen halilinta.mp3', 'images/gen halilintar bts mic drop.jpg', 2),
(13, 'MIC DROP','BTS', '2012-10-21', 'Rock', 0, 'song/BTS MIC DROP.mp3', 'images/bts mic drop.jpg', 2),
(14, 'RUN','BTS', '2012-10-21', 'Pop', 0, 'song/BTS RUN.mp3', 'images/bts run.jpg', 2),
(15, 'SAVE ME','BTS', '2012-10-21', 'Romance', 0, 'song/BTS SAVE ME.mp3', 'images/bts save me.jpg', 2),
(16, 'SPRING DAY','BTS', '2012-10-21', 'Happy', 0, 'song/BTS SPRING DAY.mp3', 'images/bts spring day.jpg', 2),
(17, 'WE ARE BULLET','BTS', '2012-10-21', 'Rock', 0, 'song/BTS WE ARE BULLET PART 2.mp3', 'images/bts we are bullet.jpg', 2),
(18, 'RUMOR', 'Izone', '2012-10-21', 'Romance', 0, 'song/Izone Rumor.mp3', 'images/izone rumor.jpg', 3),
(19, 'SUKI TO IWASETAI','Izone', '2012-10-21', 'Romance', 0, 'song/IZONE SUKI TO IWASETAI.mp3', 'images/suki to iwasetai.jpg', 3),
(20, 'IMAGINATION','Shawn Mendes', '2012-10-21', 'Romance', 0, 'song/Shawn Mendes Imagination.mp3', 'images/shawn mendes imagination.jpg', 4),
(21, 'TREAT YOU BETTER','Shawn Mendes', '2012-10-21', 'Romance', 0, 'song/Shawn Mendes - Treat You Better.mp3', 'images/shawn mendes treat you beter.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `isAdmin` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `isAdmin`) VALUES
(1, '13520001@std.stei.itb.ac.id', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'akun_testing', 0),
(2, '13520002@std.stei.itb.ac.id', 'e10adc3949ba59abbe56e057f20f883e', 'admin_testing', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id_idx` (`album_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `song`
  MODIFY `song_id` int AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `album`
  MODIFY `album_id` int AUTO_INCREMENT, AUTO_INCREMENT=3;  
--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`)
  ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
