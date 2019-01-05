-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2019 a las 16:16:35
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

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
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_usuario`
--

CREATE TABLE `estatus_usuario` (
  `id_eu` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `apellidop` varchar(50) NOT NULL,
  `apellidom` varchar(45) NOT NULL,
  `ficha_paciente_id_fp` int(11) NOT NULL,
  `estado_paciente` varchar(45) NOT NULL DEFAULT 'activo',
  `historico_id_historico` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `metodos_pago_id_mp` int(11) DEFAULT NULL,
  `referencia` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_accion`
--

CREATE TABLE `rol_accion` (
  `id_ra` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id_entrada_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estatus_pago`
--
ALTER TABLE `estatus_pago`
  MODIFY `id_ep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id_feriados` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historias_medicas`
--
ALTER TABLE `historias_medicas`
  MODIFY `id_hm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_especialidad`
--
ALTER TABLE `medico_tiene_especialidad`
  MODIFY `id_medico_tiene_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medico_tiene_reserva`
--
ALTER TABLE `medico_tiene_reserva`
  MODIFY `id_medico_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `medio_contacto`
--
ALTER TABLE `medio_contacto`
  MODIFY `id_mc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_reserva`
--
ALTER TABLE `paciente_tiene_reserva`
  MODIFY `id_paciente_tiene_reserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `paciente_tiene_tratamiento`
--
ALTER TABLE `paciente_tiene_tratamiento`
  MODIFY `id_paciente_tiene_tratamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programa_terapeutico`
--
ALTER TABLE `programa_terapeutico`
  MODIFY `id_programa_terapeutico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `programa_tiene_terapia`
--
ALTER TABLE `programa_tiene_terapia`
  MODIFY `id_programa_tiene_terapia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `reserva_medica`
--
ALTER TABLE `reserva_medica`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
