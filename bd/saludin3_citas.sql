-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2018 a las 20:23:24
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
CREATE DATABASE IF NOT EXISTS `saludin3_citas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `saludin3_citas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_accion`, `nombre`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `hash` varchar(256) NOT NULL,
  `id_eu` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`, `estado`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1, 'activo'),
(2, 'medico 1', '1234', 'a@b.c', NULL, '', 1, 3, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_historico`
--

CREATE TABLE `entrada_historico` (
  `id_entrada_historico` int(10) UNSIGNED NOT NULL,
  `tipo_entrada` varchar(45) NOT NULL,
  `fecha_entrada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nivel_entrada` int(11) NOT NULL DEFAULT '2',
  `descripcion_entrada` varchar(500) NOT NULL,
  `tabla_relacionada` varchar(45) DEFAULT NULL,
  `indice_tabla` varchar(45) DEFAULT NULL,
  `historico_id_historico` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada_historico`
--

INSERT INTO `entrada_historico` (`id_entrada_historico`, `tipo_entrada`, `fecha_entrada`, `nivel_entrada`, `descripcion_entrada`, `tabla_relacionada`, `indice_tabla`, `historico_id_historico`) VALUES
(1, 'MODIFICAR', '2018-12-04 09:00:46', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(2, 'MODIFICAR', '2018-12-04 09:00:52', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(3, 'MODIFICAR', '2018-12-04 09:02:28', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(4, 'MODIFICAR', '2018-12-04 09:03:32', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(5, 'MODIFICAR', '2018-12-04 09:03:39', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(6, 'MODIFICAR', '2018-12-04 09:05:26', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(7, 'MODIFICAR', '2018-12-04 09:05:44', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(8, 'MODIFICAR', '2018-12-04 23:26:15', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 0),
(9, 'RESERVAR', '2018-12-04 23:26:35', 2, 'Se reservó cita para el dia 2018-12-6 para una terapia de aaaaa23, con los médicos:  admin,', NULL, NULL, 0),
(10, 'CREAR', '2018-12-04 23:50:09', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 1),
(11, 'RESERVAR', '2018-12-04 23:50:38', 2, 'Se reservó la primera cita del paciente para el día 2018-12-4 con los medicos:  admin,', NULL, NULL, 1),
(12, 'MODIFICAR', '2018-12-07 15:34:20', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(13, 'RESERVAR', '2018-12-07 17:26:35', 2, 'Se reservó cita para el dia 2018-12-5 para una terapia de aaaaa23, con los médicos:  admin,', NULL, NULL, 1),
(14, 'RESERVAR', '2018-12-07 19:26:12', 2, 'Se reservó cita para el dia 2018-12-9 para una terapia de aaaaa, con los médicos:  admin,', NULL, NULL, 1),
(15, 'MODIFICAR', '2018-12-09 22:59:55', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(16, 'CREAR', '2018-12-10 20:11:57', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 4),
(17, 'RESERVAR', '2018-12-11 14:56:44', 2, 'Se reservó cita para el dia 2018-12-13 para una terapia de aaa, con los médicos:  admin,', NULL, NULL, 4),
(18, 'RESERVAR', '2018-12-13 16:53:17', 2, 'Se reservó cita para el dia 2018-12-11 para una terapia de aaa333, con los médicos:  admin,', NULL, NULL, 4),
(19, 'CREAR', '2018-12-13 19:45:35', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 5),
(20, 'RESERVAR', '2018-12-13 19:46:30', 2, 'Se reservó la primera cita del paciente para el día 2018-12-11 con los medicos:  admin,', NULL, NULL, 5),
(21, 'RESERVAR', '2018-12-13 20:43:18', 2, 'Se reservó cita para el dia 2018-12-11 para una terapia de , con los médicos:  admin,', NULL, NULL, 4),
(22, 'RESERVAR', '2018-12-13 20:49:08', 2, 'Se reservó cita para el dia 2018-12-14 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(23, 'RESERVAR', '2018-12-13 20:51:35', 2, 'Se reservó cita para el dia 2018-12-12 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(24, 'RESERVAR', '2018-12-13 20:55:33', 2, 'Se reservó cita para el dia 2018-12-12 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(25, 'RESERVAR', '2018-12-13 20:56:43', 2, 'Se reservó cita para el dia 2018-12-12 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(26, 'RESERVAR', '2018-12-13 21:00:07', 2, 'Se reservó cita para el dia 2018-12-12 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(27, 'RESERVAR', '2018-12-13 21:03:17', 2, 'Se reservó cita para el dia 2018-12-10 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(28, 'RESERVAR', '2018-12-13 21:08:16', 2, 'Se reservó cita para el dia 2018-12-14 para una terapia de Diagnóstico, con los médicos:  admin,', NULL, NULL, 5),
(29, 'MODIFICAR', '2018-12-14 14:23:49', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 5),
(30, 'MODIFICAR', '2018-12-18 20:46:33', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(31, 'MODIFICAR', '2018-12-18 20:49:35', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(32, 'MODIFICAR', '2018-12-18 20:55:59', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(33, 'MODIFICAR', '2018-12-18 21:07:03', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 4),
(34, 'MODIFICAR', '2018-12-18 21:27:46', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(35, 'MODIFICAR', '2018-12-18 21:32:36', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(36, 'MODIFICAR', '2018-12-19 05:38:49', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(37, 'MODIFICAR', '2018-12-19 05:39:46', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(38, 'MODIFICAR', '2018-12-19 05:40:26', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(39, 'MODIFICAR', '2018-12-19 05:50:03', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(40, 'MODIFICAR', '2018-12-19 05:50:36', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(41, 'MODIFICAR', '2018-12-19 08:06:06', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(42, 'MODIFICAR', '2018-12-20 13:41:13', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(43, 'CREAR', '2018-12-20 14:43:16', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 6),
(44, 'CREAR', '2018-12-20 14:43:48', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 7),
(45, 'CREAR', '2018-12-20 14:45:04', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 8),
(46, 'CREAR', '2018-12-20 14:46:56', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(10) UNSIGNED NOT NULL,
  `descripcion_especialidad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_pago`
--

CREATE TABLE `estatus_pago` (
  `id_ep` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estatus_pago`
--

INSERT INTO `estatus_pago` (`id_ep`, `nombre`) VALUES
(1, 'PENDIENTE'),
(2, 'PAGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_usuario`
--

CREATE TABLE `estatus_usuario` (
  `id_eu` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estatus_usuario`
--

INSERT INTO `estatus_usuario` (`id_eu`, `nombre`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `id_facturacion` int(11) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `id_tratamiento` int(11) NOT NULL,
  `id_fp` int(11) NOT NULL,
  `id_ep` int(11) NOT NULL,
  `id_mp` int(11) NOT NULL,
  `referencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE `feriados` (
  `id_feriados` int(10) UNSIGNED NOT NULL,
  `fecha_feriados` date NOT NULL,
  `descripcion_feriados` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `feriados`
--

INSERT INTO `feriados` (`id_feriados`, `fecha_feriados`, `descripcion_feriados`) VALUES
(6, '2018-10-29', 'asdasda'),
(7, '2018-10-19', 'asda'),
(8, '2018-10-08', 'dwqdasd'),
(9, '2018-10-02', 'aaa'),
(10, '2018-10-08', '333'),
(11, '2018-10-17', 'eqweqwe'),
(12, '2018-11-09', 'AL FIN MOTHERFUCKER!'),
(13, '2018-11-02', 'a'),
(14, '2018-11-02', 'a2'),
(15, '2018-11-02', 'a3'),
(16, '2018-11-08', '849616516');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_medicas`
--

CREATE TABLE `historias_medicas` (
  `id_hm` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descripcion` text NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(10) UNSIGNED NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_historico` varchar(45) DEFAULT 'paciente',
  `codigo_historico` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id_historico`, `fecha_creacion`, `tipo_historico`, `codigo_historico`) VALUES
(1, '2018-12-04 23:50:08', 'paciente', '1812-w'),
(2, '2018-12-07 15:33:18', 'paciente', NULL),
(3, '2018-12-07 15:33:55', 'paciente', NULL),
(4, '2018-12-10 20:11:57', 'paciente', '1812-20658041'),
(5, '2018-12-13 19:45:35', 'paciente', '1812-33'),
(6, '2018-12-20 14:43:16', 'paciente', '1812-'),
(7, '2018-12-20 14:43:48', 'paciente', '1812-'),
(8, '2018-12-20 14:45:04', 'paciente', '1812-'),
(9, '2018-12-20 14:46:56', 'paciente', '1812-987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_tiene_especialidad`
--

CREATE TABLE `medico_tiene_especialidad` (
  `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL,
  `especialidad_id_especialidad` int(10) UNSIGNED NOT NULL,
  `admin_id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_tiene_reserva`
--

CREATE TABLE `medico_tiene_reserva` (
  `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL,
  `reserva_medica_id_rm` int(11) NOT NULL,
  `admin_id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico_tiene_reserva`
--

INSERT INTO `medico_tiene_reserva` (`id_medico_tiene_reserva`, `reserva_medica_id_rm`, `admin_id_admin`) VALUES
(59, 43, 1),
(60, 44, 1),
(64, 46, 1),
(65, 47, 1),
(66, 48, 1),
(68, 50, 1),
(69, 51, 1),
(72, 54, 1),
(73, 55, 1),
(74, 56, 1),
(75, 57, 1),
(76, 58, 1),
(78, 60, 1),
(79, 61, 1),
(80, 62, 1),
(81, 63, 1),
(82, 59, 1),
(83, 64, 1),
(84, 65, 1),
(85, 45, 1),
(86, 66, 1),
(87, 67, 1),
(88, 68, 1),
(89, 69, 1),
(90, 70, 1),
(91, 71, 1),
(92, 72, 1),
(93, 73, 1),
(94, 49, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_contacto`
--

CREATE TABLE `medio_contacto` (
  `id_mc` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `cobro` decimal(3,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medio_contacto`
--

INSERT INTO `medio_contacto` (`id_mc`, `nombre`, `cobro`) VALUES
(1, 'Personal', '0'),
(2, 'Radio', '50'),
(3, 'Televisión', '100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_mp` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_mp`, `nombre`) VALUES
(1, 'Cheque'),
(2, 'Transferencia'),
(3, 'Efectivo'),
(4, 'Tarjeta de débito'),
(5, 'Tarje de crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `mensajes` int(11) NOT NULL DEFAULT '0',
  `publicaciones` int(11) NOT NULL DEFAULT '0',
  `soporte` int(11) NOT NULL DEFAULT '0',
  `ventas` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `RUT` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fijo` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `imagen_id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `apellidop` varchar(50) NOT NULL,
  `apellidom` varchar(45) NOT NULL,
  `ficha_paciente_id_fp` int(11) NOT NULL,
  `estado_paciente` varchar(45) NOT NULL DEFAULT 'activo',
  `historico_id_historico` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellidop`, `apellidom`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(5, '1', 'a', 'aaa', 'a', 'aaa', 'a', 'aaaa', NULL, 'b', '', 0, 'activo', 2),
(6, '5', 'qdaqsdasda', 'sdasda', 'sdasda', 'sdasdas', 'dasdasd', 'asdasd', NULL, 'asdasd', '', 0, 'activo', 3),
(7, 'w', 'w', 'w', 'w', 'w', 'w', '', NULL, 'w', '', 0, '1', 1),
(8, '20658041', 'Jonny', '04261693370', '04261693370', 'jonnyrios33@gmail.com', 'Luego de la calle 34, al lado de la cosa grande que esta en la esquina, diagonal al bicho pequeño que esta debajo del mojon que esta a la derecha de la pipa a la derecha de la cosa grande.', '', NULL, 'Rios', '', 0, '1', 4),
(9, '33', 'Prueba', '+59 125 6685', '+45 846 84 24', 'diag@diag.com', 'asdasdasdasdasd', '', NULL, 'DIagnostico', '', 0, '1', 5),
(10, '987', 'qwe', 'weqweq', 'eqweq', 'qweq', 'qweqwe', '', NULL, 'qweqwe', 'qweqwe', 0, '1', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_tiene_reserva`
--

CREATE TABLE `paciente_tiene_reserva` (
  `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL,
  `paciente_id_paciente` int(11) NOT NULL,
  `reserva_medica_id_rm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente_tiene_reserva`
--

INSERT INTO `paciente_tiene_reserva` (`id_paciente_tiene_reserva`, `paciente_id_paciente`, `reserva_medica_id_rm`) VALUES
(45, 5, 43),
(46, 6, 44),
(47, 5, 45),
(48, 6, 46),
(49, 5, 47),
(50, 5, 48),
(51, 5, 49),
(52, 5, 50),
(53, 5, 51),
(56, 5, 54),
(57, 5, 55),
(58, 5, 56),
(59, 5, 57),
(60, 5, 58),
(61, 5, 59),
(62, 7, 60),
(63, 7, 61),
(64, 7, 62),
(65, 8, 63),
(66, 8, 64),
(68, 8, 66),
(69, 9, 67),
(70, 9, 68),
(71, 9, 69),
(72, 9, 70),
(73, 9, 71),
(74, 9, 72),
(75, 9, 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_tiene_tratamiento`
--

CREATE TABLE `paciente_tiene_tratamiento` (
  `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL,
  `tratamiento_id_tratamiento` int(10) UNSIGNED NOT NULL,
  `paciente_id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_terapeutico`
--

CREATE TABLE `programa_terapeutico` (
  `id_programa_terapeutico` int(10) UNSIGNED NOT NULL,
  `paciente_id_paciente` int(11) NOT NULL,
  `descripcion_programa_terapeutico` varchar(150) NOT NULL,
  `estado` varchar(45) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`, `estado`) VALUES
(14, 5, 'Programa terapeutico #1', 'activo'),
(18, 6, '"6-2018-Nov-Thu"', 'cancelado'),
(20, 6, 'Atencion especial de Filomena', 'activo'),
(21, 7, 'eqeqwe', 'cancelado'),
(22, 7, 'qweqwe', 'culminado'),
(23, 8, 'EL programa de Jonny Rios Morales', 'activo'),
(31, 9, 'Diagnóstico preliminar de Prueba DIagnostico', 'culminado'),
(32, 9, 'Diagnostico voluntario del paciente 33', 'activo'),
(34, 7, 'asdas', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_tiene_terapia`
--

CREATE TABLE `programa_tiene_terapia` (
  `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL,
  `programa_terapeutico_id_programa_terapeutico` int(10) UNSIGNED NOT NULL,
  `terapia_id_terapia` int(10) UNSIGNED NOT NULL,
  `reserva_medica_id_rm` int(11) DEFAULT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_tiene_terapia`
--

INSERT INTO `programa_tiene_terapia` (`id_programa_tiene_terapia`, `programa_terapeutico_id_programa_terapeutico`, `terapia_id_terapia`, `reserva_medica_id_rm`, `estado`) VALUES
(56, 18, 4, NULL, 'cancelado'),
(57, 18, 6, NULL, 'cancelado'),
(58, 18, 7, NULL, 'cancelado'),
(76, 14, 5, 58, 'atendida'),
(82, 14, 6, NULL, 'cancelado'),
(85, 21, 1, NULL, 'cancelado'),
(86, 21, 4, NULL, 'cancelado'),
(87, 22, 4, 62, 'cancelado'),
(88, 20, 5, NULL, 'pendiente'),
(89, 20, 1, NULL, 'pendiente'),
(90, 20, 4, NULL, 'pendiente'),
(93, 23, 6, 64, 'atendida'),
(102, 31, 1, 73, 'atendida'),
(104, 32, 5, NULL, 'pendiente'),
(110, 23, 5, NULL, 'pendiente'),
(111, 23, 7, NULL, 'pendiente'),
(112, 23, 5, NULL, 'pendiente'),
(182, 34, 5, NULL, 'pendiente'),
(183, 34, 5, NULL, 'pendiente'),
(184, 34, 6, NULL, 'pendiente'),
(185, 14, 5, NULL, 'pendiente'),
(186, 14, 6, NULL, 'pendiente'),
(187, 14, 5, NULL, 'pendiente'),
(188, 14, 6, NULL, 'pendiente'),
(189, 14, 1, NULL, 'pendiente'),
(190, 14, 1, NULL, 'pendiente'),
(191, 14, 7, NULL, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_medica`
--

CREATE TABLE `reserva_medica` (
  `id_rm` int(11) NOT NULL,
  `fecha_hora_reserva` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_inicio` date NOT NULL,
  `medio_contacto_id_mc` int(11) DEFAULT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `precio` decimal(10,2) UNSIGNED DEFAULT NULL,
  `estado` varchar(15) NOT NULL DEFAULT '0',
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `metodos_pago_id_mp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva_medica`
--

INSERT INTO `reserva_medica` (`id_rm`, `fecha_hora_reserva`, `fecha_inicio`, `medio_contacto_id_mc`, `observaciones`, `precio`, `estado`, `hora_inicio`, `hora_fin`, `metodos_pago_id_mp`) VALUES
(43, '2018-12-13 20:41:03', '2018-11-13', 1, 'qweqwe', NULL, 'cancelado', '08:00:00', '09:30:00', 2),
(44, '2018-12-13 20:41:03', '2018-11-12', 1, 'asda', NULL, 'activo', '07:30:00', '08:30:00', 2),
(45, '2018-12-13 20:41:25', '2018-11-23', 1, '111asdasdasdasd', NULL, 'activo', '06:30:00', '08:00:00', 2),
(46, '2018-12-13 20:41:03', '2018-11-20', 1, 'oiou', NULL, 'activo', '07:30:00', '09:30:00', 2),
(47, '2018-12-13 20:41:03', '2018-11-21', 2, 'asdasd', NULL, 'activo', '06:30:00', '07:30:00', 2),
(48, '2018-12-13 20:46:08', '2018-11-22', 1, '132', NULL, 'pagado', '07:00:00', '08:30:00', 2),
(49, '2018-12-15 10:15:35', '2018-11-24', 1, 'recetado con mitrolon y besamestazona', NULL, 'pagado', '08:00:00', '09:00:00', 2),
(50, '2018-12-13 20:46:01', '2018-11-25', 1, '132', NULL, 'pagado', '06:00:00', '07:00:00', 2),
(51, '2018-12-13 20:41:03', '2018-11-22', 1, '132', NULL, 'activo', '06:00:00', '07:00:00', 2),
(54, '2018-12-13 20:41:03', '2018-12-01', 1, 'asdasdasdas', NULL, 'activo', '08:00:00', '10:00:00', 2),
(55, '2018-12-13 20:41:03', '2018-11-27', 1, '1234', NULL, 'activo', '07:00:00', '08:30:00', 2),
(56, '2018-12-13 20:41:03', '2018-11-30', 1, '1234', NULL, 'activo', '06:30:00', '07:30:00', 2),
(57, '2018-12-13 20:41:03', '2018-11-28', 1, '112', NULL, 'activo', '06:30:00', '07:30:00', 2),
(58, '2018-12-14 12:12:10', '2018-12-06', 1, '155151', NULL, 'atendida', '07:30:00', '06:30:00', 2),
(59, '2018-12-13 20:41:03', '2018-12-08', 1, '9159519', NULL, 'activo', '07:30:00', '08:30:00', 2),
(60, '2018-12-13 20:41:03', '2018-12-04', 1, 'adsda', NULL, 'activo', '06:30:00', '08:00:00', 2),
(61, '2018-12-13 20:41:03', '2018-12-05', 1, 'qweqwe', NULL, 'cancelado', '06:30:00', '08:00:00', 2),
(62, '2018-12-13 20:40:52', '2018-12-09', 1, 'asdasd', NULL, 'cancelado', '08:30:00', '09:30:00', 2),
(63, '2018-12-13 20:41:03', '2018-12-13', 1, 'asdasdasda', NULL, 'pagado', '13:30:00', '15:00:00', 2),
(64, '2018-12-14 12:19:56', '2018-12-11', 2, 'asdadasdasd', NULL, 'atendida', '12:00:00', '14:00:00', 2),
(65, '2018-12-13 20:41:03', '2018-12-11', 1, 'asdasd', NULL, 'pagado', '09:30:00', '11:00:00', 2),
(66, '2018-12-13 20:43:18', '2018-12-11', 1, 'sfdfs', NULL, 'pagado', '10:30:00', '12:00:00', 1),
(67, '2018-12-13 20:49:08', '2018-12-14', 1, '484848', NULL, 'pagado', '12:00:00', '13:00:00', 3),
(68, '2018-12-13 20:51:35', '2018-12-12', 1, 'asdasd', NULL, 'pagado', '10:30:00', '12:30:00', 1),
(69, '2018-12-13 20:55:32', '2018-12-12', 1, 'dasdas', NULL, 'pagado', '11:30:00', '14:30:00', 1),
(70, '2018-12-13 20:56:43', '2018-12-12', 1, 'asdasdsa', NULL, 'pagado', '10:00:00', '11:30:00', 1),
(71, '2018-12-13 21:00:07', '2018-12-12', 1, 'asdasdas', NULL, 'pagado', '14:30:00', '16:00:00', 1),
(72, '2018-12-13 21:03:17', '2018-12-10', 1, '1', NULL, 'pagado', '10:30:00', '12:00:00', 1),
(73, '2018-12-14 13:40:20', '2018-12-14', 1, '3123', NULL, 'atendida', '10:00:00', '11:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'SuperAdmin'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_accion`
--

CREATE TABLE `rol_accion` (
  `id_ra` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_accion`
--

INSERT INTO `rol_accion` (`id_ra`, `id_accion`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terapia`
--

CREATE TABLE `terapia` (
  `id_terapia` int(10) UNSIGNED NOT NULL,
  `nombre_terapia` varchar(45) NOT NULL,
  `descripcion_terapia` varchar(250) NOT NULL,
  `precio_terapia` decimal(8,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `estado_terapia` varchar(45) DEFAULT 'activa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `terapia`
--

INSERT INTO `terapia` (`id_terapia`, `nombre_terapia`, `descripcion_terapia`, `precio_terapia`, `estado_terapia`) VALUES
(1, 'Diagnóstico', 'Realización de diagnóstico preliminar al paciente', '200.00', 'activa'),
(4, 'aaaaa', 'aaa', '890.00', 'activa'),
(5, 'aaaaa23', 'asdasd', '40.00', 'activa'),
(6, 'aaa333', 'asdasda', '40.00', 'activa'),
(7, 'aaa2', 'asdasd', '330.00', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id_tratamiento` int(10) UNSIGNED NOT NULL,
  `descripcion_tratamiento` varchar(250) NOT NULL,
  `nombre_tratamiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `entrada_historico`
--
ALTER TABLE `entrada_historico`
  ADD PRIMARY KEY (`id_entrada_historico`),
  ADD KEY `fk_entrada_historico_historico1_idx` (`historico_id_historico`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `estatus_pago`
--
ALTER TABLE `estatus_pago`
  ADD PRIMARY KEY (`id_ep`);

--
-- Indices de la tabla `estatus_usuario`
--
ALTER TABLE `estatus_usuario`
  ADD PRIMARY KEY (`id_eu`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`id_facturacion`);

--
-- Indices de la tabla `feriados`
--
ALTER TABLE `feriados`
  ADD PRIMARY KEY (`id_feriados`);

--
-- Indices de la tabla `historias_medicas`
--
ALTER TABLE `historias_medicas`
  ADD PRIMARY KEY (`id_hm`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_historico`);

--
-- Indices de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  ADD PRIMARY KEY (`id_medico_tiene_especialidad`),
  ADD KEY `fk_medico_tiene_especialidad_especialidad1_idx` (`especialidad_id_especialidad`),
  ADD KEY `fk_medico_tiene_especialidad_admin1_idx` (`admin_id_admin`);

--
-- Indices de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  ADD PRIMARY KEY (`id_medico_tiene_reserva`),
  ADD KEY `fk_medico_tiene_reserva_reserva_medica1_idx` (`reserva_medica_id_rm`),
  ADD KEY `fk_medico_tiene_reserva_admin1_idx` (`admin_id_admin`);

--
-- Indices de la tabla `medio_contacto`
--
ALTER TABLE `medio_contacto`
  ADD PRIMARY KEY (`id_mc`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_mp`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `fk_paciente_historico1_idx` (`historico_id_historico`);

--
-- Indices de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  ADD PRIMARY KEY (`id_paciente_tiene_reserva`),
  ADD KEY `fk_paciente_tiene_reserva_paciente1_idx` (`paciente_id_paciente`),
  ADD KEY `fk_paciente_tiene_reserva_reserva_medica1_idx` (`reserva_medica_id_rm`);

--
-- Indices de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  ADD PRIMARY KEY (`id_paciente_tiene_tratamiento`),
  ADD KEY `fk_paciente_tiene_tratamiento_tratamiento1_idx` (`tratamiento_id_tratamiento`),
  ADD KEY `fk_paciente_tiene_tratamiento_paciente1_idx` (`paciente_id_paciente`);

--
-- Indices de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  ADD PRIMARY KEY (`id_programa_terapeutico`),
  ADD KEY `fk_programa_terapeutico_paciente1_idx` (`paciente_id_paciente`);

--
-- Indices de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  ADD PRIMARY KEY (`id_programa_tiene_terapia`),
  ADD KEY `fk_programa_tiene_terapia_programa_terapeutico1_idx` (`programa_terapeutico_id_programa_terapeutico`),
  ADD KEY `fk_programa_tiene_terapia_terapia1_idx` (`terapia_id_terapia`),
  ADD KEY `fk_programa_tiene_terapia_reserva_medica1_idx` (`reserva_medica_id_rm`);

--
-- Indices de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `fk_reserva_medica_medio_contacto1_idx` (`medio_contacto_id_mc`),
  ADD KEY `fk_reserva_medica_metodos_pago1_idx` (`metodos_pago_id_mp`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_accion`
--
ALTER TABLE `rol_accion`
  ADD PRIMARY KEY (`id_ra`);

--
-- Indices de la tabla `terapia`
--
ALTER TABLE `terapia`
  ADD PRIMARY KEY (`id_terapia`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `entrada_historico`
--
ALTER TABLE `entrada_historico`
  MODIFY `id_entrada_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estatus_pago`
--
ALTER TABLE `estatus_pago`
  MODIFY `id_ep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estatus_usuario`
--
ALTER TABLE `estatus_usuario`
  MODIFY `id_eu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `feriados`
--
ALTER TABLE `feriados`
  MODIFY `id_feriados` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `historias_medicas`
--
ALTER TABLE `historias_medicas`
  MODIFY `id_hm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  MODIFY `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  MODIFY `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT de la tabla `medio_contacto`
--
ALTER TABLE `medio_contacto`
  MODIFY `id_mc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  MODIFY `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  MODIFY `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  MODIFY `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rol_accion`
--
ALTER TABLE `rol_accion`
  MODIFY `id_ra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `terapia`
--
ALTER TABLE `terapia`
  MODIFY `id_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada_historico`
--
ALTER TABLE `entrada_historico`
  ADD CONSTRAINT `fk_entrada_historico_historico1` FOREIGN KEY (`historico_id_historico`) REFERENCES `historico` (`id_historico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  ADD CONSTRAINT `fk_medico_tiene_especialidad_admin1` FOREIGN KEY (`admin_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medico_tiene_especialidad_especialidad1` FOREIGN KEY (`especialidad_id_especialidad`) REFERENCES `especialidad` (`id_especialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  ADD CONSTRAINT `fk_medico_tiene_reserva_admin1` FOREIGN KEY (`admin_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medico_tiene_reserva_reserva_medica1` FOREIGN KEY (`reserva_medica_id_rm`) REFERENCES `reserva_medica` (`id_rm`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_historico1` FOREIGN KEY (`historico_id_historico`) REFERENCES `historico` (`id_historico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  ADD CONSTRAINT `fk_paciente_tiene_reserva_paciente1` FOREIGN KEY (`paciente_id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paciente_tiene_reserva_reserva_medica1` FOREIGN KEY (`reserva_medica_id_rm`) REFERENCES `reserva_medica` (`id_rm`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  ADD CONSTRAINT `fk_paciente_tiene_tratamiento_paciente1` FOREIGN KEY (`paciente_id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paciente_tiene_tratamiento_tratamiento1` FOREIGN KEY (`tratamiento_id_tratamiento`) REFERENCES `tratamientos` (`id_tratamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  ADD CONSTRAINT `fk_programa_terapeutico_paciente1` FOREIGN KEY (`paciente_id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  ADD CONSTRAINT `fk_programa_tiene_terapia_programa_terapeutico1` FOREIGN KEY (`programa_terapeutico_id_programa_terapeutico`) REFERENCES `programa_terapeutico` (`id_programa_terapeutico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_programa_tiene_terapia_reserva_medica1` FOREIGN KEY (`reserva_medica_id_rm`) REFERENCES `reserva_medica` (`id_rm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_programa_tiene_terapia_terapia1` FOREIGN KEY (`terapia_id_terapia`) REFERENCES `terapia` (`id_terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  ADD CONSTRAINT `fk_reserva_medica_medio_contacto1` FOREIGN KEY (`medio_contacto_id_mc`) REFERENCES `medio_contacto` (`id_mc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserva_medica_metodos_pago1` FOREIGN KEY (`metodos_pago_id_mp`) REFERENCES `metodos_pago` (`id_mp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
