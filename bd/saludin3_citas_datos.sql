-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-01-2019 a las 21:47:12
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

INSERT INTO `admin` (`id_admin`, `nombre`, `password`, `email`, `telefono`, `hash`, `id_eu`, `id_rol`) VALUES
(1, 'Ricardo Nancur', 'admin', 'citas@saludintegralcentro.com', NULL, 'admin', 1, 1),
(3, 'Ricardo Nancur', '2607', 'ricardo.nancur@gmail.com', NULL, '2607', 1, 3),
(4, 'esteban ortiz', '1182019', 'saludintegralcentro@gmail.com', NULL, '1182019', 1, 3),
(6, 'MARCELO FARAY', '123456', 'MARCELO.FARAY@GMAIL.COM', NULL, '123456', 1, 2),
(7, 'Jose Espinoza', 'admin', 'admin@admin.com', NULL, 'admin', 1, 1);

--
-- Volcado de datos para la tabla `entrada_historico`
--

INSERT INTO `entrada_historico` (`id_entrada_historico`, `tipo_entrada`, `fecha_entrada`, `nivel_entrada`, `descripcion_entrada`, `tabla_relacionada`, `indice_tabla`, `historico_id_historico`) VALUES
(1, 'CREAR', '2019-01-05 12:35:31', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 6),
(2, 'CREAR', '2019-01-05 13:35:31', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 7),
(3, 'CREAR', '2019-01-05 13:35:31', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 7),
(4, 'RESERVAR', '2019-01-05 13:35:31', 2, 'Se reservó cita para el dia 2019-01-08 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 7),
(5, 'CREAR', '2019-01-05 13:37:40', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 8),
(6, 'CREAR', '2019-01-05 13:37:40', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 8),
(7, 'RESERVAR', '2019-01-05 13:37:40', 2, 'Se reservó cita para el dia 2019-01-08 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 8),
(8, 'CREAR', '2019-01-05 13:40:44', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 9),
(9, 'CREAR', '2019-01-05 13:40:44', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 9),
(10, 'RESERVAR', '2019-01-05 13:40:44', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 9),
(11, 'CREAR', '2019-01-05 13:54:26', 2, 'Se creó programa terapéutico para el paciente, compuesto de 2 terapias.', NULL, NULL, 9),
(12, 'MODIFICAR', '2019-01-05 13:54:40', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 9),
(13, 'MODIFICAR', '2019-01-05 13:54:49', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 9),
(14, 'MODIFICAR', '2019-01-05 13:54:57', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 9),
(15, 'CREAR', '2019-01-05 14:14:40', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 10),
(16, 'CREAR', '2019-01-05 14:58:24', 2, 'Se creó programa terapéutico para el paciente, compuesto de 3 terapias.', NULL, NULL, 4),
(17, 'MODIFICAR', '2019-01-05 14:58:33', 2, 'Se modificarón las terapias activas del paciente.', NULL, NULL, 4),
(18, 'CREAR', '2019-01-07 10:30:42', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 11),
(19, 'CREAR', '2019-01-07 10:32:22', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 11),
(20, 'RESERVAR', '2019-01-07 10:32:22', 2, 'Se reservó cita para el dia 2019-01-09 para una terapia de , con los médicos:  Ricardo Nancur y esteban ortiz,', NULL, NULL, 11),
(21, 'CREAR', '2019-01-07 10:43:45', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 12),
(22, 'CREAR', '2019-01-07 10:43:46', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 12),
(23, 'RESERVAR', '2019-01-07 10:43:46', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 12),
(24, 'CREAR', '2019-01-07 12:10:03', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 13),
(25, 'CREAR', '2019-01-07 12:10:03', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 14),
(26, 'CREAR', '2019-01-07 12:10:04', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 13),
(27, 'CREAR', '2019-01-07 12:10:04', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 14),
(28, 'RESERVAR', '2019-01-07 12:10:04', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 14),
(29, 'RESERVAR', '2019-01-07 12:10:04', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 14),
(30, 'CREAR', '2019-01-07 12:11:50', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 15),
(31, 'CREAR', '2019-01-07 12:11:50', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 15),
(32, 'RESERVAR', '2019-01-07 12:11:50', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 15),
(33, 'CREAR', '2019-01-07 12:20:14', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 16),
(34, 'CREAR', '2019-01-07 12:20:15', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 16),
(35, 'RESERVAR', '2019-01-07 12:20:16', 2, 'Se reservó cita para el dia 2019-01-07 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 16),
(36, 'CREAR', '2019-01-07 12:53:25', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 16),
(37, 'RESERVAR', '2019-01-07 12:53:26', 2, 'Se reservó cita para el dia 2019-01-08 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 16),
(38, 'CREAR', '2019-01-07 13:12:11', 2, 'Se creó la historia clinica del paciente', NULL, NULL, 17),
(39, 'CREAR', '2019-01-07 13:12:11', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 17),
(40, 'RESERVAR', '2019-01-07 13:12:11', 2, 'Se reservó cita para el dia 2019-01-08 para una terapia de , con los médicos:  Ricardo Nancur,', NULL, NULL, 17),
(41, 'CREAR', '2019-01-07 13:14:51', 2, 'Se creó programa terapéutico para el paciente, compuesto de 1 terapias.', NULL, NULL, 5),
(42, 'RESERVAR', '2019-01-07 13:14:51', 2, 'Se reservó cita para el dia 2019-01-08 para una terapia de , con los médicos:  esteban ortiz y Ricardo Nancur,', NULL, NULL, 5);

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
(3, '2019-01-05 17:57:10', 'ARDOR EN PIERNA BILATERAL DISTAL. MAYOR A DERECHA, 1 MES\nOBS; LESIÓN LUMBAR, SIN ESTUDIOS RADIOLÓGICOS.\nDISLIPIDEMIA, PERFIL LIPÍDICO.\nHTA, CON TRATAMIENTO, ALMODIPINO, 10 MG, 1 COMPRIMIDO POR DIA, HOLTER DE PRESIÓN ARTERIAL\nHIPERTROFIA PROSTÁTICA, CON TRATAMIENTO, DUODART, 0,5 MG, 1 POR DIA, ECO DE CONFIRMACIÓN.\n', 'SENIOR 180 CAPSULAS ; 2 CAPSULAS CON DESAYUNO.\nMAGNESIO; 2 CAPSULAS CON EL ALMUERZO.\nGUATERO DE SEMILLAS: APLICAR POR 20 MINUTOS POR LA NOCHE, POR 10 DÍAS.\nARTRIOL 90 CAPSULAS ; TOMAR 1 CAPSULA 10 Y 20 HORAS.', 'REPOSO PARCIAL, NO DEBE REALIZAR FUERZAS MECANICAS\nAPLICAR CALOR LOCAL HÚMEDO, GUATERO DE SEMILLAS,  EN ZONA LUMBAR POR 20 MINUTOS POR LA NOCHE POR 10 DÍAS.\nCONTROL 20 DÍAS.\n\n', 4),
(5, '2019-01-07 15:04:24', 'RESISTENCIA A LA INSULINA, TRIGLICERIDOS ELEVADOS,NO RECUERDA EL NOMBRE DEL MEDICAMENTO PRESCRITO ; HIPOTIROIDISMO, TRATAMIENTO EUTIROX 88 MG., HEMORROIDES, DISBIOSIS INTESTINAL, SIENTE IRRITACIóN INTESTINAL.', 'PASIFLORA 60 CAP: 1 CAPSULA C/ 6 HRS, 9 - 15 - 21 HRS.\nDIENTE DE LEÓN 60  CAP..; TOMAR 2 CAPSULAS 1/2 HORA ANTES DE COMIDAS PRINCIPALES ALMUERZO Y CENA.\nUÑA DE GATO 60 CAP.: TOMAR 1 CAPSULA 1/2 HORA ANTES DE LAS COMIDAS PRINCIPALES.\nCEREBRO TONICO  90 CAP : TOMAR 2 CAPSULAS CON DESAYUNO.\n', 'RéGIMEN DETOX POR 10 DÍAS / CONTROL\nACTIVIDAD FíSICA 30 MINUTOS 3 VECES POR SEMANA\nINFUSIÓN DEPURATIVA; MALVA ROSA, LLANTÉN, MANZANILLA, TOMAR 3 VECES POR DíA.', 11),
(6, '2019-01-07 17:56:21', 'FIBROSIS PULMONAR / CRóNICA, OPERADA DE VESíCULA 16 DE DICIEMBRE 2019. DOLOR PIERNA DERECHA, RODILLA; SUSPENDIó TRATAMIENTO DE PIRFENEX, MEDICACIóN PARA FIBROSIS PULMONAR, POR TRASTORNOS DIGESTIVOS, INAPETENTE.\nTRATAMIENTO MEDICO CODEINA GOTAS 30 GOTAS C/8 HRS., MEMOREX', 'ARTRIOL 90 CAPSULAS: TOMAR 2 CAPSULAS A LAS 10 AM.\nUNGUENTO BOTANICO: APLICAR 2 VECES POR DÍA EN ZONA DE DOLOR.\nBIO ALER 60 CAPSULAS: TOMAR 2 CAPSULAS MAÑANA Y NOCHE\nSENEDIUM 90 CAPSULAS: TOMAR 2 CAPSULAS CON DESAYUNO.\n\n', 'RÉGIMEN DE MANTENCION\nDEBE EVITAR CARGAS MECÁNICAS\nAPLICAR FRICCIONES DE UNGÜENTO BOTÁNICO, 2 VECES POR DÍA.\nPENDIENTE TRATAMIENTO PARA INSUFICIENCIA VENOSA, INDICARLO EN PRÓXIMO CONTROL.\n\nPARA CONTROL DEBE TRAER EXÁMENES DE SANGRE.\n', 13),
(7, '2019-01-07 18:23:25', 'BOCHORNOS, SE HA SENTIDO UN POCO MAREADA DESPUÉS DE TOMAR TRATAMIENTO PARA LA PRESIÓN ARTERIAL, LOSARTAN, NITRENDIPINO, ASPIRINA, \nPESO; 86 KGS.', 'SENIOR; 2 CAPSULAS AL DESAYUNO\nNEUROSENTE 90 CAPSULAS: TOMAR 1 CAPSULA ALAS 10 Y 20 HRS.\nSILUETA 180 CAPSULAS: 2 CAPSULAS A MEDIA MAÑANA CON UN GRAN VASO DE AGUA.\nLONG LIFE 90 CAPSULAS: TOMAR 2 CAPSULAS ANTES DE ALMUERZO.', 'NO JUNTAR TERAPIAS ANTIHIPERTENSIVAS, SEPARARLAS, TOMAR PRIMERO LOSARTAN / ASPIRINA Y LUEGO DESPUÉS DE 1 HORA NITRENDIPINO / PRODUCTO PARA VARICES.\nMANTENER RÉGIMEN DE MANTENCION.\nREALIZAR ACTIVIDAD FÍSICA, 30 MINUTOS 3 VECES POR SEMANA.', 14),
(8, '2019-01-07 19:00:40', '', '', '', 5);

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id_historico`, `fecha_creacion`, `tipo_historico`, `codigo_historico`) VALUES
(4, '2019-01-02 14:08:38', 'paciente', '1901-3481865-7'),
(5, '2019-01-02 18:46:19', 'paciente', '1901-15472794-9'),
(6, '2019-01-05 12:35:31', 'paciente', '1901-1857357-7'),
(7, '2019-01-05 13:35:31', 'paciente', '1901-5544286-7'),
(8, '2019-01-05 13:37:40', 'paciente', '1901-6854565-K'),
(9, '2019-01-05 13:40:44', 'paciente', '1901-3596528-9'),
(10, '2019-01-05 14:14:40', 'paciente', '1901-1857357-7'),
(11, '2019-01-07 10:30:42', 'paciente', '1901-6.349.895-1'),
(12, '2019-01-07 10:43:45', 'paciente', '1901-11693947-9'),
(13, '2019-01-07 12:10:03', 'paciente', '1901-4196271-2'),
(14, '2019-01-07 12:10:03', 'paciente', '1901-4196271-2'),
(15, '2019-01-07 12:11:50', 'paciente', '1901-8444188-0'),
(16, '2019-01-07 12:20:14', 'paciente', '1901-4406471-5'),
(17, '2019-01-07 13:12:11', 'paciente', '1901-9604913-7');

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
(40, 24, 3),
(41, 25, 3),
(42, 26, 3),
(45, 27, 4),
(46, 28, 3),
(47, 28, 4),
(49, 29, 3),
(50, 30, 3),
(51, 31, 3),
(53, 32, 3),
(54, 33, 3),
(55, 34, 3),
(56, 35, 3),
(57, 36, 4),
(58, 36, 3);

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
(5, '15472794-9', 'Marcelo ', '226328948', '968972785', 'marcelo.faray@gmail.com', '', '', NULL, 'Faray', 'Porma', 0, '1', 5),
(7, '5544286-7', 'maria cristina', '226481654', '', '', '', '', NULL, 'vallejos', 'vallejos', 0, '1', 7),
(8, '6854565-K', 'paulina', '228310688', '', '', 'melipilla', '', NULL, 'sanchez', 'sanchez', 0, '1', 8),
(10, '6.349.895-1', 'ODETTE DEL CARMEN', '', '949352421', '', '', '', NULL, 'TOY', 'VALDEZ', 0, '1', 11),
(11, '11693947-9', 'PAMELA ', '', '996250556', 'pafosnbdo@hotmail.com', 'SAN BERNARDO', '', NULL, 'FEBRE', 'OJEDA', 0, '1', 12),
(13, '4196271-2', 'YOLANDA', '223595671', '', '', 'PEDRO AGUIRRE CERDA', '', NULL, 'GUTIEREZ', 'ADASME', 0, '1', 14),
(14, '8444188-0', 'YOLANDA ', '', '942616513', '', 'PEDRO AGUIRRE CERDA', '', NULL, 'HERNANDEZ', 'GUTIERREZ', 0, '1', 15),
(15, '4406471-5', 'HILDEBRANDO', '', '998441629', '', 'SANTIAGO', '', NULL, 'SCHULZ', 'BELLO', 0, '1', 16),
(16, '9604913-7', 'juana', '', '959024152', '', 'san bernardo', '', NULL, 'inostroza', 'zapata', 0, '1', 17);

--
-- Volcado de datos para la tabla `paciente_tiene_reserva`
--

INSERT INTO `paciente_tiene_reserva` (`id_paciente_tiene_reserva`, `paciente_id_paciente`, `reserva_medica_id_rm`) VALUES
(24, 3, 24),
(25, 7, 25),
(26, 8, 26),
(27, 9, 27),
(28, 10, 28),
(29, 11, 29),
(30, 13, 30),
(31, 13, 31),
(32, 14, 32),
(33, 15, 33),
(34, 15, 34),
(35, 16, 35),
(36, 5, 36);

--
-- Volcado de datos para la tabla `programa_terapeutico`
--

INSERT INTO `programa_terapeutico` (`id_programa_terapeutico`, `paciente_id_paciente`, `descripcion_programa_terapeutico`, `descuento`, `porcentaje_descuento`, `estado`, `estatus_pago_id_ep`, `referencia`, `especial`, `metodos_pago_id_mp`) VALUES
(15, 7, 'Primera terapia de maria cristina vallejos', '0.00', '10', 'activo', 1, '', 1, NULL),
(16, 8, 'Primera terapia de paulina sanchez', '0.00', '10', 'activo', 1, '', 1, NULL),
(17, 9, 'Primera terapia de herminia poblete', '0.00', '10', 'activo', 1, '', 1, NULL),
(18, 9, 'masoterapia', '10.00', '10', 'activo', 1, '', 0, NULL),
(19, 4, 'masoterapia', '0.00', '10', 'activo', 1, '', 0, NULL),
(20, 10, 'Primera terapia de ODETTE DEL CARMEN TOY', '0.00', '10', 'activo', 1, '', 1, NULL),
(21, 11, 'Primera terapia de PAMELA  FEBRE', '0.00', '10', 'activo', 1, '', 1, NULL),
(22, 12, 'Primera terapia de YOLANDA GUTIEREZ', '0.00', '10', 'activo', 1, '', 1, NULL),
(23, 13, 'Primera terapia de YOLANDA GUTIEREZ', '0.00', '10', 'activo', 1, '', 1, NULL),
(24, 14, 'Primera terapia de YOLANDA  HERNANDEZ', '0.00', '10', 'activo', 1, '', 1, NULL),
(25, 15, 'Primera terapia de HILDEBRANDO SCHULZ', '0.00', '10', 'activo', 1, '', 1, NULL),
(26, 15, 'Primera terapia de HILDEBRANDO SCHULZ', '0.00', '10', 'activo', 1, '', 1, NULL),
(27, 16, 'Primera terapia de juana inostroza', '0.00', '10', 'activo', 1, '', 1, NULL),
(28, 5, 'Primera terapia de MARCELO  FARAY', '0.00', '10', 'activo', 1, '', 1, NULL);

--
-- Volcado de datos para la tabla `programa_tiene_terapia`
--

INSERT INTO `programa_tiene_terapia` (`id_programa_tiene_terapia`, `programa_terapeutico_id_programa_terapeutico`, `terapia_id_terapia`, `reserva_medica_id_rm`, `estado`) VALUES
(54, 15, 17, 25, 'pagado'),
(55, 16, 1, 26, 'pagado'),
(56, 17, 2, 27, 'pagado'),
(57, 18, 9, NULL, 'pendiente'),
(58, 18, 9, NULL, 'pendiente'),
(59, 18, 10, NULL, 'pendiente'),
(60, 18, 9, NULL, 'pendiente'),
(61, 18, 9, NULL, 'pendiente'),
(62, 18, 10, NULL, 'pendiente'),
(63, 19, 11, NULL, 'pendiente'),
(64, 19, 11, NULL, 'pendiente'),
(65, 19, 11, NULL, 'pendiente'),
(66, 19, 12, NULL, 'pendiente'),
(67, 20, 16, 28, 'pagado'),
(68, 21, 17, 29, 'pagado'),
(69, 22, 1, 30, 'pagado'),
(70, 23, 1, 31, 'cancelado'),
(71, 24, 1, 32, 'pagado'),
(72, 25, 17, 33, '5'),
(73, 26, 17, 34, 'pagado'),
(74, 27, 17, 35, 'pagado'),
(75, 28, 2, 36, 'cancelado');

--
-- Volcado de datos para la tabla `reserva_medica`
--

INSERT INTO `reserva_medica` (`id_rm`, `fecha_hora_reserva`, `fecha_inicio`, `medio_contacto_id_mc`, `observaciones`, `precio`, `estado`, `hora_inicio`, `hora_fin`, `metodos_pago_id_mp`, `referencia`, `estatus_pago_id_ep`) VALUES
(25, '2019-01-05 13:35:31', '2019-01-08', 1, '', NULL, '1', '10:00:00', '11:00:00', 6, '', NULL),
(26, '2019-01-05 13:37:40', '2019-01-08', 1, '', NULL, '1', '11:00:00', '12:00:00', 6, '', NULL),
(27, '2019-01-05 13:47:01', '2019-01-07', 1, '', NULL, '2', '10:00:00', '11:00:00', 6, '76005415', NULL),
(28, '2019-01-07 10:32:22', '2019-01-09', 1, '', NULL, '1', '16:00:00', '17:00:00', 1, '', NULL),
(29, '2019-01-07 10:43:46', '2019-01-07', 1, '', NULL, '1', '11:00:00', '12:00:00', 3, '', NULL),
(30, '2019-01-07 12:10:04', '2019-01-07', 1, '', NULL, '1', '14:00:00', '15:00:00', 1, '', NULL),
(31, '2019-01-07 13:07:34', '2019-01-07', 1, '', NULL, '5', '14:00:00', '15:00:00', 1, '', NULL),
(32, '2019-01-07 12:51:49', '2019-01-07', 1, '', NULL, '2', '15:00:00', '16:00:00', 1, '', NULL),
(33, '2019-01-07 14:04:43', '2019-01-07', 2, 'INSUFICIENCIA VENOSA', NULL, '5', '17:00:00', '18:00:00', 1, '', NULL),
(34, '2019-01-07 12:53:26', '2019-01-08', 1, '', NULL, '1', '11:00:00', '12:00:00', 3, '', NULL),
(35, '2019-01-07 13:12:11', '2019-01-08', 2, 'dislipidemia', NULL, '1', '14:00:00', '15:00:00', 1, '', NULL),
(36, '2019-01-07 13:15:22', '2019-01-08', 1, '', NULL, '5', '10:00:00', '11:00:00', 1, '', NULL);

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
(8, 1, 3),
(10, 2, 2),
(11, 3, 2),
(12, 4, 2),
(13, 5, 2),
(15, 1, 2);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
