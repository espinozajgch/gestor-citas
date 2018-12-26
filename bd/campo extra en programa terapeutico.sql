-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2018 a las 18:47:32
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saludin3_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_terapeutico`
--

CREATE TABLE `programa_terapeutico` (
  `id_programa_terapeutico` int(10) UNSIGNED NOT NULL,
  `paciente_id_paciente` int(11) NOT NULL,
  `descripcion_programa_terapeutico` varchar(150) NOT NULL,
  `descuento` decimal(6,2) NOT NULL DEFAULT '0.00',
  `estado` varchar(45) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`, `descuento`, `estado`) VALUES
(36, 12, 'AAA', '50.00', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  ADD PRIMARY KEY (`id_programa_terapeutico`),
  ADD KEY `fk_programa_terapeutico_paciente1_idx` (`paciente_id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
