CREATE DATABASE `gd_cideco_es` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gd_cideco_es`;

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
  `fotografia` varchar(100) NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `Fkey_alumno_persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `banco` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_banco` varchar(100) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `beca_escolar` (
  `id_beca` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_beca` int(11) NOT NULL,
  `id_frecuencia_beca` int(11) NOT NULL,
  `id_registro_alumno` int(11) NOT NULL,
  `porcentaje_beca` decimal(10,2) NOT NULL,
  `fecha_inicio_beca` date NOT NULL,
  `fecha_fin_beca` date NOT NULL,
  `activo` varchar(255) NOT NULL,
  `beca_escolarcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_beca`),
  KEY `fk_tipo_beca_idx` (`id_tipo_beca`),
  KEY `fk_frecuencia_beca_idx` (`id_frecuencia_beca`),
  KEY `fk_registro_alumno_idx` (`id_registro_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(50) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `donacion` (
  `id_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_donante` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `id_tipo_donacion` int(11) NOT NULL,
  `id_promotor` int(11) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_donacion`),
  KEY `Fkey_donacion_donante` (`id_donante`),
  KEY `Fkey_donacion_tipo_donacion` (`id_tipo_donacion`),
  KEY `Fkey_donacion_tipo_pago` (`id_tipo_pago`),
  KEY `Fkey_donacion_promotor` (`id_promotor`),
  KEY `fk_estado_idx` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `donante` (
  `id_donante` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_donante`),
  KEY `Fkey_donante_estado` (`estado`),
  KEY `Fkey_donante_persona` (`id_persona`),
  KEY `Fkey_donante_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `estado_donacion` (
  `id_est_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donacion` varchar(60) NOT NULL,
  PRIMARY KEY (`id_est_donacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `estado_donante` (
  `id_est_donante` int(11) NOT NULL AUTO_INCREMENT,
  `estado_donante` varchar(100) NOT NULL,
  PRIMARY KEY (`id_est_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `frecuencia_beca` (
  `id_frec_beca` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  `aplica_renovacion` bit(1) NOT NULL,
  `numero_cuotas` int(11) NOT NULL,
  PRIMARY KEY (`id_frec_beca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `institucion_educativa` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(100) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `nombre_director` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `Fkey_municipio_departamento` (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_donacion` int(11) NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `numero_recibo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `usuario_mod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_banco_idx` (`id_banco`),
  KEY `fk_id_donacion_idx` (`id_donacion`),
  KEY `fk_tipo_pago_idx` (`tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(255) NOT NULL,
  `menu` varchar(8000) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `nit` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `Genero` char(1) NOT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `Fkey_persona_pais` (`id_pais`),
  KEY `Fkey_persona_municipio` (`id_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `promotor` (
  `id_promotor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_promotor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `registro_alumno` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `id_donante` int(11) NOT NULL,
  `id_institucion_edu` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `seccion` char(1) NOT NULL,
  `nota_promedio` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `Fkey_registro_donante` (`id_donante`),
  KEY `Fkey_registro_alumno` (`id_alumno`),
  KEY `Fkey_registro_institucion` (`id_institucion_edu`),
  KEY `Fkey_registro_grado` (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `renovacion` (
  `id_renovacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_donacion` int(11) NOT NULL,
  `fecha_renovacion` date NOT NULL,
  `documento_renovacion_img` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_renovacion`),
  KEY `fk_donacion_idx` (`id_donacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tarjetas_cobro` (
  `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT,
  `id_donante` int(11) NOT NULL,
  `numero_tarjeta` varchar(15) NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `nombre_titular` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tarjeta`),
  KEY `Fkey_tarjeta_donante` (`id_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `tipo_beca` (
  `id_beca` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`id_beca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tipo_donacion` (
  `id_tipo_donacion` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_donacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
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

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave_acceso` varchar(50) NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `pregunta_secreta` varchar(200) DEFAULT NULL,
  `respuesta_secreta` varchar(50) DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `Fkey_usuarios_perfil` (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


ALTER TABLE `alumno`
  ADD CONSTRAINT `Fkey_alumno_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `beca_escolar`
  ADD CONSTRAINT `fk_tipo_beca` FOREIGN KEY (`id_tipo_beca`) REFERENCES `tipo_beca` (`id_beca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frecuencia_beca` FOREIGN KEY (`id_frecuencia_beca`) REFERENCES `frecuencia_beca` (`id_frec_beca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registro_alumno` FOREIGN KEY (`id_registro_alumno`) REFERENCES `registro_alumno` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `donacion`
  ADD CONSTRAINT `Fkey_donacion_promotor` FOREIGN KEY (`id_promotor`) REFERENCES `promotor` (`id_promotor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_tipo_donacion` FOREIGN KEY (`id_tipo_donacion`) REFERENCES `tipo_donacion` (`id_tipo_donacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donacion_tipo_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donacion` (`id_est_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `donante`
  ADD CONSTRAINT `Fkey_donante_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_estado` FOREIGN KEY (`estado`) REFERENCES `estado_donante` (`id_est_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_donante_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `municipio`
  ADD CONSTRAINT `Fkey_municipio_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_donacion` FOREIGN KEY (`id_donacion`) REFERENCES `donacion` (`id_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_pago` FOREIGN KEY (`tipo_pago`) REFERENCES `donacion` (`id_tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `persona`
  ADD CONSTRAINT `Fkey_persona_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_persona_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `registro_alumno`
  ADD CONSTRAINT `Fkey_registro_grado` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fkey_registro_institucion` FOREIGN KEY (`id_institucion_edu`) REFERENCES `institucion_educativa` (`id_institucion`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `renovacion`
  ADD CONSTRAINT `fk_donacion` FOREIGN KEY (`id_donacion`) REFERENCES `donacion` (`id_donacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `tarjetas_cobro`
  ADD CONSTRAINT `Fkey_tarjeta_donante` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usuarios`
  ADD CONSTRAINT `Fkey_usuarios_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;