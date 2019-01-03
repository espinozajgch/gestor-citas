-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-01-2019 a las 11:06:48
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
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_accion`, `nombre`) VALUES
(1, 'Citas'),
(2, 'Pacientes'),
(3, 'Reportes'),
(4, 'Terapias'),
(5, 'Usuarios'),
(6, 'Calendario');

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`, `estado`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1, 'activo'),
(2, 'Jose Espinoza', '123456', 'espinozajgx@gmail.com', NULL, '123456', 0, 3, 'activo'),
(3, 'Ricardo Nancur', '2607', 'ricardo.nancur@gmail.com', NULL, '2607', 1, 3, 'activo'),
(4, 'esteban ortiz', '1182019', 'saludintegralcentro@gmail.com', NULL, '1182019', 1, 3, 'activo');

--
-- Volcado de datos para la tabla `entrada_historico`
--

INSERT INTO `entrada_historico` (`id_entrada_historico`, `tipo_entrada`, `fecha_entrada`, `nivel_entrada`, `descripcion_entrada`, `tabla_relacionada`, `indice_tabla`, `historico_id_historico`) VALUES
(1, 'CREAR', '2018-12-26 18:58:32', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 1),
(2, 'CREAR', '2018-12-26 19:33:52', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 1),
(3, 'MODIFICAR', '2018-12-26 19:34:01', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(4, 'RESERVAR', '2018-12-26 19:34:40', 2, 'Se reservó cita para el dia 2018-12-28 para una terapia de CONTROL, con los médicos:  Jose Espinoza,', NULL, NULL, 1),
(5, 'RESERVAR', '2018-12-26 19:38:13', 2, 'Se reservó cita para el dia 2018-12-31 para una terapia de MASOTERAPIA  30 MINUTOS, con los médicos:  Jose Espinoza,', NULL, NULL, 1),
(6, 'CREAR', '2018-12-26 19:46:20', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 2),
(7, 'CREAR', '2018-12-26 19:57:52', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 2),
(8, 'MODIFICAR', '2018-12-26 19:58:01', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(9, 'MODIFICAR', '2018-12-26 20:03:24', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(10, 'MODIFICAR', '2018-12-26 20:08:20', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(11, 'MODIFICAR', '2018-12-26 20:08:44', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(12, 'MODIFICAR', '2018-12-26 20:09:04', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 2),
(13, 'MODIFICAR', '2018-12-29 13:12:25', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 1),
(14, 'MODIFICAR', '2018-12-29 13:15:08', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 1),
(15, 'MODIFICAR', '2018-12-29 13:18:26', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 1),
(16, 'MODIFICAR', '2018-12-29 13:25:31', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(17, 'MODIFICAR', '2018-12-29 13:25:49', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 1),
(18, 'CREAR', '2018-12-29 13:41:28', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 3),
(19, 'CREAR', '2018-12-29 13:44:52', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 3),
(20, 'RESERVAR', '2018-12-29 13:44:52', 2, 'Se reservó cita para el dia 2018-12-29 para una terapia de , con los médicos:  Ricardo Nancur y esteban ortiz,', NULL, NULL, 3),
(21, 'MODIFICAR', '2018-12-29 13:48:15', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(22, 'MODIFICAR', '2018-12-29 13:48:23', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(23, 'CREAR', '2019-01-02 13:27:25', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 1),
(24, 'RESERVAR', '2019-01-02 13:27:26', 2, 'Se reservó cita para el dia 2019-01-03 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 1),
(25, 'CREAR', '2019-01-02 13:48:34', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 2),
(26, 'RESERVAR', '2019-01-02 13:48:54', 2, 'Se reservó cita para el dia 2019-01-02 para una terapia de , con los médicos:  Ricardo Nancur y esteban ortiz,', NULL, NULL, 2),
(27, 'CREAR', '2019-01-02 14:08:38', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 4),
(28, 'CREAR', '2019-01-02 15:18:32', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 3),
(29, 'MODIFICAR', '2019-01-02 15:18:41', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(30, 'MODIFICAR', '2019-01-02 15:18:47', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(31, 'CREAR', '2019-01-02 18:43:42', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 3),
(32, 'MODIFICAR', '2019-01-02 18:43:44', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(33, 'MODIFICAR', '2019-01-02 18:43:55', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 3),
(34, 'CREAR', '2019-01-02 18:46:19', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 5),
(35, 'CREAR', '2019-01-02 18:46:19', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 5),
(36, 'RESERVAR', '2019-01-02 18:46:19', 2, 'Se reservó cita para el dia 2019-01-04 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 5);

--
-- Volcado de datos para la tabla `estatus_pago`
--

INSERT INTO `estatus_pago` (`id_ep`, `nombre`) VALUES
(1, 'PENDIENTE'),
(2, 'PAGADO'),
(3, 'Parcial');

--
-- Volcado de datos para la tabla `estatus_usuario`
--

INSERT INTO `estatus_usuario` (`id_eu`, `nombre`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

--
-- Volcado de datos para la tabla `historias_medicas`
--

INSERT INTO `historias_medicas` (`id_hm`, `fecha`, `descripcion`, `indicaciones`, `diagnostico`, `id_paciente`) VALUES
(3, '2019-01-02 20:56:58', 'ARDOR EN PIERNA BILATERAL DISTAL. MAYOR A DERECHA, 1 MES\nOBS; LESIÓN LUMBAR, SIN ESTUDIOS RADIOLÓGICOS.\nDISLIPIDEMIA, PERFIL LIPÍDICO.\nHTA, CON TRATAMIENTO, ALMODIPINO, 10 MG, 1 COMPRIMIDO POR DIA, HOLTER DE PRESIÓN ARTERIAL\nHIPERTROFIA PROSTÁTICA, CON TRATAMIENTO, DUODART, 0,5 MG, 1 POR DIA, ECO DE CONFIRMACIÓN.\n', 'SENIOR 180 CAPSULAS ; 2 CAPSULAS CON DESAYUNO.\nMAGNESIO; 2 CAPSULAS CON EL ALMUERZO.\nGUATERO DE SEMILLAS: APLICAR POR 20 MINUTOS POR LA NOCHE, POR 10 DÍAS.\nARTRIOL 90 CAPSULAS ; TOMAR 1 CAPSULA 10 Y 20 HORAS.', 'REPOSO PARCIAL, NO DEBE REALIZAR FUERZAS MECANICAS\nAPLICAR CALOR LOCAL HÚMEDO, GUATERO DE SEMILLAS,  EN ZONA LUMBAR POR 20 MINUTOS POR LA NOCHE POR 10 DÍAS.\nCONTROL 20 DÍAS.', 4);

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id_historico`, `fecha_creacion`, `tipo_historico`, `codigo_historico`) VALUES
(4, '2019-01-02 14:08:38', 'paciente', '1901-3481865-7'),
(5, '2019-01-02 18:46:19', 'paciente', '1901-15472794-9');

--
-- Volcado de datos para la tabla `medico_tiene_reserva`
--

INSERT INTO `medico_tiene_reserva` (`id_medico_tiene_reserva`, `reserva_medica_id_rm`, `admin_id_admin`) VALUES
(17, 15, 4),
(18, 15, 3),
(19, 16, 3),
(20, 16, 4),
(21, 17, 3),
(22, 17, 4),
(31, 18, 3),
(32, 18, 4),
(34, 19, 3);

--
-- Volcado de datos para la tabla `medio_contacto`
--

INSERT INTO `medio_contacto` (`id_mc`, `nombre`, `cobro`) VALUES
(1, 'Personal', '0'),
(2, 'Radio', '50'),
(3, 'Televisión', '100');

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_mp`, `nombre`) VALUES
(1, 'Cheque'),
(2, 'Transferencia'),
(3, 'Efectivo'),
(4, 'Tarjeta de débito'),
(5, 'Tarje de crédito');

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellidop`, `apellidom`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(2, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '0', 2),
(3, '7299518-k', 'Fernando', '999426439', '999426439', '999426439', 'Gran avenida 3125, puente alto', '', NULL, 'Gonzalez', 'Araya', 0, '1', 3),
(4, '3481865-7', 'Rudy Benito', '228949252', '', '', 'SAN BERNARDO', '', NULL, 'Ibarra', 'Cisternas', 0, '1', 4),
(5, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '1', 5);

--
-- Volcado de datos para la tabla `paciente_tiene_reserva`
--

INSERT INTO `paciente_tiene_reserva` (`id_paciente_tiene_reserva`, `paciente_id_paciente`, `reserva_medica_id_rm`) VALUES
(15, 2, 15),
(16, 3, 16),
(17, 3, 17),
(18, 3, 18),
(19, 5, 19);

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`, `estado`, `descuento`, `estatus_pago_id_ep`, `especial`) VALUES
(5, 2, '', 'activo', '0.00', 1, 0),
(6, 3, 'MASOTERAPIA', 'cancelado', '0.00', 3, 0),
(7, 3, 'Masoterapia', 'activo', '0.00', 2, 0),
(8, 5, 'Primera terapia de Marcelo  Faray', 'activo', '0.00', 1, 1);

--
-- Volcado de datos para la tabla `programa_tiene_terapia`
--

INSERT INTO `programa_tiene_terapia` (`id_programa_tiene_terapia`, `programa_terapeutico_id_programa_terapeutico`, `terapia_id_terapia`, `reserva_medica_id_rm`, `estado`) VALUES
(34, 5, 2, 15, 'pagado'),
(38, 7, 9, NULL, 'pendiente'),
(39, 7, 9, NULL, 'pendiente'),
(40, 7, 10, NULL, 'pendiente'),
(41, 8, 1, 19, 'pagado');

--
-- Volcado de datos para la tabla `reserva_medica`
--

INSERT INTO `reserva_medica` (`id_rm`, `fecha_hora_reserva`, `fecha_inicio`, `medio_contacto_id_mc`, `observaciones`, `precio`, `estado`, `hora_inicio`, `hora_fin`, `metodos_pago_id_mp`) VALUES
(15, '2019-01-02 13:52:55', '2019-01-02', 1, '', NULL, 'cancelado', '00:00:00', '00:00:00', 1),
(16, '2019-01-02 14:45:28', '2019-01-02', 1, '', NULL, 'cancelado', '15:00:00', '16:00:00', 1),
(17, '2019-01-02 14:45:23', '2019-01-02', 1, '', NULL, 'cancelado', '15:00:00', '16:00:00', 1),
(18, '2019-01-02 18:12:11', '2019-01-02', 1, 'NO ASISTE A LA CITA, PIERDE TERAPIA PENDIENTE CONTROL', NULL, 'pagado', '15:00:00', '16:00:00', 1),
(19, '2019-01-02 18:47:15', '2019-01-04', 1, '', NULL, 'pagado', '13:00:00', '14:00:00', 1);

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'SuperAdmin'),
(2, 'Administrador'),
(3, 'Especialista');

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

--
-- Volcado de datos para la tabla `terapia`
--

INSERT INTO `terapia` (`id_terapia`, `nombre_terapia`, `descripcion_terapia`, `precio_terapia`, `estado_terapia`) VALUES
(1, 'CONTROL', 'CONTROL', '10000.00', 'activa'),
(2, 'MASOTERAPIA  30 MINUTOS', 'MASOTERAPIA  30 MINUTOS', '10000.00', 'activa'),
(9, 'MASOTERAPIA 45 MINUTOS', 'MASOTERAPIA 45 MINUTOS', '20000.00', 'activa'),
(10, 'MASOTERAPIA 45 MINUTOS + CONTROL', 'MASOTERAPIA 45 MINUTOS + CONTROL', '25000.00', 'activa'),
(11, 'MASAJE SHIATSU 45 MINUTOS', 'MASAJE SHIATSU 45 MINUTOS', '25000.00', 'activa'),
(12, 'MASAJE SHIATSU + CONTROL', 'MASAJE SHIATSU + CONTROL', '30000.00', 'activa'),
(13, 'DRENAJE LINFATICO 45 MINUTOS', 'DRENAJE LINFATICO 45 MINUTOS', '25000.00', 'activa'),
(14, 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', '30000.00', 'activa'),
(15, 'MASOTERAPIA + VENTOSA 45 MINUTOS', 'MASOTERAPIA + VENTOSA 45 MINUTOS', '20000.00', 'activa'),
(16, 'EVALUACION TERAPIA DE DOLOR GENERAL', 'EVALUACION TERAPIA DE DOLOR GENERAL', '20000.00', 'activa'),
(17, 'EVALUACION GENERAL', 'EVALUACION GENERAL', '20000.00', 'activa'),
(19, 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFEREN', 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFERENCIAL\n', '10000.00', 'activa'),
(20, 'EVALUACION GENERAL CLIENTE PREFERENCIAL', 'EVALUACION GENERAL CLIENTE PREFERENCIAL\n\n', '10000.00', 'activa'),
(21, 'TERAPIA FLORAL', 'TERAPIA FLORAL\n\n\n', '30000.00', 'activa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
