-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-05-24 16:07
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `stores`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `fabric`
--

CREATE TABLE `fabric` (
  `fabric_id` varchar(20) NOT NULL,
  `material` varchar(50) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `producer` varchar(20) DEFAULT NULL,
  `count_of_yarn` int(11) DEFAULT NULL,
  `fabric_image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `form`
--

CREATE TABLE `form` (
  `form` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `order_queue`
--

CREATE TABLE `order_queue` (
  `ID` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `order_address` varchar(50) NOT NULL,
  `process` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `order_sheet`
--

CREATE TABLE `order_sheet` (
  `ID` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `order_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `products`
--

CREATE TABLE `products` (
  `product_id` varchar(20) NOT NULL,
  `fabric_id` varchar(20) DEFAULT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `form` varchar(20) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `product_image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `user_pw` varchar(20) DEFAULT NULL,
  `user_admin` int(11) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 테이블의 인덱스 `fabric`
--
ALTER TABLE `fabric`
  ADD PRIMARY KEY (`fabric_id`);

--
-- 테이블의 인덱스 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`form`,`size`);

--
-- 테이블의 인덱스 `order_queue`
--
ALTER TABLE `order_queue`
  ADD PRIMARY KEY (`order_id`);

--
-- 테이블의 인덱스 `order_sheet`
--
ALTER TABLE `order_sheet`
  ADD PRIMARY KEY (`ID`,`product_id`,`order_id`);

--
-- 테이블의 인덱스 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `form` (`form`,`size`),
  ADD KEY `fabric_id` (`fabric_id`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `order_queue`
--
ALTER TABLE `order_queue`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- 테이블의 제약사항 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fabric_id`) REFERENCES `fabric` (`fabric_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`form`,`size`) REFERENCES `form` (`form`, `size`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
