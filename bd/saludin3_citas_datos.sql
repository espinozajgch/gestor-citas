-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2019 a las 01:43:06
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

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1),
(3, 'RICARDO NANCUR', '2607', 'RICARDO.NANCUR@GMAIL.COM', NULL, '2607', 1, 3),
(4, 'esteban ortiz', '1182019', 'saludintegralcentro@gmail.com', NULL, '1182019', 1, 3),
(5, 'jose espinoza', '123456', 'espinozajgx@gmail.com', NULL, '123456', 0, 3);

--
-- Volcado de datos para la tabla `entrada_historico`
--

INSERT INTO `entrada_historico` (`id_entrada_historico`, `tipo_entrada`, `fecha_entrada`, `nivel_entrada`, `descripcion_entrada`, `tabla_relacionada`, `indice_tabla`, `historico_id_historico`) VALUES
(1, 'CREAR', '2019-01-05 19:39:17', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 4),
(2, 'RESERVAR', '2019-01-05 19:39:18', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 4),
(3, 'CREAR', '2019-01-05 20:11:22', 2, 'Se creó programa terapéutico para el paciente, compuesto de 0 terapias.', NULL, NULL, 3),
(4, 'MODIFICAR', '2019-01-05 20:11:30', 2, 'Se agregó un chequeo al programa terapeutico del paciente', NULL, NULL, 3);

--
-- Volcado de datos para la tabla `estatus_pago`
--

INSERT INTO `estatus_pago` (`id_ep`, `nombre`) VALUES
(1, 'PENDIENTE'),
(2, 'PAGADO'),
(3, 'PARCIAL'),
(4, 'TOTAL'),
(5, 'CANCELADO'),
(6, 'ATENDIDO'),
(7, 'INDIVIDUAL');

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
(34, 19, 3),
(35, 20, 3),
(36, 21, 3),
(37, 22, 3),
(38, 23, 4),
(39, 23, 3),
(40, 24, 3);

--
-- Volcado de datos para la tabla `medio_contacto`
--

INSERT INTO `medio_contacto` (`id_mc`, `nombre`, `cobro`) VALUES
(1, 'Personal', '0'),
(2, 'Radio', '10%'),
(3, 'Televisión', '5%');

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_mp`, `nombre`) VALUES
(1, 'Cheque'),
(2, 'Transferencia'),
(3, 'Efectivo'),
(4, 'Tarjeta de débito'),
(5, 'Tarjeta de crédito'),
(6, 'Pendiente');

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellidop`, `apellidom`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(3, '7299518-k', 'Fernando', '999426439', '999426439', '999426439', 'Gran avenida 3125, puente alto', '', NULL, 'Gonzalez', 'Araya', 0, '1', 3),
(4, '3481865-7', 'Rudy Benito', '228949252', '', '', 'SAN BERNARDO', '', NULL, 'Ibarra', 'Cisternas', 0, '1', 4),
(5, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '1', 5);

--
-- Volcado de datos para la tabla `paciente_tiene_reserva`
--

INSERT INTO `paciente_tiene_reserva` (`id_paciente_tiene_reserva`, `paciente_id_paciente`, `reserva_medica_id_rm`) VALUES
(24, 4, 24);

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`, `descuento`, `porcentaje_descuento`, `estado`, `estatus_pago_id_ep`, `especial`) VALUES
(15, 4, 'Primera terapia de RUDY BENITO IBARRA', '0.00', '', 'activo', 1, 1),
(16, 3, 'JOSE GREGORIO ESPINOZA CHAVEZ', '0', '10', 'activo', 1, 0);

--
-- Volcado de datos para la tabla `programa_tiene_terapia`
--

INSERT INTO `programa_tiene_terapia` (`id_programa_tiene_terapia`, `programa_terapeutico_id_programa_terapeutico`, `terapia_id_terapia`, `reserva_medica_id_rm`, `estado`) VALUES
(54, 15, 1, 24, 'pagado'),
(55, 16, 1, NULL, 'pendiente');

--
-- Volcado de datos para la tabla `reserva_medica`
--

INSERT INTO `reserva_medica` (`id_rm`, `fecha_hora_reserva`, `fecha_inicio`, `medio_contacto_id_mc`, `observaciones`, `precio`, `estado`, `hora_inicio`, `hora_fin`, `metodos_pago_id_mp`, `referencia`) VALUES
(24, '2019-01-05 19:39:17', '2019-01-07', 2, '', NULL, '2', '09:00:00', '10:00:00', 5, '012312210');

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'SuperAdmin'),
(2, 'Administrador'),
(3, 'Especialista'),
(4, 'TERAPEUTA');

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
(8, 1, 3),
(9, 1, 4),
(11, 2, 3);

--
-- Volcado de datos para la tabla `terapia`
--

INSERT INTO `terapia` (`id_terapia`, `nombre_terapia`, `descripcion_terapia`, `precio_terapia`, `estado_terapia`) VALUES
(1, 'CONTROL', 'CONTROL', 10000, 'activa'),
(2, 'MASOTERAPIA  30 MINUTOS', 'MASOTERAPIA  30 MINUTOS', 10000, 'activa'),
(9, 'MASOTERAPIA 45 MINUTOS', 'MASOTERAPIA 45 MINUTOS', 20000, 'activa'),
(10, 'MASOTERAPIA 45 MINUTOS + CONTROL', 'MASOTERAPIA 45 MINUTOS + CONTROL', 25000, 'activa'),
(11, 'MASAJE SHIATSU 45 MINUTOS', 'MASAJE SHIATSU 45 MINUTOS', 25000, 'activa'),
(12, 'MASAJE SHIATSU + CONTROL', 'MASAJE SHIATSU + CONTROL', 30000, 'activa'),
(13, 'DRENAJE LINFATICO 45 MINUTOS', 'DRENAJE LINFATICO 45 MINUTOS', 25000, 'activa'),
(14, 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', 'DRENAJE LINFATICO 45 MINUTOS + CONTROL', 30000, 'activa'),
(15, 'MASOTERAPIA + VENTOSA 45 MINUTOS', 'MASOTERAPIA + VENTOSA 45 MINUTOS', 20000, 'activa'),
(16, 'EVALUACION TERAPIA DE DOLOR GENERAL', 'EVALUACION TERAPIA DE DOLOR GENERAL', 20000, 'activa'),
(17, 'EVALUACION GENERAL', 'EVALUACION GENERAL', 20000, 'activa'),
(19, 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFEREN', 'EVALUACION TERAPIA DE DOLOR  CLIENTE PREFERENCIAL\n', 10000, 'activa'),
(20, 'EVALUACION GENERAL CLIENTE PREFERENCIAL', 'EVALUACION GENERAL CLIENTE PREFERENCIAL\n\n', 10000, 'activa'),
(21, 'TERAPIA FLORAL', 'TERAPIA FLORAL\n\n\n', 30000, 'activa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
