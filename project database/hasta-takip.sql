-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Eyl 2021, 14:05:09
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hasta-takip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktor`
--

CREATE TABLE `doktor` (
  `doktor_id` int(11) NOT NULL,
  `doktor_adsoyad` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `doktor_tc` varchar(15) COLLATE utf8mb4_turkish_ci NOT NULL,
  `doktor_sifre` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `doktor`
--

INSERT INTO `doktor` (`doktor_id`, `doktor_adsoyad`, `doktor_tc`, `doktor_sifre`) VALUES
(6, 'Oğuzhan Eskalen', '12345678916', '1234'),
(29, 'Mehmet Gözkaya', '12345678912', '1234'),
(33, 'Sevgi Altun', '12345678914', '123456'),
(35, 'Cemal Akyüz', '12345678946', '1234');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hasta`
--

CREATE TABLE `hasta` (
  `hasta_id` int(11) NOT NULL,
  `hasta_adsoyad` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_tc` varchar(15) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_sifre` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT '1234',
  `hasta_tedavi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_sikayeti` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_tani` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_tahlil` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Tahlil Bulunmuyor',
  `hasta_tahlil_sonuc` varchar(300) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT '-',
  `hasta_doktor` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `hasta_doktor_id` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_talep` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `talep_durum` int(11) NOT NULL DEFAULT 0,
  `talep_tarihi` varchar(15) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hasta`
--

INSERT INTO `hasta` (`hasta_id`, `hasta_adsoyad`, `hasta_tc`, `hasta_sifre`, `hasta_tedavi`, `hasta_sikayeti`, `hasta_tani`, `hasta_tahlil`, `hasta_tahlil_sonuc`, `hasta_doktor`, `hasta_doktor_id`, `randevu_talep`, `talep_durum`, `talep_tarihi`) VALUES
(22, 'Ahmet Kara', '12345678944', 'ahmet123', 'Antibiyotik', 'Baş dönmesi', 'Vertigo', 'Kan Tahlili', '-', 'Sevgi Altun', '33', 'İlaçlar ağır geldi', 2, '25/1/2021 12:32'),
(23, 'Ayşe Önal', '12345678933', 'ayşe46', 'xzczxcxzc', 'karın ağrısı', 'alerjicxvxcvxv', 'Mikroskopi Tahlili', '2 saate çıkar', 'Oğuzhan Eskalen', '6', 'ilaçlar işe yaramıyor', 2, '23/3/2021 1:22'),
(24, 'Zeynep Kamil', '12345678985', '1234', '-', 'Öksürük', 'Covid-19', 'Kan Tahlili', '-', 'Mehmet Gözkaya', '29', 'kontrol istiyorum', 1, '4/2/2021 18:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `randevu`
--

CREATE TABLE `randevu` (
  `randevu_id` int(11) NOT NULL,
  `randevu_aciklama` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_yer` varchar(40) COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_tarih` date NOT NULL,
  `randevu_saat` time NOT NULL,
  `randevu_hasta` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_doktor` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_doktor_id` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `randevu_iptal` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `randevu`
--

INSERT INTO `randevu` (`randevu_id`, `randevu_aciklama`, `randevu_yer`, `randevu_tarih`, `randevu_saat`, `randevu_hasta`, `randevu_doktor`, `randevu_doktor_id`, `randevu_iptal`) VALUES
(87, 'ilaçlar ağır geliyormuş', 'klinik 1', '2021-02-20', '20:15:00', 'Ahmet Kara', 'Sevgi Altun', '33', 0),
(88, 'Tahlil verilecek', 'klinik 2', '2021-02-12', '18:24:00', 'Cem Kar', 'Mehmet Gözkaya', '29', 0),
(91, 'kontrol amaçlı', 'klinik', '2021-02-10', '15:15:00', 'Mustafa Ak', 'Mehmet Gözkaya', '29', 0),
(94, '', '', '0000-00-00', '00:00:00', 'Ayşe Önal', 'Oğuzhan Eskalen', '6', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `doktor`
--
ALTER TABLE `doktor`
  ADD PRIMARY KEY (`doktor_id`);

--
-- Tablo için indeksler `hasta`
--
ALTER TABLE `hasta`
  ADD PRIMARY KEY (`hasta_id`);

--
-- Tablo için indeksler `randevu`
--
ALTER TABLE `randevu`
  ADD PRIMARY KEY (`randevu_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `doktor`
--
ALTER TABLE `doktor`
  MODIFY `doktor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `hasta`
--
ALTER TABLE `hasta`
  MODIFY `hasta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `randevu`
--
ALTER TABLE `randevu`
  MODIFY `randevu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
