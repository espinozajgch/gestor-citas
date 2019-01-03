-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-12-2018 a las 17:57:35
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
(1, 'Citas'),
(2, 'Pacientes'),
(3, 'Reportes'),
(4, 'Terapias'),
(5, 'Usuarios'),
(6, 'Calendario');

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
(3, 'medico 1', '1234', 'a@a.com', NULL, '1', 1, 3, 'activo'),
(4, 'Medico 2', '1234', 'medico2@medicos.com', NULL, '$2y$10$9KibWE.cGUoNB8/Qgh61IukPQ1xMjyDVgcpCATPpVB/H5VTZbk34y3570c3', 1, 3, 'activo');

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
(57, 'CREAR', '2018-12-25 23:43:34', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 11),
(58, 'CREAR', '2018-12-25 23:44:51', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 11),
(59, 'MODIFICAR', '2018-12-25 23:45:00', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(60, 'RESERVAR', '2018-12-26 01:33:29', 2, 'Se reservó cita para el dia 2018-12-26 para una terapia de , con los médicos:  medico 1,', NULL, NULL, 11),
(61, 'RESERVAR', '2018-12-26 01:33:50', 2, 'Se reservó cita para el dia 2018-12-27 para una terapia de , con los médicos:  medico 1,', NULL, NULL, 11),
(62, 'CREAR', '2018-12-26 02:44:35', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 12),
(63, 'CREAR', '2018-12-26 04:07:12', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 13),
(64, 'MODIFICAR', '2018-12-26 13:23:08', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(65, 'MODIFICAR', '2018-12-26 13:23:39', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(66, 'MODIFICAR', '2018-12-26 13:27:13', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(67, 'MODIFICAR', '2018-12-26 13:27:44', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(68, 'MODIFICAR', '2018-12-26 13:29:02', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(69, 'MODIFICAR', '2018-12-26 13:29:09', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(70, 'MODIFICAR', '2018-12-26 13:29:24', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(71, 'MODIFICAR', '2018-12-26 13:43:06', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(72, 'MODIFICAR', '2018-12-26 19:27:05', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(73, 'MODIFICAR', '2018-12-26 19:27:55', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(74, 'MODIFICAR', '2018-12-26 19:28:21', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 11),
(75, 'CREAR', '2018-12-26 19:48:03', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 14),
(76, 'CREAR', '2018-12-28 06:46:24', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 12),
(77, 'MODIFICAR', '2018-12-28 06:58:48', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 12),
(78, 'MODIFICAR', '2018-12-28 07:29:57', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 12),
(79, 'MODIFICAR', '2018-12-28 07:30:14', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 12),
(80, 'CREAR', '2018-12-28 07:30:29', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 13),
(81, 'RESERVAR', '2018-12-28 07:31:29', 2, 'Se reservó cita para el dia 2018-12-25 para una terapia de , con los médicos:  Medico 2,', NULL, NULL, 13),
(82, 'CREAR', '2018-12-28 07:32:26', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 14),
(83, 'CREAR', '2018-12-28 07:36:57', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 14),
(84, 'CREAR', '2018-12-28 07:45:34', 2, 'Se creó programa terapéutico para el paciente, compuesto de 3 terapias.', NULL, NULL, 14),
(85, 'MODIFICAR', '2018-12-28 07:47:14', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 14),
(86, 'MODIFICAR', '2018-12-28 07:53:32', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 14),
(87, 'MODIFICAR', '2018-12-28 07:53:39', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 14),
(88, 'RESERVAR', '2018-12-28 18:31:14', 2, 'Se reservó cita para el dia 25-12-2018 para una terapia de , con los médicos:  medico 1,', NULL, NULL, 14),
(89, 'MODIFICAR', '2018-12-28 19:02:33', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 13),
(90, 'CREAR', '2018-12-28 19:05:15', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 15),
(91, 'CREAR', '2018-12-28 19:09:24', 2, 'Se creó programa terapéutico para el paciente, compuesto de 2 terapias.', NULL, NULL, 15),
(92, 'RESERVAR', '2018-12-28 19:49:25', 2, 'Se reservó cita para el dia 2018-12-26 para una terapia de , con los médicos:  Medico 2,', NULL, NULL, 13),
(93, 'CREAR', '2018-12-28 21:07:12', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 16),
(94, 'CREAR', '2018-12-29 00:19:43', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 17),
(95, 'CREAR', '2018-12-29 00:20:43', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 18),
(96, 'CREAR', '2018-12-29 10:01:14', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 19),
(97, 'CREAR', '2018-12-29 10:07:19', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 20),
(98, 'CREAR', '2018-12-29 10:08:17', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 21),
(99, 'CREAR', '2018-12-29 10:08:19', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 21),
(100, 'CREAR', '2018-12-29 10:24:54', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 22),
(101, 'CREAR', '2018-12-29 10:24:55', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 22),
(102, 'CREAR', '2018-12-29 10:30:18', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 23),
(103, 'CREAR', '2018-12-29 10:30:18', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 23),
(104, 'CREAR', '2018-12-29 10:35:22', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 24),
(105, 'CREAR', '2018-12-29 10:35:23', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 24),
(106, 'RESERVAR', '2018-12-29 10:35:26', 2, 'Se reservó cita para el dia 2018-12-27 para una terapia de , con los médicos:  Medico 2,', NULL, NULL, 24),
(107, 'CREAR', '2018-12-30 08:58:03', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 25),
(108, 'CREAR', '2018-12-30 08:58:54', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 26),
(109, 'CREAR', '2018-12-30 08:58:55', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 26),
(110, 'RESERVAR', '2018-12-30 08:58:58', 2, 'Se reservó cita para el dia 2018-12-27 para una terapia de , con los médicos:  medico 1,', NULL, NULL, 26),
(111, 'MODIFICAR', '2018-12-30 09:02:47', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 17),
(112, 'CREAR', '2018-12-30 09:04:01', 2, 'Se creó programa terapéutico para el paciente, compuesto de 2 terapias.', NULL, NULL, 13),
(113, 'CREAR', '2018-12-30 09:05:12', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 27),
(114, 'CREAR', '2018-12-30 09:05:26', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 27),
(115, 'CREAR', '2018-12-30 09:08:19', 2, 'Se creó programa terapéutico para el paciente, compuesto de 2 terapias.', NULL, NULL, 27),
(116, 'CREAR', '2018-12-30 09:10:01', 2, 'Se creó programa terapéutico para el paciente, compuesto de 3 terapias.', NULL, NULL, 27),
(117, 'CREAR', '2018-12-30 09:15:10', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 28),
(118, 'CREAR', '2018-12-30 09:15:31', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 28),
(119, 'RESERVAR', '2018-12-30 09:15:31', 2, 'Se reservó cita para el dia 2018-12-28 para una terapia de , con los médicos:  medico 1,', NULL, NULL, 28),
(120, 'CREAR', '2018-12-30 09:47:35', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 28),
(121, 'MODIFICAR', '2018-12-30 09:49:01', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 28),
(122, 'MODIFICAR', '2018-12-30 10:39:29', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 12),
(123, 'RESERVAR', '2018-12-30 10:39:58', 2, 'Se reservó cita para el dia 2018-12-26 para una terapia de , con los médicos:  Medico 2,', NULL, NULL, 28);

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
(2, 'COMPLETO'),
(3, 'PARCIAL');

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
(1, '2018-12-09', 'aaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_medicas`
--

CREATE TABLE `historias_medicas` (
  `id_hm` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descripcion` text NOT NULL,
  `indicaciones` text NOT NULL,
  `diagnostico` text NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historias_medicas`
--

INSERT INTO `historias_medicas` (`id_hm`, `fecha`, `descripcion`, `indicaciones`, `diagnostico`, `id_paciente`) VALUES
(3, '2018-12-26 03:54:51', 'aaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', 'aaaaaaa', 12);

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
(11, '2018-12-25 23:43:34', 'paciente', '1812-2065804-1'),
(12, '2018-12-26 02:44:35', 'paciente', '1812-1'),
(13, '2018-12-26 04:07:12', 'paciente', '1812-2'),
(14, '2018-12-26 19:48:03', 'paciente', '1812-465'),
(15, '2018-12-28 19:05:15', 'paciente', '1812-27610730'),
(16, '2018-12-28 21:07:12', 'paciente', '1812-987-8'),
(17, '2018-12-29 00:19:43', 'paciente', '1812-a685'),
(18, '2018-12-29 00:20:43', 'paciente', '1812-aasd8'),
(19, '2018-12-29 10:01:14', 'paciente', '1812-999-9'),
(20, '2018-12-29 10:07:19', 'paciente', '1812-1111-1'),
(21, '2018-12-29 10:08:17', 'paciente', '1812-12345-6'),
(22, '2018-12-29 10:24:54', 'paciente', '1812-vre-1'),
(23, '2018-12-29 10:30:17', 'paciente', '1812-98765432-1'),
(24, '2018-12-29 10:35:22', 'paciente', '1812-tbu-1'),
(25, '2018-12-30 08:58:03', 'paciente', '1812-axx-a'),
(26, '2018-12-30 08:58:54', 'paciente', '1812-1010-1'),
(27, '2018-12-30 09:05:12', 'paciente', '1812-434-4'),
(28, '2018-12-30 09:15:10', 'paciente', '1812-000-0');

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
(12, '2065804-1', 'Jonny', '02629593105', '04261693370', 'jonnyrios33@gmail.com', 'ora ora ora', '', NULL, 'Rios', 'Morales', 0, '1', 11),
(29, '000-0', 'Prueba PROGRAMA ESPECIAL', 'd', 'f', 'c', 'g', '', NULL, 'a', 'b', 0, '1', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_tiene_reserva`
--

CREATE TABLE `paciente_tiene_reserva` (
  `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL,
  `paciente_id_paciente` int(11) NOT NULL,
  `reserva_medica_id_rm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `descuento` decimal(6,2) NOT NULL DEFAULT '0.00',
  `estado` varchar(45) DEFAULT 'activo',
  `estatus_pago_id_ep` int(11) DEFAULT '1',
  `especial` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Administrador'),
(3, 'Especialista');

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
(7, 7, 1),
(8, 1, 3);

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
(8, 'MASOTERAPIA  30 MINUTOS', 'MASOTERAPIA  30 MINUTOS', '15000.00', 'activa'),
(9, 'MASOTERAPIA 45 MINUTOS', 'MASOTERAPIA 45 MINUTOS', '20000.00', 'activa'),
(10, 'MASOTERAPIA 45 MINUTOS + CONTROL', 'MASOTERAPIA 45 MINUTOS + CONTROL', '25000.00', 'activa'),
(11, 'MASAJE SHIATSU 45 MINUTOS', 'MASAJE SHIATSU 45 MINUTOS', '25000.00', 'activa'),
(12, 'MASAJE SHIATSU + CONTROL', 'MASAJE SHIATSU + CONTROL', '30000.00', 'activa'),
(13, 'DRENAJE LINFATICO 45 MINUTOS', 'DRENAJE LINFATICO 45 MINUTOS', '25000.00', 'activa'),
(14, 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', '30000.00', 'activa'),
(15, 'MASOTERAPIA + VENTOSA 45 MINUTOS', 'MASOTERAPIA + VENTOSA 45 MINUTOS', '20000.00', 'activa'),
(16, 'EVALUACION TERAPIA DE DOLOR GENERAL', 'EVALUACION TERAPIA DE DOLOR GENERAL', '20000.00', 'activa'),
(17, 'EVALUACION GENERAL', 'EVALUACION GENERAL', '20000.00', 'activa'),
(18, 'CONTROL ', 'CONTROL ', '10000.00', 'activa'),
(19, 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFEREN', 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFERENCIAL\n', '10000.00', 'activa'),
(20, 'EVALUACION GENERAL CLIENTE PREFERENCIAL', 'EVALUACION GENERAL CLIENTE PREFERENCIAL\n\n', '10000.00', 'activa'),
(21, 'TERAPIA FLORAL', 'TERAPIA FLORAL\n\n\n', '30000.00', 'activa');

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
  ADD KEY `fk_programa_terapeutico_paciente1_idx` (`paciente_id_paciente`),
  ADD KEY `fk_programa_terapeutico_estatus_pago1_idx` (`estatus_pago_id_ep`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `entrada_historico`
--
ALTER TABLE `entrada_historico`
  MODIFY `id_entrada_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estatus_pago`
--
ALTER TABLE `estatus_pago`
  MODIFY `id_ep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id_feriados` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `historias_medicas`
--
ALTER TABLE `historias_medicas`
  MODIFY `id_hm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  MODIFY `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  MODIFY `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
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
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  MODIFY `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  MODIFY `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  MODIFY `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `rol_accion`
--
ALTER TABLE `rol_accion`
  MODIFY `id_ra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `terapia`
--
ALTER TABLE `terapia`
  MODIFY `id_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  ADD CONSTRAINT `fk_medico_tiene_especialidad_admin1` FOREIGN KEY (`admin_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medico_tiene_especialidad_especialidad1` FOREIGN KEY (`especialidad_id_especialidad`) REFERENCES `especialidad` (`id_especialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  ADD CONSTRAINT `fk_programa_terapeutico_estatus_pago1` FOREIGN KEY (`estatus_pago_id_ep`) REFERENCES `estatus_pago` (`id_ep`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
