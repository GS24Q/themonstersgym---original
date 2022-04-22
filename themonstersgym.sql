-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Ápr 20. 00:16
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `themonstersgym`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

CREATE TABLE `adminok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(64) NOT NULL,
  `jelszo` varchar(512) NOT NULL,
  `becenev` varchar(64) NOT NULL,
  `hibasBejelentkezesek` int(11) NOT NULL DEFAULT 0,
  `legutobbiProbalkozas` datetime NOT NULL DEFAULT current_timestamp(),
  `kartya` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `adminok`
--

INSERT INTO `adminok` (`id`, `felhasznalonev`, `jelszo`, `becenev`, `hibasBejelentkezesek`, `legutobbiProbalkozas`, `kartya`) VALUES
(1, 'admin', 'thiMU6Cnl3tWk', 'admin', 0, '2022-04-09 19:14:16', 'admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beallitasok`
--

CREATE TABLE `beallitasok` (
  `nev` varchar(64) NOT NULL,
  `hatterSzin` varchar(7) NOT NULL,
  `zarolva` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `beallitasok`
--

INSERT INTO `beallitasok` (`nev`, `hatterSzin`, `zarolva`) VALUES
('THEMONSTERSGYM', '#ff4242', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csomagok`
--

CREATE TABLE `csomagok` (
  `id` int(11) NOT NULL,
  `nev` varchar(64) NOT NULL,
  `ar` int(11) NOT NULL,
  `leiras` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `csomagok`
--

INSERT INTO `csomagok` (`id`, `nev`, `ar`, `leiras`) VALUES
(1, 'Napijegy', 900, 'Az aktuális napra jogosít akár többször is, zárásig.'),
(2, 'Diák napijegy', 900, 'Az aktuális napra jogosít akár többször is, zárásig, érvényes okmányokkal, diák 25 éves kor alatt.'),
(3, 'Havi korlátlan bérlet', 12000, 'A kiváltás dátumától, 30 napig érvényes.'),
(4, 'Diák bérlet', 9000, '30 napig érvényes. Érvényes okmányokkal, diák 25 éves kor alatt.'),
(5, 'Kedvezményes bérlet', 9000, '30 napig érvényes, rendőr, katona, tűzoltó, egészségügyi dolgozó veheti igénybe.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `forgalom`
--

CREATE TABLE `forgalom` (
  `id` int(11) NOT NULL,
  `ki` int(11) NOT NULL,
  `mikor` datetime NOT NULL,
  `mit` int(11) NOT NULL,
  `kulcs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Tábla szerkezet ehhez a táblához `pultosok`
--

CREATE TABLE `pultosok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(64) NOT NULL,
  `jelszo` varchar(64) NOT NULL,
  `vezetekNev` varchar(48) NOT NULL,
  `keresztNev` varchar(48) NOT NULL,
  `utoNev` varchar(48) NOT NULL,
  `nem` varchar(11) NOT NULL,
  `szuletesiDatum` date NOT NULL DEFAULT '2000-01-01',
  `szemelyiId` varchar(24) NOT NULL,
  `telefonszam` varchar(32) DEFAULT NULL,
  `lakcim` varchar(256) NOT NULL,
  `regisztracioDatum` date NOT NULL DEFAULT current_timestamp(),
  `email` varchar(345) NOT NULL,
  `becenev` varchar(64) NOT NULL,
  `hibasBejelentkezesek` int(11) NOT NULL DEFAULT 0,
  `legutobbiProbalkozas` datetime NOT NULL DEFAULT current_timestamp(),
  `hanyszorVoltNalunk` int(11) NOT NULL,
  `kartya` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tábla szerkezet ehhez a táblához `tagok`
--

CREATE TABLE `tagok` (
  `id` int(11) NOT NULL,
  `vezetekNev` varchar(48) NOT NULL,
  `keresztNev` varchar(48) NOT NULL,
  `utoNev` varchar(48) NOT NULL,
  `nem` varchar(11) NOT NULL,
  `szuletesiDatum` date NOT NULL,
  `szemelyiId` varchar(24) NOT NULL,
  `telefonszam` varchar(32) NOT NULL,
  `lakcim` varchar(256) NOT NULL,
  `regisztracioDatum` date NOT NULL DEFAULT current_timestamp(),
  `hanyszorVoltNalunk` int(11) NOT NULL DEFAULT 0,
  `berletId` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tábla szerkezet ehhez a táblához `tranzakciok`
--

CREATE TABLE `tranzakciok` (
  `id` int(11) NOT NULL,
  `mit` int(11) NOT NULL,
  `ki` int(11) NOT NULL,
  `mikor` datetime NOT NULL DEFAULT current_timestamp(),
  `mennyit` int(11) NOT NULL,
  `leiras` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminok`
--
ALTER TABLE `adminok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `csomagok`
--
ALTER TABLE `csomagok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `forgalom`
--
ALTER TABLE `forgalom`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `pultosok`
--
ALTER TABLE `pultosok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tagok`
--
ALTER TABLE `tagok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tranzakciok`
--
ALTER TABLE `tranzakciok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adminok`
--
ALTER TABLE `adminok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `csomagok`
--
ALTER TABLE `csomagok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `forgalom`
--
ALTER TABLE `forgalom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `pultosok`
--
ALTER TABLE `pultosok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `tagok`
--
ALTER TABLE `tagok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `tranzakciok`
--
ALTER TABLE `tranzakciok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
