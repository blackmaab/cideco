-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2013 a las 02:56:26
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gd_cideco_es`
--
CREATE DATABASE `gd_cideco_es` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gd_cideco_es`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `nie` int(11) NOT NULL,
  `destacado_en` varchar(100) DEFAULT NULL,
  `necesidades_medicas` varchar(100) DEFAULT NULL,
  `numero_hermanos` int(11) DEFAULT NULL,
  `vive_con` varchar(255) NOT NULL,
  `grande_quiere_ser` varchar(100) DEFAULT NULL,
  `juego_favorito` varchar(100) DEFAULT NULL,
  `materia_favorita` varchar(100) DEFAULT NULL,
  `ayuda_en_casa` varchar(100) DEFAULT NULL,
  `fecha_creacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `Fkey_alumno_persona` (`id_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `id_persona`, `nie`, `destacado_en`, `necesidades_medicas`, `numero_hermanos`, `vive_con`, `grande_quiere_ser`, `juego_favorito`, `materia_favorita`, `ayuda_en_casa`, `fecha_creacion`) VALUES
(1, 13, 6045, 'Matematica', NULL, 3, 'Padres', 'Doctor', 'Futbol', 'Matematicas', 'Si', '2013-06-01'),
(2, 14, 4025, '', '', 4, '', '', '', '', '', '2013-05-30 18:52:05'),
(3, 15, 6256, '', '', 5, '', '', '', '', '', '2013-05-30 18:59:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio_transacciones`
--

CREATE TABLE IF NOT EXISTS `anio_transacciones` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `anio_trans` int(11) NOT NULL DEFAULT '0',
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `anio_transacciones`
--

INSERT INTO `anio_transacciones` (`Id`, `anio_trans`, `activo`) VALUES
(1, 2013, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_banco` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Disparadores `banco`
--
DROP TRIGGER IF EXISTS `trg_banco_insert`;
DELIMITER //
CREATE TRIGGER `trg_banco_insert` BEFORE INSERT ON `banco`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.nombre_banco REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_BANCO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_banco_update`;
DELIMITER //
CREATE TRIGGER `trg_banco_update` BEFORE UPDATE ON `banco`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.nombre_banco REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_BANCO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beca_escolar`
--

CREATE TABLE IF NOT EXISTS `beca_escolar` (
  `id_beca` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro_alumno` int(11) NOT NULL,
  `anio_beca` int(11) NOT NULL DEFAULT '0',
  `Monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `comentario` varchar(255) DEFAULT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_beca`),
  KEY `fk_registro_alumno_idx` (`id_registro_alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `beca_escolar`
--

INSERT INTO `beca_escolar` (`id_beca`, `id_registro_alumno`, `anio_beca`, `Monto`, `comentario`, `activo`) VALUES
(1, 1, 2013, 50.00, NULL, '1'),
(2, 2, 2013, 35.00, '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL DEFAULT '0',
  `departamento` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `id_pais`, `departamento`, `activo`) VALUES
(1, 1, 'SAN SALVADOR', 1),
(2, 1, 'SANTA ANA', 1),
(3, 1, 'SAN MIGUEL', 1),
(4, 1, 'LA LIBERTAD', 1),
(5, 1, 'USULUTAN', 1),
(6, 1, 'SONSONATE', 1),
(7, 1, 'LA UNION', 1),
(8, 1, 'LA PAZ', 1),
(9, 1, 'CHALATENANGO', 1),
(10, 1, 'CUSCATLAN', 1),
(11, 1, 'AHUACHAPAN', 1),
(12, 1, 'MORAZAN', 1),
(13, 1, 'SAN VICENTE', 1),
(14, 1, 'CABAÑAS', 1);

--
-- Disparadores `departamento`
--
DROP TRIGGER IF EXISTS `trg_departamento_insert`;
DELIMITER //
CREATE TRIGGER `trg_departamento_insert` BEFORE INSERT ON `departamento`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.departamento REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo DEPARTAMENTO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_departamento_update`;
DELIMITER //
CREATE TRIGGER `trg_departamento_update` BEFORE UPDATE ON `departamento`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.departamento REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo DEPARTAMENTO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donacion`
--

CREATE TABLE IF NOT EXISTS `donacion` (
  `id_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `anio` int(11) NOT NULL DEFAULT '0',
  `id_donante` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `id_promotor` int(11) NOT NULL,
  `id_registro_alumno` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `mes_inicio` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_donacion`),
  KEY `Fkey_donacion_donante` (`id_donante`),
  KEY `Fkey_donacion_tipo_pago` (`id_tipo_pago`),
  KEY `Fkey_donacion_promotor` (`id_promotor`),
  KEY `fk_estado_idx` (`estado`),
  KEY `Fkey_donacion_registro_alumno` (`id_registro_alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `donacion`
--

INSERT INTO `donacion` (`id_donacion`, `anio`, `id_donante`, `id_tipo_pago`, `id_promotor`, `id_registro_alumno`, `Monto`, `mes_inicio`, `fecha_creacion`, `estado`) VALUES
(1, 2013, 6, 1, 1, 1, 30.00, 6, '2013-05-28 00:00:00', 2),
(3, 2013, 8, 1, 1, NULL, 30.00, 6, '2013-05-28 00:00:00', 6),
(5, 2013, 13, 1, 1, NULL, 30.00, 6, '2013-05-29 15:04:17', 5),
(6, 2013, 14, 1, 1, 2, 30.00, 6, '2013-05-31 18:13:53', 2),
(7, 2013, 15, 1, 1, 2, 30.00, 6, '2013-05-31 20:33:26', 2),
(8, 2013, 16, 1, 1, 2, 30.00, 6, '2013-05-31 21:05:37', 2),
(9, 2013, 17, 1, 1, NULL, 30.00, 6, '2013-05-31 21:10:47', 1),
(10, 2013, 18, 1, 1, NULL, 30.00, NULL, '2013-06-02 17:30:39', 1),
(11, 2013, 19, 1, 1, NULL, 30.00, NULL, '2013-06-02 17:33:58', 1),
(12, 2013, 20, 1, 1, NULL, 30.00, NULL, '2013-06-02 17:37:51', 1),
(13, 2013, 21, 1, 1, NULL, 30.00, NULL, '2013-06-02 17:51:50', 1),
(14, 2013, 21, 1, 1, NULL, 30.00, NULL, '2013-06-02 18:46:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donante`
--

CREATE TABLE IF NOT EXISTS `donante` (
  `id_donante` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_donante`),
  KEY `Fkey_donante_estado` (`estado`),
  KEY `Fkey_donante_persona` (`id_persona`),
  KEY `Fkey_donante_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `donante`
--

INSERT INTO `donante` (`id_donante`, `id_usuario`, `id_persona`, `estado`) VALUES
(6, 5, 6, 1),
(8, 7, 7, 1),
(13, NULL, 12, 1),
(14, 6, 16, 1),
(15, 9, 17, 1),
(16, 10, 18, 1),
(17, NULL, 19, 1),
(18, NULL, 19, 1),
(19, NULL, 19, 1),
(20, NULL, 19, 1),
(21, NULL, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_donacion`
--

CREATE TABLE IF NOT EXISTS `estado_donacion` (
  `id_est_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donacion` varchar(60) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_est_donacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `estado_donacion`
--

INSERT INTO `estado_donacion` (`id_est_donacion`, `estado_donacion`, `activo`) VALUES
(1, 'En Proceso', 1),
(2, 'Activa', 1),
(3, 'Vencida', 1),
(4, 'Cancelada', 1),
(5, 'Eliminada', 1),
(6, 'Rechazada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_donante`
--

CREATE TABLE IF NOT EXISTS `estado_donante` (
  `id_est_donante` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donante` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_est_donante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estado_donante`
--

INSERT INTO `estado_donante` (`id_est_donante`, `estado_donante`, `activo`) VALUES
(1, 'Activo', 1),
(2, 'Inactivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `grado`, `activo`) VALUES
(1, 'Parvularia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion_educativa`
--

CREATE TABLE IF NOT EXISTS `institucion_educativa` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(100) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `nombre_director` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `institucion_educativa`
--

INSERT INTO `institucion_educativa` (`id_institucion`, `nombre_institucion`, `direccion`, `telefono`, `nombre_director`) VALUES
(1, 'Colegio Mano Amiga San Antonio', 'La Herradura', '2222-2222', 'Lic. Raul Martinez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `Fkey_municipio_departamento` (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=263 ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `municipio`, `id_departamento`, `activo`) VALUES
(1, 'SAN SALVADOR', 1, 1),
(2, 'CIUDAD DELGADO', 1, 1),
(3, 'MEJICANOS', 1, 1),
(4, 'SOYAPANGO', 1, 1),
(5, 'CUSCATANCINGO', 1, 1),
(6, 'SAN MARCOS', 1, 1),
(7, 'ILOPANGO', 1, 1),
(8, 'NEJAPA', 1, 1),
(9, 'APOPA', 1, 1),
(10, 'SAN MARTIN', 1, 1),
(11, 'PANCHIMALCO', 1, 1),
(12, 'AGUILARES', 1, 1),
(13, 'TONACATEPEQUE', 1, 1),
(14, 'SANTO TOMAS', 1, 1),
(15, 'SANTIAGO TEXACUANGOS', 1, 1),
(16, 'EL PAISNAL', 1, 1),
(17, 'GUAZAPA', 1, 1),
(18, 'AYUTUXTEPEQUE', 1, 1),
(19, 'ROSARIO DE MORA', 1, 1),
(20, 'SANTA ANA', 2, 1),
(21, 'CHALCHUAPA', 2, 1),
(22, 'METAPAN', 2, 1),
(23, 'COATEPEQUE', 2, 1),
(24, 'EL CONGO', 2, 1),
(25, 'TEXISTEPEQUE', 2, 1),
(26, 'CANDELARIA DE LA FRONTERA', 2, 1),
(27, 'SAN SEBASTIAN SALITRILLO', 2, 1),
(28, 'SANTA ROSA GUACHIPILIN', 2, 1),
(29, 'SANTIAGO DE LA FRONTERA', 2, 1),
(30, 'EL PORVENIR', 2, 1),
(31, 'MASAHUAT', 2, 1),
(32, 'SAN ANTONIO PAJONAL', 2, 1),
(33, 'SAN MIGUEL', 3, 1),
(34, 'CHINAMECA', 3, 1),
(35, 'EL TRANSITO', 3, 1),
(36, 'CIUDAD BARRIOS', 3, 1),
(37, 'CHIRILAGUA', 3, 1),
(38, 'SESORI', 3, 1),
(39, 'SAN RAFAEL ORIENTE', 3, 1),
(40, 'MONCAGUA', 3, 1),
(41, 'LOLOTIQUE', 3, 1),
(42, 'SAN JORGE', 3, 1),
(43, 'CHAPELTIQUE', 3, 1),
(44, 'SAN GERARDO', 3, 1),
(45, 'CAROLINA', 3, 1),
(46, 'QUELEPA', 3, 1),
(47, 'SAN LUIS DE LA REINA', 3, 1),
(48, 'NUEVO EDEN DE SAN JUAN', 3, 1),
(49, 'NUEVA GUADALUPE', 3, 1),
(50, 'ULUAZAPA', 3, 1),
(51, 'COMACARAN', 3, 1),
(52, 'SAN ANTONIO DEL MOSCO', 3, 1),
(53, 'QUEZALTEPEQUE', 4, 1),
(54, 'CIUDAD ARCE', 4, 1),
(55, 'SAN JUAN OPICO', 4, 1),
(56, 'COLON', 4, 1),
(57, 'ANTIGUO CUSCATLAN', 4, 1),
(58, 'COMASAGUA', 4, 1),
(59, 'SAN PABLO TACACHICO', 4, 1),
(60, 'JAYAQUE', 4, 1),
(61, 'HUIZUCAR', 4, 1),
(62, 'TEPECOYO', 4, 1),
(63, 'TEOTEPEQUE', 4, 1),
(64, 'CHILTIUPAN', 4, 1),
(65, 'NUEVO CUSCATLAN', 4, 1),
(66, 'TAMANIQUE', 4, 1),
(67, 'SACACOYO', 4, 1),
(68, 'SAN JOSE VILLANUEVA', 4, 1),
(69, 'ZARAGOZA', 4, 1),
(70, 'TALNIQUE', 4, 1),
(71, 'SAN MATIAS', 4, 1),
(72, 'JICALAPA', 4, 1),
(73, 'PUERTO DE LA LIBERTAD', 4, 1),
(74, 'SANTA TECLA', 4, 1),
(75, 'USULUTAN', 5, 1),
(76, 'JIQUILISCO', 5, 1),
(77, 'BERLIN', 5, 1),
(78, 'SANTIAGO DE MARIA', 5, 1),
(79, 'JUCUAPA', 5, 1),
(80, 'SANTA ELENA', 5, 1),
(81, 'JUCUARAN', 5, 1),
(82, 'SAN AGUSTIN', 5, 1),
(83, 'OZATLAN', 5, 1),
(84, 'ESTANZUELAS', 5, 1),
(85, 'ALEGRIA', 5, 1),
(86, 'CONCEPCION BATRES', 5, 1),
(87, 'SAN FRANCISCO JAVIER', 5, 1),
(88, 'PUERTO EL TRIUNFO', 5, 1),
(89, 'TECAPAN', 5, 1),
(90, 'SAN DIONISIO', 5, 1),
(91, 'EREGUAYQUIN', 5, 1),
(92, 'SANTA MARIA', 5, 1),
(93, 'NUEVA GRANADA', 5, 1),
(94, 'EL TRIUNFO', 5, 1),
(95, 'SAN BUENAVENTURA', 5, 1),
(96, 'CALIFORNIA', 5, 1),
(97, 'MERCEDES UMAÑA', 5, 1),
(98, 'SONSONATE', 6, 1),
(99, 'IZALCO', 6, 1),
(100, 'ACAJUTLA', 6, 1),
(101, 'ARMENIA', 6, 1),
(102, 'NAHUIZALCO', 6, 1),
(103, 'JUAYUA', 6, 1),
(104, 'SAN JULIAN', 6, 1),
(105, 'SONZACATE', 6, 1),
(106, 'SAN ANTONIO DEL MONTE', 6, 1),
(107, 'NAHULINGO', 6, 1),
(108, 'CUISNAHUAT', 6, 1),
(109, 'SANTA CATARINA MASAHUAT', 6, 1),
(110, 'CALUCO', 6, 1),
(111, 'SANTA ISABEL ISHUATAN', 6, 1),
(112, 'SALCOATITAN', 6, 1),
(113, 'SANTO DOMINGO DE GUZMAN', 6, 1),
(114, 'LA UNION', 7, 1),
(115, 'SANTA ROSA DE LIMA', 7, 1),
(116, 'PASAQUINA', 7, 1),
(117, 'SAN ALEJO', 7, 1),
(118, 'ANAMOROS', 7, 1),
(119, 'EL CARMEN', 7, 1),
(120, 'CONCHAGUA', 7, 1),
(121, 'EL SAUCE', 7, 1),
(122, 'LISLIQUE', 7, 1),
(123, 'YUCUAIQUIN', 7, 1),
(124, 'NUEVA ESPARTA', 7, 1),
(125, 'POLOROS', 7, 1),
(126, 'BOLIVAR', 7, 1),
(127, 'CONCEPCION DE ORIENTE', 7, 1),
(128, 'INTIPUCA', 7, 1),
(129, 'SAN JOSE', 7, 1),
(130, 'YAYANTIQUE', 7, 1),
(131, 'MEANGUERA DEL GOLFO', 7, 1),
(132, 'ZACATECOLUCA', 8, 1),
(133, 'SANTIAGO NONUALCO', 8, 1),
(134, 'SAN JUAN NONUALCO', 8, 1),
(135, 'SAN PEDRO MASAHUAT', 8, 1),
(136, 'OLOCUILTA', 8, 1),
(137, 'SAN PEDRO NONUALCO', 8, 1),
(138, 'SAN FRANCISCO CHINAMECA', 8, 1),
(139, 'SAN JUAN TALPA', 8, 1),
(140, 'EL ROSARIO', 8, 1),
(141, 'SAN RAFAEL OBRAJUELO', 8, 1),
(142, 'SANTA MARIA OSTUMA', 8, 1),
(143, 'SAN LUIS TALPA', 8, 1),
(144, 'SAN ANTONIO MASAHUAT', 8, 1),
(145, 'SAN MIGUEL TEPEZONTES', 8, 1),
(146, 'SAN JUAN TEPEZONTES', 8, 1),
(147, 'TAPALHUACA', 8, 1),
(148, 'CUYULTITAN', 8, 1),
(149, 'PARAISO DE OSORIO', 8, 1),
(150, 'SAN EMIGDIO', 8, 1),
(151, 'JERUSALEN', 8, 1),
(152, 'MERCEDES LA CEIBA', 8, 1),
(153, 'SAN LUIS LA HERRADURA', 8, 1),
(154, 'CHALATENANGO', 9, 1),
(155, 'NUEVA CONCEPCION', 9, 1),
(156, 'LA PALMA', 9, 1),
(157, 'TEJUTLA', 9, 1),
(158, 'LA REINA', 9, 1),
(159, 'ARCATAO', 9, 1),
(160, 'SAN IGNACIO', 9, 1),
(161, 'DULCE NOMBRE DE MARIA', 9, 1),
(162, 'CITALA', 9, 1),
(163, 'AGUA CALIENTE', 9, 1),
(164, 'CONCEPCION QUEZALTEPEQUE', 9, 1),
(165, 'NUEVA TRINIDAD', 9, 1),
(166, 'LAS VUELTAS', 9, 1),
(167, 'COMALAPA', 9, 1),
(168, 'SAN RAFAEL', 9, 1),
(169, 'LAS FLORES', 9, 1),
(170, 'OJO DE AGUA', 9, 1),
(171, 'NOMBRE DE JESUS', 9, 1),
(172, 'POTONICO', 9, 1),
(173, 'SAN FRANCISCO MORAZAN', 9, 1),
(174, 'SANTA RITA', 9, 1),
(175, 'LA LAGUNA', 9, 1),
(176, 'SAN ISIDRO LABRADOR', 9, 1),
(177, 'SAN ANTONIO DE LA CRUZ', 9, 1),
(178, 'EL PARAISO', 9, 1),
(179, 'SAN MIGUEL DE MERCEDES', 9, 1),
(180, 'SAN LUIS DEL CARMEN', 9, 1),
(181, 'CANCASQUE', 9, 1),
(182, 'SAN ANTONIO LOS RANCHOS', 9, 1),
(183, 'EL CARRIZAL', 9, 1),
(184, 'SAN FERNANDO', 9, 1),
(185, 'AZACUALPA', 9, 1),
(186, 'SAN FRANCISCO LEMPA', 9, 1),
(187, 'COJUTEPEQUE', 10, 1),
(188, 'SUCHITOTO', 10, 1),
(189, 'SAN PEDRO PERULAPAN', 10, 1),
(190, 'SAN JOSE GUAYABAL', 10, 1),
(191, 'TENANCINGO', 10, 1),
(192, 'SAN RAFAEL CEDROS', 10, 1),
(193, 'CANDELARIA', 10, 1),
(194, 'EL CARMEN', 10, 1),
(195, 'MONTE SAN JUAN', 10, 1),
(196, 'SAN CRISTOBAL', 10, 1),
(197, 'SANTA CRUZ MICHAPA', 10, 1),
(198, 'SAN BARTOLOME PERULAPIA', 10, 1),
(199, 'SAN RAMON', 10, 1),
(200, 'EL ROSARIO', 10, 1),
(201, 'ORATORIO DE CONCEPCION', 10, 1),
(202, 'SANTA CRUZ ANALQUITO', 10, 1),
(203, 'AHUACHAPAN', 11, 1),
(204, 'ATIQUIZAYA', 11, 1),
(205, 'SAN FRANCISCO MENENDEZ', 11, 1),
(206, 'TACUBA', 11, 1),
(207, 'CONCEPCION DE ATACO', 11, 1),
(208, 'JUJUTLA', 11, 1),
(209, 'GUAYMANGO', 11, 1),
(210, 'APANECA', 11, 1),
(211, 'SAN PEDRO PUXTLA', 11, 1),
(212, 'SAN LORENZO', 11, 1),
(213, 'TURIN', 11, 1),
(214, 'EL REFUGIO', 11, 1),
(215, 'JOATECA', 12, 1),
(216, 'ARAMBALA', 12, 1),
(217, 'SAN FRANCISCO GOTERA', 12, 1),
(218, 'JOCORO', 12, 1),
(219, 'CORINTO', 12, 1),
(220, 'SOCIEDAD', 12, 1),
(221, 'GUATAJIAGUA', 12, 1),
(222, 'CACAOPERA', 12, 1),
(223, 'EL DIVISADERO', 12, 1),
(224, 'JOCOAITIQUE', 12, 1),
(225, 'OSICALA', 12, 1),
(226, 'CHILANGA', 12, 1),
(227, 'MEANGUERA', 12, 1),
(228, 'TOROLA', 12, 1),
(229, 'SAN SIMON', 12, 1),
(230, 'DELICIAS DE CONCEPCION', 12, 1),
(231, 'LOLOTIQUILLO', 12, 1),
(232, 'YAMABAL', 12, 1),
(233, 'YOLOAIQUIN', 12, 1),
(234, 'SAN CARLOS', 12, 1),
(235, 'EL ROSARIO', 12, 1),
(236, 'PERQUIN', 12, 1),
(237, 'SENSEMBRA', 12, 1),
(238, 'GUALOCOCTI', 12, 1),
(239, 'SAN FERNANDO', 12, 1),
(240, 'SAN ISIDRO', 12, 1),
(241, 'SAN VICENTE', 13, 1),
(242, 'TECOLUCA', 13, 1),
(243, 'SAN SEBASTIAN', 13, 1),
(244, 'APASTEPEQUE', 13, 1),
(245, 'SAN ESTEBAN CATARINA', 13, 1),
(246, 'SAN ILDEFONSO', 13, 1),
(247, 'SANTA CLARA', 13, 1),
(248, 'SAN LORENZO', 13, 1),
(249, 'VERAPAZ', 13, 1),
(250, 'GUADALUPE', 13, 1),
(251, 'SANTO DOMINGO', 13, 1),
(252, 'SAN CAYETANO ISTEPEQUE', 13, 1),
(253, 'TEPETITAN', 13, 1),
(254, 'SENSUNTEPEQUE', 14, 1),
(255, 'ILOBASCO', 14, 1),
(256, 'VICTORIA', 14, 1),
(257, 'SAN ISIDRO', 14, 1),
(258, 'JUTIAPA', 14, 1),
(259, 'TEJUTEPEQUE', 14, 1),
(260, 'DOLORES', 14, 1),
(261, 'CINQUERA', 14, 1),
(262, 'GUACOTECTI', 14, 1);

--
-- Disparadores `municipio`
--
DROP TRIGGER IF EXISTS `trg_municipio_insert`;
DELIMITER //
CREATE TRIGGER `trg_municipio_insert` BEFORE INSERT ON `municipio`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.municipio REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo MUNICIPIO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_municipio_update`;
DELIMITER //
CREATE TRIGGER `trg_municipio_update` BEFORE UPDATE ON `municipio`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.municipio REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo MUNICIPIO solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_donacion` int(11) NOT NULL,
  `mes_pago` int(11) NOT NULL DEFAULT '0',
  `monto` decimal(10,2) NOT NULL,
  `valor_cuota` decimal(10,2) DEFAULT NULL,
  `numero_recibo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `usuario_mod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_id_donacion_idx` (`id_donacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `fecha`, `id_donacion`, `mes_pago`, `monto`, `valor_cuota`, `numero_recibo`, `fecha_creacion`, `usuario_creacion`, `fecha_mod`, `usuario_mod`) VALUES
(3, '2013-05-30', 6, 6, 30.00, 30.00, 20, '2013-05-31 00:00:00', 1, NULL, NULL),
(4, '2013-05-30', 6, 7, 20.00, 30.00, 21, '2013-05-31 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre_pais`, `activo`) VALUES
(1, 'El Salvador', 1),
(2, 'Estados Unidos', 1),
(3, 'Canada', 1);

--
-- Disparadores `pais`
--
DROP TRIGGER IF EXISTS `trg_pais_insert`;
DELIMITER //
CREATE TRIGGER `trg_pais_insert` BEFORE INSERT ON `pais`
 FOR EACH ROW BEGIN  
		
		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.nombre_pais REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_PAIS solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_pais_update`;
DELIMITER //
CREATE TRIGGER `trg_pais_update` BEFORE UPDATE ON `pais`
 FOR EACH ROW BEGIN  
		
		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		/*VALIDACION DEL CAMPO DEPARTAMENTO*/
		SET validar=(SELECT NEW.nombre_pais REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_PAIS solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(255) NOT NULL,
  `menu` varchar(8000) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `perfil`, `menu`, `comentario`, `activo`) VALUES
(1, 'Administrador', '<?xml version="1.0" encoding="iso-8859-1" ?>\r\n<menu>\r\n	<item id="Admin" text="Administracion" img="application.png" >\r\n		<item id="Ad_Usuarios" text="Usuarios" img="group.png"/>\r\n		<item id="Ad_Cambiar" text="Cambiar Contraseña" img="arrow_ew.png"/>\r\n		<item id="Ad_sep1" type="separator"/>\r\n		<item id="Ad_Salir" text="Salir" img="door_in.png"/>\r\n	</item>\r\n	<item id="Sep1" type="separator"/>\r\n	<item id="Control" text="Control" img="shape_move_forwards.png">\r\n		<item id="Ctr_Solicitud" text="Solicitud Donante(Promotor)" img="shape_move_back.png"/>\r\n		<item id="Ctr_Donaciones" text="Donaciones" img="creditcards.png"/>\r\n		<item id="Ctr_Becas" text="Becas" img="vcard.png"/>\r\n		<item id="Ctr_sep1" type="separator"/>\r\n		<item id="Ctr_Pagos" text="Realizar Pago Donacion" img="money.png"/>\r\n		<item id="Ctr_Notas" text="Nota Promedio Alumno" img="page_white_database_yellow.png"/>\r\n	</item>\r\n	<item id="Sep2" type="separator"/>\r\n	<item id="Consultas" text="Consultas" img="table.png">\r\n		<item id="Con_Donaciones" text="Donaciones" img="table_multiple.png"/>\r\n		<item id="Con_Becas" text="Becas" img="table_multiple.png"/>\r\n		<item id="Con_Notas" text="Notas" img="table_multiple.png"/>\r\n	</item>\r\n	<item id="Sep3" type="separator" />\r\n	<item id="Mantenimientos" text="Mantenimientos" img="database.png" >\r\n		<item id="Man_Tipo_Beca" text="Tipos de Beca" img="database_wrench.png"/>\r\n		<item id="Man_Tipo_Donacion" text="Tipos de Donacion" img="database_wrench.png"/>\r\n		<item id="Man_Tipo_Pago" text="Tipo de Pagos" img="database_wrench.png"/>\r\n		<item id="Man_sep_1" type="separator"/>\r\n		<item id="Man_Institucion" text="Institucion Educativas" img="database_wrench.png"/>\r\n		<item id="Man_Bancos" text="Bancos" img="database_wrench.png"/>\r\n		<item id="Man_Pais" text="Paises" img="database_wrench.png"/>\r\n	</item>\r\n</menu>', '', '1'),
(2, 'Promotor', '<?xml version="1.0" encoding="iso-8859-1" ?>\r\n<menu>\r\n	<item id="Admin" text="Administracion" img="application.png" >\r\n		<item id="Ad_Cambiar" text="Cambiar Contraseña" img="arrow_ew.png"/>\r\n		<item id="Ad_sep1" type="separator"/>\r\n		<item id="Ad_Salir" text="Salir" img="door_in.png"/>\r\n	</item>\r\n	<item id="Sep1" type="separator"/>\r\n	<item id="Control" text="Control" img="shape_move_forwards.png">\r\n		<item id="Ctr_Solicitud" text="Solicitud Donante(Promotor)" img="shape_move_back.png"/>\r\n	</item>\r\n</menu>', '', '1'),
(3, 'Donante', '<?xml version="1.0" encoding="iso-8859-1" ?>\r\n<menu>\r\n	<item id="Admin" text="Administracion" img="application.png" >\r\n		<item id="Ad_Cambiar" text="Cambiar Contraseña" img="arrow_ew.png"/>\r\n		<item id="Ad_sep1" type="separator"/>\r\n		<item id="Ad_Salir" text="Salir" img="door_in.png"/>\r\n	</item>\r\n	<item id="Consultas" text="Consultas" img="table.png">\r\n		<item id="Con_Notas" text="Notas" img="table_multiple.png"/>\r\n	</item>\r\n\r\n</menu>', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(80) NOT NULL,
  `apellido_pri` varchar(60) NOT NULL,
  `apellido_seg` varchar(60) DEFAULT NULL,
  `Direccion` varchar(250) NOT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `telefono_casa` varchar(15) DEFAULT NULL,
  `telefono_movil` varchar(15) DEFAULT NULL,
  `telefono_trabajo` varchar(15) DEFAULT NULL,
  `nit` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `Genero` char(1) NOT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `Fkey_persona_pais` (`id_pais`),
  KEY `Fkey_persona_municipio_idx` (`id_municipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombres`, `apellido_pri`, `apellido_seg`, `Direccion`, `id_municipio`, `id_pais`, `telefono_casa`, `telefono_movil`, `telefono_trabajo`, `nit`, `fecha_nacimiento`, `Genero`, `correo_electronico`) VALUES
(1, 'Pedro', 'Molina', NULL, 'Soyapango', 1, 1, NULL, NULL, NULL, '0614-010170-112-1', '1970-01-01', 'M', NULL),
(6, 'Jose', 'Perez', '', 'San Salvador', 1, 1, '', '', '', '0614-010180-112-1', '1980-01-01', 'M', 'jose.perez@hotmail.com'),
(7, 'Juan', 'Rivera', '', 'San Salvador', 1, 1, '', '', '', '0614-010180-112-1', '1980-01-01', 'M', ''),
(12, 'Luis', 'Gonzales', '', 'Soyapango', 4, 1, '', '', '', '0614-010180-112-3', '2013-05-29', 'M', ''),
(13, 'David', 'Martines', 'Romero', 'San Salvador', 1, 1, NULL, NULL, NULL, '0000-000000-000-0', '2005-01-01', 'M', NULL),
(14, 'Marvin', 'Venegas', '', 'Soyapango', 4, NULL, '', '', NULL, '0000-000000-000-0', '2005-04-01', 'M', NULL),
(15, 'Daniel', 'Navas', '', 'San Salvador', 1, NULL, '', '', NULL, '0000-000000-000-0', '2005-04-26', 'M', NULL),
(16, 'Sofia', 'Perez', 'Martines', 'San salvador', 1, 1, '', '', '', '0614-010580-112-5', '1980-05-01', 'F', 'sofia@hotmail.com'),
(17, 'Luis', 'Mejia', '', 'los angeles', 82, 2, '', '', '', '0614-010980-122-1', '2013-06-01', 'M', ''),
(18, 'Luis', 'Mejia', '', 'San salvador', 1, 2, '', '', '', '0614-010980-112-1', '2013-06-01', 'M', ''),
(19, 'Luis', 'mejia', '', 'los angeles', 100, 1, '909-2221-3435', '', '', '0614-010980-112-1', '2013-06-01', 'M', 'Luis@hotmail.com'),
(20, 'Christian', 'Cordova', 'Mendez', 'Long beach', NULL, 2, '901-223-2345', '901-723-2345', '901-723-6239', '0614-010983-112-1', '1983-09-01', 'M', 'cordova10@hotmail.com');

--
-- Disparadores `persona`
--
DROP TRIGGER IF EXISTS `trg_persona_insert`;
DELIMITER //
CREATE TRIGGER `trg_persona_insert` BEFORE INSERT ON `persona`
 FOR EACH ROW BEGIN  
		

		DECLARE validar_nombres varchar(100);
		DECLARE validar_telefono varchar(15);
		DECLARE validar_nit varchar(20);
		DECLARE validar_email varchar(100);
		DECLARE msg varchar(255);

		/*VALIDACION DEL CAMPO NOMBRES*/
		IF NEW.nombres <> null OR NEW.nombres<>"" THEN
		SET validar_nombres=(SELECT NEW.nombres REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo NOMBRES solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO APELLIDO_PRI*/
		IF NEW.apellido_pri <> null OR NEW.apellido_pri<>"" THEN
		SET validar_nombres=(SELECT NEW.apellido_pri REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo APELLIDO_PRI solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO APELLIDO_SEG*/
		IF NEW.apellido_seg <> null OR NEW.apellido_seg<>"" THEN
		SET validar_nombres=(SELECT NEW.apellido_seg REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo APELLIDO_SEG solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;


		/*VALIDACION DEL CAMPO TELEFONO_CASA
		IF NEW.telefono_casa <> null OR NEW.telefono_casa<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_casa REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE CASA no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
        */

		/*VALIDACION DEL CAMPO TELEFONO_MOVIL
		IF NEW.telefono_movil <> null OR NEW.telefono_movil<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_movil REGEXP '[78][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO MOVIL no coicide. Ejemplo: 7894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

        */
		/*VALIDACION DEL CAMPO TELEFONO_TRABAJO
		IF NEW.telefono_trabajo <> null OR NEW.telefono_trabajo<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_trabajo REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE TRABAJO no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
    
        */

		/*VALIDACION DEL CAMPO NIT
		IF NEW.nit<>null OR NEW.nit<>"" THEN			
			SET validar_nit=(SELECT NEW.nit REGEXP '[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9]');
			IF validar_nit<>1 THEN
				SET msg = concat('El formato del NIT no coicide. Ejemplo: 0614-100389-134-7');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;        			
		END IF;
        */

		/*VALIDACION DEL CAMPO GENERO*/
		IF NEW.genero <> null OR NEW.genero <>"" THEN
			IF NEW.genero<>'M' AND NEW.genero<>'F' THEN               
				SET msg = concat('No se permiten otras letras en el campo GENERO. Ejemplo: F=Femenino y M=Masculino');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
		
		/*VALIDACION DEL CAMPO CORREO_ELECTRONICO*/
		IF NEW.correo_electronico <> null OR NEW.correo_electronico<>"" THEN
			SET validar_email=(SELECT NEW.correo_electronico REGEXP '^[0-9a-z_.]{1,}[@][a-z]{1,}[.]{1}[a-z]{1,}$');
			IF validar_email<>1 THEN
				SET msg = concat('El CORREO ELECTRONICO no es invalido');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_persona_update`;
DELIMITER //
CREATE TRIGGER `trg_persona_update` BEFORE UPDATE ON `persona`
 FOR EACH ROW BEGIN  
		

		DECLARE validar_nombres varchar(100);
		DECLARE validar_telefono varchar(15);
		DECLARE validar_nit varchar(20);
		DECLARE validar_email varchar(100);
		DECLARE msg varchar(255);

		/*VALIDACION DEL CAMPO NOMBRES*/
		IF NEW.nombres <> null OR NEW.nombres<>"" THEN
		SET validar_nombres=(SELECT NEW.nombres REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo NOMBRES solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO APELLIDO_PRI*/
		IF NEW.apellido_pri <> null OR NEW.apellido_pri<>"" THEN
		SET validar_nombres=(SELECT NEW.apellido_pri REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo APELLIDO_PRI solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO APELLIDO_SEG*/
		IF NEW.apellido_seg <> null OR NEW.apellido_seg<>"" THEN
		SET validar_nombres=(SELECT NEW.apellido_seg REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar_nombres<>1 THEN
				SET msg = concat('En el campo APELLIDO_SEG solamente se aceptan letras');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;


		/*VALIDACION DEL CAMPO TELEFONO_CASA
		IF NEW.telefono_casa <> null OR NEW.telefono_casa<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_casa REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE CASA no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

       */

		/*VALIDACION DEL CAMPO TELEFONO_MOVIL
		IF NEW.telefono_movil <> null OR NEW.telefono_movil<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_movil REGEXP '[78][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO MOVIL no coicide. Ejemplo: 7894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
    
    */

		/*VALIDACION DEL CAMPO TELEFONO_TRABAJO
		IF NEW.telefono_trabajo <> null OR NEW.telefono_trabajo<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_trabajo REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE TRABAJO no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
    
    */

		/*VALIDACION DEL CAMPO NIT
		IF NEW.nit<>null OR NEW.nit<>"" THEN			
			SET validar_nit=(SELECT NEW.nit REGEXP '[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9]');
			IF validar_nit<>1 THEN
				SET msg = concat('El formato del NIT no coicide. Ejemplo: 0614-100389-134-7');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;        			
		END IF;
        */

		/*VALIDACION DEL CAMPO GENERO*/
		IF NEW.genero <> null OR NEW.genero <>"" THEN
			IF NEW.genero<>'M' AND NEW.genero<>'F' THEN               
				SET msg = concat('No se permiten otras letras en el campo GENERO. Ejemplo: F=Femenino y M=Masculino');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
		
		/*VALIDACION DEL CAMPO CORREO_ELECTRONICO*/
		IF NEW.correo_electronico <> null OR NEW.correo_electronico<>"" THEN
			SET validar_email=(SELECT NEW.correo_electronico REGEXP '^[0-9a-z_.]{1,}[@][a-z]{1,}[.]{1}[a-z]{1,}$');
			IF validar_email<>1 THEN
				SET msg = concat('El CORREO ELECTRONICO no es invalido');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promotor`
--

CREATE TABLE IF NOT EXISTS `promotor` (
  `id_promotor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_promotor`),
  KEY `fk_promotor_persona_idx` (`id_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `promotor`
--

INSERT INTO `promotor` (`id_promotor`, `id_usuario`, `id_persona`, `fecha_inicio`, `fecha_fin`, `activo`) VALUES
(1, 4, 1, '2013-01-01', '2014-01-01', 1);

--
-- Disparadores `promotor`
--
DROP TRIGGER IF EXISTS `trg_promotor_insert`;
DELIMITER //
CREATE TRIGGER `trg_promotor_insert` BEFORE INSERT ON `promotor`
 FOR EACH ROW BEGIN  
				
		DECLARE msg varchar(255);
		DECLARE diferencia DECIMAL;
		/*VALIDACION DEL CAMPO FECHAS*/
		IF (NEW.fecha_inicio<>null OR NEW.fecha_inicio<>"") AND (NEW.fecha_fin<>null OR NEW.fecha_fin<>"") THEN 
			SET diferencia=(select CONVERT(DATEDIFF(NEW.fecha_fin,NEW.fecha_inicio),DECIMAL));
			IF diferencia<0 THEN 
				SET msg = concat('La fecha_inicio no puede ser mayor a la fecha_fin');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;	
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_promotor_update`;
DELIMITER //
CREATE TRIGGER `trg_promotor_update` BEFORE UPDATE ON `promotor`
 FOR EACH ROW BEGIN  
				
		DECLARE msg varchar(255);
		DECLARE diferencia DECIMAL;
		/*VALIDACION DEL CAMPO FECHAS*/
		IF (NEW.fecha_inicio<>null OR NEW.fecha_inicio<>"") AND (NEW.fecha_fin<>null OR NEW.fecha_fin<>"") THEN 
			SET diferencia=(select CONVERT(DATEDIFF(NEW.fecha_fin,NEW.fecha_inicio),DECIMAL));
		ELSEIF (NEW.fecha_inicio<>null OR NEW.fecha_inicio<>"") AND (NEW.fecha_fin="") THEN	
			SET diferencia=(select CONVERT(DATEDIFF(OLD.fecha_fin,NEW.fecha_inicio),DECIMAL));
		ELSEIF (NEW.fecha_inicio="") AND (NEW.fecha_fin<>null OR NEW.fecha_fin<>"") THEN 
			SET diferencia=(select CONVERT(DATEDIFF(NEW.fecha_fin,OLD.fecha_inicio),DECIMAL));
		ELSE
			SET diferencia=0;
		END IF;	

		IF diferencia<0 THEN 
			SET msg = concat('La fecha_inicio no puede ser mayor a la fecha_fin');
			SIGNAL sqlstate '45000' SET message_text = msg;     
		END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_alumno`
--

CREATE TABLE IF NOT EXISTS `registro_alumno` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `anio` int(11) NOT NULL DEFAULT '0',
  `id_alumno` int(11) NOT NULL,
  `id_institucion_edu` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `seccion` char(1) NOT NULL,
  `nota_promedio` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `activa` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_registro`),
  KEY `Fkey_registro_alumno` (`id_alumno`),
  KEY `Fkey_registro_institucion` (`id_institucion_edu`),
  KEY `Fkey_registro_grado` (`id_grado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `registro_alumno`
--

INSERT INTO `registro_alumno` (`id_registro`, `anio`, `id_alumno`, `id_institucion_edu`, `id_grado`, `seccion`, `nota_promedio`, `fecha_creacion`, `activa`) VALUES
(1, 2013, 1, 1, 1, 'A', 9.00, '2013-06-01 00:00:00', '1'),
(2, 2013, 2, 1, 1, 'A', 10.00, '2013-05-31 09:14:55', '1');

--
-- Disparadores `registro_alumno`
--
DROP TRIGGER IF EXISTS `trg_registro_alumno_insert`;
DELIMITER //
CREATE TRIGGER `trg_registro_alumno_insert` BEFORE INSERT ON `registro_alumno`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		DECLARE sec char(1);

		/*VALIDACION DEL CAMPO*/
		IF new.seccion <> null OR new.seccion<>"" THEN
			SET sec=(select UPPER(new.seccion));

			IF sec<>'A' AND sec<>'B' AND sec<>'C' AND sec<>'D' THEN 
				SET msg = concat('En el campo SECCION solamente pueden existir las siguientes: A, B, C y D');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NOTA_PROMEDIO*/
		IF new.nota_promedio <> null OR new.nota_promedio <> "" THEN
			IF new.nota_promedio > 10 THEN 
				SET msg = concat('En el campo NOTA_PROMEDIO no se aceptan numeros mayores a 10');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;		
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_registro_alumno_update`;
DELIMITER //
CREATE TRIGGER `trg_registro_alumno_update` BEFORE UPDATE ON `registro_alumno`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		DECLARE sec char(1);

		/*VALIDACION DEL CAMPO*/
		IF new.seccion <> null OR new.seccion<>"" THEN
			SET sec=(select UPPER(new.seccion));

			IF sec<>'A' AND sec<>'B' AND sec<>'C' AND sec<>'D' THEN 
				SET msg = concat('En el campo SECCION solamente pueden existir las siguientes: A, B, C y D');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NOTA_PROMEDIO*/
		IF new.nota_promedio <> null OR new.nota_promedio <> "" THEN
			IF new.nota_promedio > 10 THEN 
				SET msg = concat('En el campo NOTA_PROMEDIO no se aceptan numeros mayores a 10');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;		
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renovacion`
--

CREATE TABLE IF NOT EXISTS `renovacion` (
  `id_renovacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_donacion` int(11) NOT NULL,
  `fecha_renovacion` date NOT NULL,
  `documento_renovacion_img` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_renovacion`),
  KEY `fk_donacion_idx` (`id_donacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas_cobro`
--

CREATE TABLE IF NOT EXISTS `tarjetas_cobro` (
  `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT,
  `id_donante` int(11) NOT NULL,
  `numero_tarjeta` varchar(15) NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `nombre_titular` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tarjeta`),
  KEY `Fkey_tarjeta_donante` (`id_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Disparadores `tarjetas_cobro`
--
DROP TRIGGER IF EXISTS `trg_tarjetas_cobro_insert`;
DELIMITER //
CREATE TRIGGER `trg_tarjetas_cobro_insert` BEFORE INSERT ON `tarjetas_cobro`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		
		/*VALIDACION DEL CAMPO NUMERO_TARJETA*/
		IF new.numero_tarjeta<>null OR new.numero_tarjeta<>"" THEN
			SET validar=(SELECT NEW.numero_tarjeta REGEXP '^[0-9]{4}[-]{1}[0-9]{4}[-]{1}[0-9]{4}$');
			IF validar<>1 THEN
				SET msg = concat('No coicide el formato en el campo NUMERO_TARJETA. Ejemplo: 0124-1457-9897');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NOMBRE_TITULAR*/
		IF new.nombre_titular<>null OR new.nombre_titular<>"" THEN
			SET validar=(SELECT NEW.nombre_titular REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_TITULAR solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_tarjetas_cobro_update`;
DELIMITER //
CREATE TRIGGER `trg_tarjetas_cobro_update` BEFORE UPDATE ON `tarjetas_cobro`
 FOR EACH ROW BEGIN  
		

		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
		
		/*VALIDACION DEL CAMPO NUMERO_TARJETA*/
		IF new.numero_tarjeta<>null OR new.numero_tarjeta<>"" THEN
			SET validar=(SELECT NEW.numero_tarjeta REGEXP '^[0-9]{4}[-]{1}[0-9]{4}[-]{1}[0-9]{4}$');
			IF validar<>1 THEN
				SET msg = concat('No coicide el formato en el campo NUMERO_TARJETA. Ejemplo: 0124-1457-9897');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NOMBRE_TITULAR*/
		IF new.nombre_titular<>null OR new.nombre_titular<>"" THEN
			SET validar=(SELECT NEW.nombre_titular REGEXP '^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$');
			IF validar<>1 THEN
				SET msg = concat('En el campo NOMBRE_TITULAR solamente se aceptan letras ');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  `meses` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tipo_pago`, `descripcion`, `meses`, `activo`) VALUES
(1, 'Mensual', 1, 1),
(2, 'Bimestre', 3, 1),
(3, 'Trimestre', 4, 1),
(4, 'Cuatrimestre', 6, 1),
(5, 'Semestre', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave_acceso` varchar(50) NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `pregunta_secreta` varchar(200) DEFAULT NULL,
  `respuesta_secreta` varchar(50) DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `estado_usuario` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_usuario`),
  KEY `Fkey_usuarios_perfil` (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `clave_acceso`, `fecha_caducidad`, `pregunta_secreta`, `respuesta_secreta`, `id_perfil`, `estado_usuario`) VALUES
(1, 'Administrador', 'lAzQ2he4onIP/0Zo9dMZGruvwtoImgqtQirxCWgk+oA=', '2014-01-01', 'Pelicula Favorita', 'Batman', 1, 'A'),
(2, 'Promotor', 'lAzQ2he4onIP/0Zo9dMZGruvwtoImgqtQirxCWgk+oA=', '2014-03-20', '', '', 2, 'A'),
(4, 'pedro.molina', 'lAzQ2he4onIP/0Zo9dMZGruvwtoImgqtQirxCWgk+oA=', '2015-01-01', NULL, NULL, 2, 'A'),
(5, 'jose.perez', 'mwpYCZtYBOWjZ5N7jr8VQSukOwtBGOaNBL83CkIG/3g=', '2014-05-30', '', '', 3, 'A'),
(6, 'sofia.perez', 'mwpYCZtYBOWjZ5N7jr8VQSukOwtBGOaNBL83CkIG/3g=', '2013-06-01', '', '', 3, 'A'),
(7, '5', '25u1QytEq31DZpbHFLo6TBwa3bKMxDIh0CSXemPXP2o=', '2013-06-01', '', '', 3, 'A'),
(8, '5', '25u1QytEq31DZpbHFLo6TBwa3bKMxDIh0CSXemPXP2o=', '2013-06-01', '', '', 3, 'A'),
(9, 'luis.mejia', '5LejbVIW/55nzMjFQFWQQ1C1FNHK2yh9NHXXw881FmM=', '2013-06-01', '', '', 3, 'A'),
(10, 'luis.mejia', '5LejbVIW/55nzMjFQFWQQ1C1FNHK2yh9NHXXw881FmM=', '2013-06-01', '', '', 3, 'A');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `Fkey_alumno_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `beca_escolar`
--
ALTER TABLE `beca_escolar`
  ADD CONSTRAINT `fk_registro_alumno` FOREIGN KEY (`id_registro_alumno`) REFERENCES `registro_alumno` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `Fkey_donacion_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_promotor` FOREIGN KEY (`id_promotor`) REFERENCES `promotor` (`id_promotor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_registro_alumno` FOREIGN KEY (`id_registro_alumno`) REFERENCES `registro_alumno` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fkey_donacion_tipo_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donacion` (`id_est_donacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `donante`
--
ALTER TABLE `donante`
  ADD CONSTRAINT `Fkey_donante_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donante` (`id_est_donante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `Fkey_municipio_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_id_donacion` FOREIGN KEY (`id_donacion`) REFERENCES `donacion` (`id_donacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `Fkey_persona_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_persona_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `promotor`
--
ALTER TABLE `promotor`
  ADD CONSTRAINT `fk_promotor_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_alumno`
--
ALTER TABLE `registro_alumno`
  ADD CONSTRAINT `Fkey_registro_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_grado` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_institucion` FOREIGN KEY (`id_institucion_edu`) REFERENCES `institucion_educativa` (`id_institucion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `renovacion`
--
ALTER TABLE `renovacion`
  ADD CONSTRAINT `fk_donacion` FOREIGN KEY (`id_donacion`) REFERENCES `donacion` (`id_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarjetas_cobro`
--
ALTER TABLE `tarjetas_cobro`
  ADD CONSTRAINT `Fkey_tarjeta_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Fkey_usuarios_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
