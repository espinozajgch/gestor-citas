-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-01-2019 a las 12:23:54
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
(10, '6.349.895-1', 'ODETTE DEL CARMEN', '', '949352421', '', '', '', NULL, 'TOY', 'VALDEZ', 0, '1', 11),
(11, '11693947-9', 'PAMELA ', '', '996250556', 'pafosnbdo@hotmail.com', 'SAN BERNARDO', '', NULL, 'FEBRE', 'OJEDA', 0, '1', 12),
(12, '4196271-2', 'YOLANDA', '223595671', '', '', 'PEDRO AGUIRRE CERDA', '', NULL, 'GUTIEREZ', 'ADASME', 0, '1', 13),
(13, '4196271-2', 'YOLANDA', '223595671', '', '', 'PEDRO AGUIRRE CERDA', '', NULL, 'GUTIEREZ', 'ADASME', 0, '1', 14),
(14, '8444188-0', 'YOLANDA ', '', '942616513', '', 'PEDRO AGUIRRE CERDA', '', NULL, 'HERNANDEZ', 'GUTIERREZ', 0, '1', 15),
(15, '4406471-5', 'HILDEBRANDO', '', '998441629', '', 'SANTIAGO', '', NULL, 'SCHULZ', 'BELLO', 0, '1', 16),
(16, '9604913-7', 'juana', '', '959024152', '', 'san bernardo', '', NULL, 'inostroza', 'zapata', 0, '1', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
