-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-01-2019 a las 16:58:12
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
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellidop`, `apellidom`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(3, '7299518-k', 'Fernando', '999426439', '999426439', '999426439', 'Gran avenida 3125, puente alto', '', NULL, 'Gonzalez', 'Araya', 0, '1', 3),
(4, '3481865-7', 'Rudy Benito', '228949252', '', '', 'SAN BERNARDO', '', NULL, 'Ibarra', 'Cisternas', 0, '1', 4),
(5, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '1', 5),
(7, '5544286-7', 'maria cristina', '226481654', '', '', '', '', NULL, 'vallejos', 'vallejos', 0, '1', 7),
(8, '6854565-K', 'paulina', '228310688', '', '', 'melipilla', '', NULL, 'sanchez', 'sanchez', 0, '1', 8),
(9, '3596528-9', 'herminia', '225112403', '', '', 'san miguel', '', NULL, 'poblete', 'suazo', 0, '1', 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
