-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2018 a las 03:52:24
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `premiun`
--
CREATE DATABASE IF NOT EXISTS `premiun` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `premiun`;

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
(1, 'admin', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1, 'activo');

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
(63, 45, 1),
(64, 46, 1),
(65, 47, 1),
(66, 48, 1),
(67, 49, 1),
(68, 50, 1),
(69, 51, 1),
(72, 54, 1),
(73, 55, 1),
(74, 56, 1),
(75, 57, 1);

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
(1, 'TV', '200'),
(2, 'Radio', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_mp` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `apellido` varchar(50) NOT NULL,
  `ficha_paciente_id_fp` int(11) NOT NULL,
  `estado_paciente` varchar(45) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellido`, `ficha_paciente_id_fp`, `estado_paciente`) VALUES
(5, '1', 'a', 'aaa', 'a', 'aaa', 'a', 'aaaa', NULL, 'b', 0, 'activo'),
(6, '5', 'qdaqsdasda', 'sdasda', 'sdasda', 'sdasdas', 'dasdasd', 'asdasd', NULL, 'asdasd', 0, 'activo');

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
(59, 5, 57);

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
  `descripcion_programa_terapeutico` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`) VALUES
(14, 5, '18-11-29'),
(15, 6, '"6-2018-Nov-Sat"'),
(18, 6, '"6-2018-Nov-Thu"');

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
(19, 15, 1, NULL, 'pendiente'),
(20, 15, 6, NULL, 'pendiente'),
(55, 14, 4, NULL, 'pendiente'),
(56, 18, 4, NULL, 'pendiente'),
(57, 18, 6, NULL, 'pendiente'),
(58, 18, 7, NULL, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_medica`
--

CREATE TABLE `reserva_medica` (
  `id_rm` int(11) NOT NULL,
  `fecha_hora_reserva` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_inicio` date NOT NULL,
  `medio_contacto_id_mc` int(11) NOT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `precio` decimal(10,2) UNSIGNED DEFAULT NULL,
  `estado` varchar(15) NOT NULL DEFAULT '0',
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva_medica`
--

INSERT INTO `reserva_medica` (`id_rm`, `fecha_hora_reserva`, `fecha_inicio`, `medio_contacto_id_mc`, `observaciones`, `precio`, `estado`, `hora_inicio`, `hora_fin`) VALUES
(43, '2018-11-18 21:00:00', '2018-11-13', 1, 'qweqwe', NULL, 'cancelado', '08:00:00', '09:30:00'),
(44, '2018-11-18 20:58:02', '2018-11-12', 1, 'asda', NULL, 'activo', '07:30:00', '08:30:00'),
(45, '2018-11-23 20:08:43', '2018-11-23', 1, '111asd', NULL, 'activo', '06:30:00', '08:00:00'),
(46, '2018-11-23 20:13:07', '2018-11-20', 1, 'oiou', NULL, 'activo', '07:30:00', '09:30:00'),
(47, '2018-11-24 05:44:29', '2018-11-21', 1, 'asdasd', NULL, 'activo', '06:30:00', '07:30:00'),
(48, '2018-11-24 05:46:02', '2018-11-22', 1, '132', NULL, 'activo', '07:00:00', '08:30:00'),
(49, '2018-11-24 05:46:58', '2018-11-24', 1, '132', NULL, 'activo', '08:00:00', '09:00:00'),
(50, '2018-11-24 05:47:59', '2018-11-25', 1, '132', NULL, 'activo', '06:00:00', '07:00:00'),
(51, '2018-11-24 05:48:32', '2018-11-22', 1, '132', NULL, 'activo', '06:00:00', '07:00:00'),
(54, '2018-11-29 13:25:45', '2018-12-01', 1, 'asdasdasdas', NULL, 'activo', '08:00:00', '10:00:00'),
(55, '2018-11-29 14:04:00', '2018-11-27', 1, '1234', NULL, 'activo', '07:00:00', '08:30:00'),
(56, '2018-11-29 14:05:02', '2018-11-30', 1, '1234', NULL, 'activo', '06:30:00', '07:30:00'),
(57, '2018-11-29 14:07:20', '2018-11-28', 1, '112', NULL, 'activo', '06:30:00', '07:30:00');

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
  `precio_terapia` decimal(8,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `terapia`
--

INSERT INTO `terapia` (`id_terapia`, `nombre_terapia`, `descripcion_terapia`, `precio_terapia`) VALUES
(1, 'aaa', 'asdasd', '120.00'),
(4, 'aaaaa', 'asdasd', '890.00'),
(5, 'aaaaa23', 'asdasd', '40.00'),
(6, 'aaa333', 'asdasda', '40.00'),
(7, 'aaa2', 'asdasd', '330.00');

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
  ADD PRIMARY KEY (`id_paciente`);

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
  ADD KEY `fk_reserva_medica_medio_contacto1_idx` (`medio_contacto_id_mc`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  MODIFY `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  MODIFY `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `medio_contacto`
--
ALTER TABLE `medio_contacto`
  MODIFY `id_mc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  MODIFY `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  MODIFY `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  MODIFY `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
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
  ADD CONSTRAINT `fk_reserva_medica_medio_contacto1` FOREIGN KEY (`medio_contacto_id_mc`) REFERENCES `medio_contacto` (`id_mc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
