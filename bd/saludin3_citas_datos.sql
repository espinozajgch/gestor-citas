-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2019 a las 16:18:47
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

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`, `estado`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1, 'activo'),
(3, 'Ricardo Nancur', '2607', 'ricardo.nancur@gmail.com', NULL, '2607', 1, 3, 'activo'),
(4, 'esteban ortiz', '1182019', 'saludintegralcentro@gmail.com', NULL, '1182019', 1, 3, 'activo');

--
-- Volcado de datos para la tabla `estatus_pago`
--

INSERT INTO `estatus_pago` (`id_ep`, `nombre`) VALUES
(1, 'PENDIENTE'),
(2, 'PAGADO'),
(3, 'PARCIAL'),
(4, 'TOTAL');

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
(39, 23, 3);

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
(5, 'Tarje de crédito'),
(6, 'Pendiente');

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `RUT`, `nombre`, `fijo`, `celular`, `email`, `direccion`, `clave`, `imagen_id_imagen`, `apellidop`, `apellidom`, `ficha_paciente_id_fp`, `estado_paciente`, `historico_id_historico`) VALUES
(3, '7299518-k', 'Fernando', '999426439', '999426439', '999426439', 'Gran avenida 3125, puente alto', '', NULL, 'Gonzalez', 'Araya', 0, '1', 3),
(4, '3481865-7', 'Rudy Benito', '228949252', '', '', 'SAN BERNARDO', '', NULL, 'Ibarra', 'Cisternas', 0, '1', 4),
(5, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '1', 5);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
