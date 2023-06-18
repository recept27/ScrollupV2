-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 18 Haz 2023, 11:30:13
-- Sunucu sürümü: 10.3.39-MariaDB
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `firstrip_scrollup`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `scrollups_id` int(11) NOT NULL,
  `content_type` enum('image','video') NOT NULL,
  `content_url` varchar(500) NOT NULL,
  `content_loop` int(11) NOT NULL,
  `content_duration` int(11) NOT NULL,
  `content_title` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `content`
--

INSERT INTO `content` (`id`, `scrollups_id`, `content_type`, `content_url`, `content_loop`, `content_duration`, `content_title`) VALUES
(33, 1, 'video', '../uploads/648eb91a867fe.mp4', 1, 1, '3'),
(5, 0, 'image', '../uploads/logo_content.png', 212, 1212, 'sdasd'),
(6, 0, '', '../uploads/648e87a4d8b63.png', 212, 3233, 'asdasd'),
(7, 0, '', '../uploads/648e89145ba75.png', 0, 0, 'sadsda'),
(34, 1, 'video', '../uploads/648ebc18af99a.mp4', 1, 1, '123123'),
(31, 1, 'image', '../uploads/648eb8fa046e2.png', 1, 1, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scrollups`
--

CREATE TABLE `scrollups` (
  `id` int(11) NOT NULL,
  `device_title` varchar(500) NOT NULL,
  `device_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_wifi_name` varchar(500) NOT NULL,
  `device_wifi_password` varchar(500) NOT NULL,
  `device_bluetooth_name` varchar(500) NOT NULL,
  `bluetooth_status` int(2) NOT NULL,
  `wifi_status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `scrollups`
--

INSERT INTO `scrollups` (`id`, `device_title`, `device_id`, `user_id`, `device_wifi_name`, `device_wifi_password`, `device_bluetooth_name`, `bluetooth_status`, `wifi_status`) VALUES
(1, 'Raspery1-EQR1', 'GAZiANTEP-MAGAZA', 147, 'sdasda12', 'asdsd122', 'asdasd121', 0, 2),
(2, 'Rasp1-EQR', 'ANKAMALL-AVM', 147, 'asds', 'asdsda', 'asds', 1, 1),
(3, 'Scrollups-27TR2', 'ESENLER-BUTIK', 147, '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(500) NOT NULL,
  `site_desc` varchar(500) NOT NULL,
  `site_logo` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_desc`, `site_logo`) VALUES
(1, 'Scrollup Web Paneli', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kullanici_zaman` datetime NOT NULL DEFAULT current_timestamp(),
  `kullanici_resim` varchar(250) NOT NULL,
  `kullanici_tc` varchar(50) NOT NULL,
  `kullanici_ad` varchar(50) NOT NULL,
  `kullanici_mail` varchar(100) NOT NULL,
  `kullanici_gsm` varchar(50) NOT NULL,
  `kullanici_password` varchar(50) NOT NULL,
  `kullanici_adsoyad` varchar(50) NOT NULL,
  `kullanici_adres` varchar(250) NOT NULL,
  `kullanici_il` varchar(100) NOT NULL,
  `kullanici_ilce` varchar(100) NOT NULL,
  `kullanici_unvan` varchar(100) NOT NULL,
  `kullanici_yetki` varchar(50) NOT NULL,
  `kullanici_durum` int(1) NOT NULL DEFAULT 1,
  `kullanici_okul` varchar(250) NOT NULL,
  `kullanici_alan` int(1) NOT NULL,
  `kullanici_sinif` int(2) NOT NULL,
  `kullanici_cinsiyet` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `kullanici_zaman`, `kullanici_resim`, `kullanici_tc`, `kullanici_ad`, `kullanici_mail`, `kullanici_gsm`, `kullanici_password`, `kullanici_adsoyad`, `kullanici_adres`, `kullanici_il`, `kullanici_ilce`, `kullanici_unvan`, `kullanici_yetki`, `kullanici_durum`, `kullanici_okul`, `kullanici_alan`, `kullanici_sinif`, `kullanici_cinsiyet`) VALUES
(147, '2017-07-08 15:21:45', '', '12345678910', '', 'test@user.com', '08508408076', 'e10adc3949ba59abbe56e057f20f883e', 'Denizcan ılhan', '', 'gaziantep', '', '', '5', 1, 'sdfsd', 1, 1, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `scrollups`
--
ALTER TABLE `scrollups`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Tablo için AUTO_INCREMENT değeri `scrollups`
--
ALTER TABLE `scrollups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
