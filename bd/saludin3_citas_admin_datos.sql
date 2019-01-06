-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-01-2019 a las 17:00:53
-- Versión del servidor: 5.6.39-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saludin3_citas`
--

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`) VALUES
(1, 'Ricardo Nancur', 'admin', 'citas@saludintegralcentro.com', NULL, 'admin', 1, 1),
(3, 'Ricardo Nancur', '2607', 'ricardo.nancur@gmail.com', NULL, '2607', 1, 3),
(4, 'esteban ortiz', '1182019', 'saludintegralcentro@gmail.com', NULL, '1182019', 1, 3),
(6, 'MARCELO FARAY', '123456', 'MARCELO.FARAY@GMAIL.COM', NULL, '123456', 1, 2),
(7, 'Jose Espinoza', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
