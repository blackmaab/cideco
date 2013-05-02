-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2013 a las 07:32:20
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
  `nie` varchar(20) DEFAULT NULL,
  `destacado_en` varchar(100) DEFAULT NULL,
  `necesidades_medicas` varchar(100) DEFAULT NULL,
  `numero_hermanos` int(11) DEFAULT NULL,
  `vive_con` varchar(255) DEFAULT NULL,
  `grande_quiere_ser` varchar(100) DEFAULT NULL,
  `juego_favorito` varchar(100) DEFAULT NULL,
  `materia_favorita` varchar(100) DEFAULT NULL,
  `ayuda_en_casa` varchar(100) DEFAULT NULL,
  `fecha_creacion` varchar(255) DEFAULT NULL,
  `fotografia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `Fkey_alumno_persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_banco` varchar(100) DEFAULT NULL,
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
  `id_tipo_beca` int(11) NOT NULL,
  `id_frecuencia_beca` int(11) NOT NULL,
  `id_registro_alumno` int(11) NOT NULL,
  `porcentaje_beca` decimal(10,2) DEFAULT NULL,
  `fecha_inicio_beca` date DEFAULT NULL,
  `fecha_fin_beca` date DEFAULT NULL,
  `activo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_beca`),
  KEY `fk_tipo_beca_idx` (`id_tipo_beca`),
  KEY `fk_frecuencia_beca_idx` (`id_frecuencia_beca`),
  KEY `fk_registro_alumno_idx` (`id_registro_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(50) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `id_donante` int(11) DEFAULT NULL,
  `id_tipo_pago` int(11) DEFAULT NULL,
  `id_tipo_donacion` int(11) DEFAULT NULL,
  `id_promotor` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_donacion`),
  KEY `Fkey_donacion_donante` (`id_donante`),
  KEY `Fkey_donacion_tipo_donacion` (`id_tipo_donacion`),
  KEY `Fkey_donacion_tipo_pago` (`id_tipo_pago`),
  KEY `Fkey_donacion_promotor` (`id_promotor`),
  KEY `fk_estado_idx` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donante`
--

CREATE TABLE IF NOT EXISTS `donante` (
  `id_donante` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_donante`),
  KEY `Fkey_donante_estado` (`estado`),
  KEY `Fkey_donante_persona` (`id_persona`),
  KEY `Fkey_donante_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_donacion`
--

CREATE TABLE IF NOT EXISTS `estado_donacion` (
  `id_est_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donacion` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_est_donacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_donante`
--

CREATE TABLE IF NOT EXISTS `estado_donante` (
  `id_est_donante` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donante` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_est_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_beca`
--

CREATE TABLE IF NOT EXISTS `frecuencia_beca` (
  `id_frec_beca` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) DEFAULT NULL,
  `aplica_renovacion` bit(1) DEFAULT NULL,
  `numero_cuotas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_frec_beca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion_educativa`
--

CREATE TABLE IF NOT EXISTS `institucion_educativa` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(100) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `nombre_director` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `fecha` date DEFAULT NULL,
  `id_donacion` int(11) NOT NULL,
  `numero_cuota` int(11) DEFAULT NULL,
  `tipo_pago` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `id_banco` int(11) NOT NULL,
  `numero_recibo` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `usuario_mod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_banco_idx` (`id_banco`),
  KEY `fk_id_donacion_idx` (`id_donacion`),
  KEY `fk_tipo_pago_idx` (`tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `perfil` varchar(255) DEFAULT NULL,
  `menu` varchar(8000) DEFAULT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `id_municipio` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `telefono_casa` varchar(15) DEFAULT NULL,
  `telefono_movil` varchar(15) DEFAULT NULL,
  `telefono_trabajo` varchar(15) DEFAULT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `Genero` char(1) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `Fkey_persona_pais` (`id_pais`),
  KEY `Fkey_persona_municipio` (`id_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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


		/*VALIDACION DEL CAMPO TELEFONO_CASA*/
		IF NEW.telefono_casa <> null OR NEW.telefono_casa<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_casa REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE CASA no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;


		/*VALIDACION DEL CAMPO TELEFONO_MOVIL*/
		IF NEW.telefono_movil <> null OR NEW.telefono_movil<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_movil REGEXP '[78][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO MOVIL no coicide. Ejemplo: 7894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO TELEFONO_TRABAJO*/
		IF NEW.telefono_trabajo <> null OR NEW.telefono_trabajo<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_trabajo REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE TRABAJO no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NIT*/
		IF NEW.nit<>null OR NEW.nit<>"" THEN			
			SET validar_nit=(SELECT NEW.nit REGEXP '[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9]');
			IF validar_nit<>1 THEN
				SET msg = concat('El formato del NIT no coicide. Ejemplo: 0614-100389-134-7');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;        			
		END IF;


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


		/*VALIDACION DEL CAMPO TELEFONO_CASA*/
		IF NEW.telefono_casa <> null OR NEW.telefono_casa<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_casa REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE CASA no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;


		/*VALIDACION DEL CAMPO TELEFONO_MOVIL*/
		IF NEW.telefono_movil <> null OR NEW.telefono_movil<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_movil REGEXP '[78][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO MOVIL no coicide. Ejemplo: 7894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO TELEFONO_TRABAJO*/
		IF NEW.telefono_trabajo <> null OR NEW.telefono_trabajo<>"" THEN
		SET validar_telefono=(SELECT NEW.telefono_trabajo REGEXP '[2][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]');
			IF validar_telefono<>1 THEN
				SET msg = concat('El formato del TELEFONO DE TRABAJO no coicide. Ejemplo: 2894-1245');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;

		/*VALIDACION DEL CAMPO NIT*/
		IF NEW.nit<>null OR NEW.nit<>"" THEN			
			SET validar_nit=(SELECT NEW.nit REGEXP '[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9]');
			IF validar_nit<>1 THEN
				SET msg = concat('El formato del NIT no coicide. Ejemplo: 0614-100389-134-7');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;        			
		END IF;


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
  `id_usuario` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_promotor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `id_alumno` int(11) DEFAULT NULL,
  `id_donante` int(11) DEFAULT NULL,
  `id_institucion_edu` int(11) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `seccion` char(1) DEFAULT NULL,
  `nota_promedio` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `Fkey_registro_donante` (`id_donante`),
  KEY `Fkey_registro_alumno` (`id_alumno`),
  KEY `Fkey_registro_institucion` (`id_institucion_edu`),
  KEY `Fkey_registro_grado` (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renovacion`
--

CREATE TABLE IF NOT EXISTS `renovacion` (
  `id_renovacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_donacion` int(11) NOT NULL,
  `fecha_renovacion` date DEFAULT NULL,
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
  `id_donante` int(11) DEFAULT NULL,
  `numero_tarjeta` varchar(15) DEFAULT NULL,
  `fecha_expiracion` date DEFAULT NULL,
  `nombre_titular` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tarjeta`),
  KEY `Fkey_tarjeta_donante` (`id_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_beca`
--

CREATE TABLE IF NOT EXISTS `tipo_beca` (
  `id_beca` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_beca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_donacion`
--

CREATE TABLE IF NOT EXISTS `tipo_donacion` (
  `id_tipo_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`id_tipo_donacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Disparadores `tipo_donacion`
--
DROP TRIGGER IF EXISTS `trg_tipo_donacion_insert`;
DELIMITER //
CREATE TRIGGER `trg_tipo_donacion_insert` BEFORE INSERT ON `tipo_donacion`
 FOR EACH ROW BEGIN  
		
		
		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
					
		/*VALIDACION DEL CAMPO VALOR*/			
		IF NEW.valor="0.00" THEN
				SET msg = concat('No coicide el formato en el campo VALOR. Ejemplo: 22.56 o 22');
				SIGNAL sqlstate '45000' SET message_text = msg;     
		ELSE
			SET validar=(SELECT NEW.valor REGEXP '(^[0-9]{1,8}$)|([.]{1}[0-9]{1,2})$');
			IF validar<>1 THEN
				SET msg = concat('No coicide el formato en el campo VALOR. Ejemplo: 22.56 o 22');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
		
		/*VALIDACION DEL CAMPO ACTIVO*/
		IF NEW.activo<>null OR NEW.activo<>"" THEN
			IF NEW.activo<>0 AND NEW.activo<>1 THEN
				SET msg = concat('Solo se permiten los siguientes valores en este campo. Ejemplo: 0=false y 1=true');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
			
	END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_tipo_donacion_update`;
DELIMITER //
CREATE TRIGGER `trg_tipo_donacion_update` BEFORE UPDATE ON `tipo_donacion`
 FOR EACH ROW BEGIN  
		
		
		DECLARE validar varchar(50);
		DECLARE msg varchar(255);
					
		/*VALIDACION DEL CAMPO VALOR*/			
		IF NEW.valor="0.00" THEN
				SET msg = concat('No coicide el formato en el campo VALOR. Ejemplo: 22.56 o 22');
				SIGNAL sqlstate '45000' SET message_text = msg;     
		ELSE
			SET validar=(SELECT NEW.valor REGEXP '(^[0-9]{1,8}$)|([.]{1}[0-9]{1,2})$');
			IF validar<>1 THEN
				SET msg = concat('No coicide el formato en el campo VALOR. Ejemplo: 22.56 o 22');
				SIGNAL sqlstate '45000' SET message_text = msg;     
			END IF;
		END IF;
		
		/*VALIDACION DEL CAMPO ACTIVO*/
		IF NEW.activo<>null OR NEW.activo<>"" THEN
			IF NEW.activo<>0 AND NEW.activo<>1 THEN
				SET msg = concat('Solo se permiten los siguientes valores en este campo. Ejemplo: 0=false y 1=true');
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
  `valor` decimal(10,2) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `clave_acceso` varchar(50) DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `pregunta_secreta` varchar(200) DEFAULT NULL,
  `respuesta_secreta` varchar(50) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `estado_usuario` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Fkey_usuarios_perfil` (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `Fkey_alumno_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `beca_escolar`
--
ALTER TABLE `beca_escolar`
  ADD CONSTRAINT `fk_tipo_beca` FOREIGN KEY (`id_tipo_beca`) REFERENCES `tipo_beca` (`id_beca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frecuencia_beca` FOREIGN KEY (`id_frecuencia_beca`) REFERENCES `frecuencia_beca` (`id_frec_beca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registro_alumno` FOREIGN KEY (`id_registro_alumno`) REFERENCES `registro_alumno` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `Fkey_donacion_promotor` FOREIGN KEY (`id_promotor`) REFERENCES `promotor` (`id_promotor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_tipo_donacion` FOREIGN KEY (`id_tipo_donacion`) REFERENCES `tipo_donacion` (`id_tipo_donacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_tipo_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donacion` (`id_est_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `donante`
--
ALTER TABLE `donante`
  ADD CONSTRAINT `Fkey_donante_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donante` (`id_est_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `Fkey_municipio_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_donacion` FOREIGN KEY (`id_donacion`) REFERENCES `donacion` (`id_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_pago` FOREIGN KEY (`tipo_pago`) REFERENCES `donacion` (`id_tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `Fkey_persona_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_persona_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_alumno`
--
ALTER TABLE `registro_alumno`
  ADD CONSTRAINT `Fkey_registro_grado` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_institucion` FOREIGN KEY (`id_institucion_edu`) REFERENCES `institucion_educativa` (`id_institucion`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `Fkey_usuarios_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
