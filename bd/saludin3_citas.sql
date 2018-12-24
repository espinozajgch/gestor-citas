-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-12-2018 a las 23:11:56
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
(2, 'ricardo', '123456', 'ricardo@admin.com', NULL, 'admin', 1, 3, 'activo'),
(3, 'Jose', '12345', 'homero_son@hotmail.com', NULL, '12345', 0, 3, '1');

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
(26, 'RESERVAR', '2018-12-13 21:00:07', 2, 'Se reservó cita para el dia 2018-12-12 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(27, 'RESERVAR', '2018-12-13 21:03:17', 2, 'Se reservó cita para el dia 2018-12-10 para una terapia de , con los médicos:  admin,', NULL, NULL, 5),
(28, 'RESERVAR', '2018-12-13 21:08:16', 2, 'Se reservó cita para el dia 2018-12-14 para una terapia de Diagnóstico, con los médicos:  admin,', NULL, NULL, 5),
(29, 'MODIFICAR', '2018-12-14 14:23:49', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 5),
(30, 'CREAR', '2018-12-15 11:55:21', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 6),
(31, 'RESERVAR', '2018-12-15 12:13:05', 2, 'Se reservó cita para el dia 2018-12-19 para una terapia de Diagnóstico, con los médicos:  admin,', NULL, NULL, 6),
(32, 'CREAR', '2018-12-15 12:28:45', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 7),
(33, 'RESERVAR', '2018-12-15 12:33:08', 2, 'Se reservó la primera cita del paciente para el día 2018-12-17 con los medicos:  ricardo,', NULL, NULL, 7),
(34, 'CREAR', '2018-12-15 13:14:49', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 8),
(35, 'RESERVAR', '2018-12-15 13:23:49', 2, 'Se reservó cita para el dia 2018-12-19 para una terapia de Masoterapia, con los médicos:  ricardo,', NULL, NULL, 8),
(36, 'RESERVAR', '2018-12-15 13:29:05', 2, 'Se reservó la primera cita del paciente para el día 2018-12-16 con los medicos:  ricardo,', NULL, NULL, 8),
(37, 'CREAR', '2018-12-15 13:35:59', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 9),
(38, 'RESERVAR', '2018-12-15 13:37:32', 2, 'Se reservó la primera cita del paciente para el día 2018-12-16 con los medicos:  ricardo,', NULL, NULL, 9),
(39, 'MODIFICAR', '2018-12-19 22:34:04', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 7),
(40, 'MODIFICAR', '2018-12-19 22:34:24', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 7),
(41, 'CREAR', '2018-12-19 22:35:19', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 10),
(42, 'MODIFICAR', '2018-12-20 19:25:28', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 10),
(43, 'MODIFICAR', '2018-12-20 19:56:16', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 8),
(44, 'MODIFICAR', '2018-12-20 19:57:02', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 8),
(45, 'MODIFICAR', '2018-12-20 19:57:10', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 8),
(46, 'MODIFICAR', '2018-12-20 19:57:18', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 8),
(47, 'MODIFICAR', '2018-12-20 19:59:29', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 7),
(48, 'MODIFICAR', '2018-12-20 19:59:36', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 7),
(49, 'MODIFICAR', '2018-12-20 19:59:50', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 7);

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
  `diagnostico` text NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historias_medicas`
--

INSERT INTO `historias_medicas` (`id_hm`, `fecha`, `descripcion`, `diagnostico`, `id_paciente`) VALUES
(1, '2018-12-21 14:38:30', '                                                        <p>terapia de detoxificación</p><p>dieta detox</p><p>Ejercicios</p><p>nutrientes</p><p>ññññññ</p><p><br></p>                                                ', 'pruebas', 12),
(2, '2018-12-15 16:47:48', '<p>GASTRITIS</p><p>EVALUACIÓN GASTRO</p><p>DIETA GASTRITIS</p><p>TRAT:&nbsp;</p><p>MELISSA 30 CAP, 1 CADA 8 HRS</p><p>CONTROL 20 DÍAS</p>', '', 11),
(3, '2018-12-15 16:51:13', 'HGYVGYGY', '', 11),
(4, '2018-12-20 22:36:40', 'fffffffff', 'nnnnnnnn', 12);

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
(7, '2018-12-15 12:28:45', 'paciente', '1812-18573577'),
(8, '2018-12-15 13:14:49', 'paciente', '1812-11882427-k'),
(9, '2018-12-15 13:35:59', 'paciente', '1812-15472794-9'),
(10, '2018-12-19 22:35:19', 'paciente', '1812-9703401');

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
(91, 71, 1),
(92, 72, 1),
(93, 73, 1),
(94, 49, 1),
(95, 74, 1),
(96, 75, 1),
(97, 76, 1),
(98, 77, 1),
(99, 78, 2),
(100, 79, 2),
(101, 80, 2),
(102, 81, 2);

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
  `apellidop` varchar(150) NOT NULL,
  `apellidom` varchar(150) NOT NULL,
  `fijo` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `imagen_id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `ficha_paciente_id_fp` int(11) NOT NULL,
  `estado_paciente` varchar(45) NOT NULL DEFAULT 'activo',
  `historico_id_historico` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `apellidop`, `apellidom`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(11, '18573577', 'Jose', '0', '', '02617355891', '04140696291', 'espinozajgx@gmail.com', 'Maracaibo, Venezuela', '', NULL, 0, '1', 7),
(12, '11882427-k', 'ricardo', '0', 'poblete', '226328960', '968972785', 'ricardo.nancur@gmail.com', 'santa lucia 118', '', NULL, 0, '1', 8),
(13, '15472794-9', 'MARCELO', '0', '', '226328948', '968972785', 'MARCELO.FARAY@GMAIL.COM', 'SANTA LUCIA 122', '', NULL, 0, '1', 9),
(14, '9703401', 'irama', 'prueba', 'de citas', '1 305-500-9199', '04140696281', 'ho', '11800 NW 101ST RD', '', NULL, 0, '1', 10);

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
(80, 11, 78),
(81, 12, 79),
(82, 12, 80),
(83, 13, 81);

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
(34, 11, 'Programa1', 'activo'),
(35, 12, 'masoterapia', 'activo'),
(36, 12, 'masoterapia', 'activo'),
(37, 13, 'TERAPIA DE DOLOR', 'activo'),
(38, 14, '', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_tiene_terapia`
--

CREATE TABLE `programa_tiene_terapia` (
  `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL,
  `programa_terapeutico_id_programa_terapeutico` int(10) UNSIGNED NOT NULL,
  `terapia_id_terapia` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `reserva_medica_id_rm` int(11) DEFAULT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_tiene_terapia`
--

INSERT INTO `programa_tiene_terapia` (`id_programa_tiene_terapia`, `programa_terapeutico_id_programa_terapeutico`, `terapia_id_terapia`, `reserva_medica_id_rm`, `estado`) VALUES
(108, 35, '8', 79, 'asignado'),
(109, 36, '8', NULL, 'pendiente'),
(110, 36, '9', NULL, 'pendiente'),
(111, 37, '8', NULL, 'pendiente'),
(119, 38, '8', NULL, 'pendiente'),
(177, 35, '8', NULL, 'pendiente'),
(178, 35, '8', NULL, 'pendiente'),
(179, 35, '8', NULL, 'pendiente'),
(180, 35, '8', NULL, 'pendiente'),
(181, 35, '8', NULL, 'pendiente'),
(182, 35, '8', NULL, 'pendiente'),
(183, 35, '8', NULL, 'pendiente'),
(184, 35, '8', NULL, 'pendiente'),
(186, 35, '9', NULL, 'pendiente'),
(187, 35, '9', NULL, 'pendiente'),
(188, 35, '9', NULL, 'pendiente'),
(189, 35, '9', NULL, 'pendiente'),
(190, 35, '9', NULL, 'pendiente'),
(191, 35, '9', NULL, 'pendiente'),
(192, 35, '9', NULL, 'pendiente'),
(193, 35, '9', NULL, 'pendiente'),
(194, 35, '9', NULL, 'pendiente'),
(195, 35, '9', NULL, 'pendiente'),
(196, 35, '9', NULL, 'pendiente'),
(197, 35, '9', NULL, 'pendiente'),
(198, 35, '9', NULL, 'pendiente'),
(199, 35, '9', NULL, 'pendiente'),
(200, 35, '9', NULL, 'pendiente'),
(201, 35, '9', NULL, 'pendiente'),
(202, 35, '9', NULL, 'pendiente'),
(203, 35, '9', NULL, 'pendiente'),
(204, 35, '9', NULL, 'pendiente'),
(205, 35, '9', NULL, 'pendiente'),
(206, 35, '9', NULL, 'pendiente'),
(207, 35, '9', NULL, 'pendiente'),
(208, 35, '9', NULL, 'pendiente'),
(209, 35, '9', NULL, 'pendiente'),
(210, 35, '9', NULL, 'pendiente'),
(211, 35, '9', NULL, 'pendiente'),
(212, 35, '9', NULL, 'pendiente'),
(224, 34, '8', NULL, 'pendiente'),
(225, 34, '9', NULL, 'pendiente'),
(226, 34, '1', NULL, 'pendiente'),
(227, 34, '8', NULL, 'pendiente'),
(228, 34, '8', NULL, 'pendiente'),
(229, 34, '1', NULL, 'pendiente'),
(230, 34, '8', NULL, 'pendiente'),
(231, 34, '8', NULL, 'pendiente');

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
(78, '2018-12-15 12:33:08', '2018-12-17', 1, 'Citas', NULL, 'pagado', '09:00:00', '10:00:00', NULL),
(79, '2018-12-15 13:23:49', '2018-12-19', 1, '', NULL, 'pagado', '11:00:00', '12:00:00', NULL),
(80, '2018-12-15 13:29:05', '2018-12-16', 2, '', NULL, 'pagado', '11:00:00', '12:00:00', NULL),
(81, '2018-12-15 13:37:32', '2018-12-16', 1, '', NULL, 'pagado', '10:00:00', '11:00:00', NULL);

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
(8, 2, 3);

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
(8, 'Masoterapia', 'terapia', '25000.00', 'activa'),
(9, 'terapia de dolor', 'masoterapia 45 minutos', '20000.00', 'activa');

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entrada_historico`
--
ALTER TABLE `entrada_historico`
  MODIFY `id_entrada_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  MODIFY `id_hm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  MODIFY `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  MODIFY `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  MODIFY `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  MODIFY `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  MODIFY `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
  MODIFY `id_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
