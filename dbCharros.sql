-- MySQL Script generated by MySQL Workbench
-- Tue Oct 23 16:58:19 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema corpoteg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema corpoteg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `corpoteg` DEFAULT CHARACTER SET utf8 ;
USE `corpoteg` ;

-- -----------------------------------------------------
-- Table `corpoteg`.`medio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`medio` (
  `pk_medio` INT NOT NULL AUTO_INCREMENT,
  `idmedio` VARCHAR(300) NULL,
  PRIMARY KEY (`pk_medio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`perfil` (
  `pk_perfil` INT NOT NULL AUTO_INCREMENT,
  `perfil` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`pk_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`estatus` (
  `pk_estatus` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(300) NULL,
  PRIMARY KEY (`pk_estatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`usuario` (
  `pk_usuario` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NULL,
  `usuario` VARCHAR(255) NULL,
  `contrasena` VARCHAR(255) NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `a_paterno` VARCHAR(100) NOT NULL,
  `a_materno` VARCHAR(100) NULL,
  `telefono` VARCHAR(30) NULL,
  `observacion` VARCHAR(500) NULL,
  `correo_electronico` VARCHAR(100) NULL,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` TIMESTAMP NOT NULL on update CURRENT_TIMESTAMP,
  `activo` TINYINT(4) NOT NULL DEFAULT 1,
  `nss` VARCHAR(30) NOT NULL,
  `curp` VARCHAR(30) NOT NULL,
  `tipo_sangre` VARCHAR(4) NOT NULL,
  `contacto` VARCHAR(180) NULL,
  `alergia` VARCHAR(500) NULL,
  `direccion` VARCHAR(300) NULL,
  `fk_medio` INT NOT NULL,
  `fk_perfil` INT NOT NULL,
  `fk_estatus` INT NOT NULL,
  `reclutador` TINYINT(4) NOT NULL,
  `nombre_foto` VARCHAR(50) NULL,
  `usuariocol` VARCHAR(45) NULL,
  PRIMARY KEY (`pk_usuario`, `fk_medio`, `fk_perfil`, `fk_estatus`),
  INDEX `fk_usuario_medio1_idx` (`fk_medio` ASC),
  INDEX `fk_usuario_perfil1_idx` (`fk_perfil` ASC),
  INDEX `fk_usuario_estatus1_idx` (`fk_estatus` ASC),
  CONSTRAINT `fk_usuario_medio1`
    FOREIGN KEY (`fk_medio`)
    REFERENCES `corpoteg`.`medio` (`pk_medio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_perfil1`
    FOREIGN KEY (`fk_perfil`)
    REFERENCES `corpoteg`.`perfil` (`pk_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_estatus1`
    FOREIGN KEY (`fk_estatus`)
    REFERENCES `corpoteg`.`estatus` (`pk_estatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`servicio` (
  `pk_servicio` INT NOT NULL AUTO_INCREMENT,
  `servicio` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`pk_servicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`modulo` (
  `pk_modulo` INT NOT NULL AUTO_INCREMENT,
  `modulo` VARCHAR(150) NULL,
  PRIMARY KEY (`pk_modulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`permiso` (
  `fk_perfil` INT NOT NULL,
  `fk_modulo` INT NOT NULL,
  `ver` TINYINT(1) NOT NULL DEFAULT 0,
  `editar` TINYINT(1) NOT NULL DEFAULT 0,
  `crear` TINYINT(1) NOT NULL DEFAULT 0,
  `eliminar` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fk_perfil`, `fk_modulo`),
  INDEX `fk_perfil_has_permisos_permisos1_idx` (`fk_modulo` ASC),
  INDEX `fk_perfil_has_permisos_perfil1_idx` (`fk_perfil` ASC),
  CONSTRAINT `fk_perfil_has_permisos_perfil1`
    FOREIGN KEY (`fk_perfil`)
    REFERENCES `corpoteg`.`perfil` (`pk_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_has_permisos_permisos1`
    FOREIGN KEY (`fk_modulo`)
    REFERENCES `corpoteg`.`modulo` (`pk_modulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`turno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`turno` (
  `pk_turno` INT NOT NULL AUTO_INCREMENT,
  `turno` VARCHAR(150) NOT NULL,
  `personal_solicitado` INT(11) NOT NULL,
  PRIMARY KEY (`pk_turno`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`vacante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`vacante` (
  `pk_vacante` INT NOT NULL AUTO_INCREMENT,
  `vacante` INT(11) NOT NULL COMMENT 'La cantidad de personal a solicitar',
  `fk_turno` INT NOT NULL,
  `fk_servicio` INT NOT NULL,
  `vacante_activo` TINYINT(4) NOT NULL,
  PRIMARY KEY (`pk_vacante`),
  INDEX `fk_vacante_turno1_idx` (`fk_turno` ASC),
  INDEX `fk_vacante_servicio1_idx` (`fk_servicio` ASC),
  CONSTRAINT `fk_vacante_turno1`
    FOREIGN KEY (`fk_turno`)
    REFERENCES `corpoteg`.`turno` (`pk_turno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacante_servicio1`
    FOREIGN KEY (`fk_servicio`)
    REFERENCES `corpoteg`.`servicio` (`pk_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`asignado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`asignado` (
  `fk_vacante` INT NOT NULL,
  `fk_usuario` INT NOT NULL,
  `asignado_activo` TINYINT(4) NOT NULL DEFAULT 1,
  `asignado_fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asignado_editado` TIMESTAMP NOT NULL DEFAULT NULL on updte CURRENT_TIMESTAMP,
  `supervisor` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fk_vacante`, `fk_usuario`),
  INDEX `fk_vacante_has_usuario_usuario1_idx` (`fk_usuario` ASC),
  INDEX `fk_vacante_has_usuario_vacante1_idx` (`fk_vacante` ASC),
  CONSTRAINT `fk_vacante_has_usuario_vacante1`
    FOREIGN KEY (`fk_vacante`)
    REFERENCES `corpoteg`.`vacante` (`pk_vacante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacante_has_usuario_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `corpoteg`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`log` (
  `pk_log` INT NOT NULL AUTO_INCREMENT,
  `fk_usuario` INT NOT NULL,
  `responsable` VARCHAR(100) NOT NULL,
  `accion` VARCHAR(300) NOT NULL,
  `captura` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_log`),
  INDEX `fk_log_usuario1_idx` (`fk_usuario` ASC),
  CONSTRAINT `fk_log_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `corpoteg`.`usuario` (`pk_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `corpoteg`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `corpoteg`.`asistencia` (
  `pk_asistencia` INT NOT NULL AUTO_INCREMENT,
  `fk_servicio` INT NOT NULL,
  `hora_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `medio_registro` VARCHAR(80) NOT NULL COMMENT 'Si fue por la app o algún dispositivo',
  `codigo_usuario` VARCHAR(45) NOT NULL COMMENT 'Es el campo que concuerda con usuario',
  `accion_regristro` TINYINT NOT NULL DEFAULT 0 COMMENT '0=ENTRADA LABORAL\n1=SALIDA COMIDA\n2=ENTRADA COMIDA\n4=SALIDA LABORAL',
  PRIMARY KEY (`pk_asistencia`, `fk_servicio`),
  INDEX `fk_asistencia_servicio1_idx` (`fk_servicio` ASC),
  CONSTRAINT `fk_asistencia_servicio1`
    FOREIGN KEY (`fk_servicio`)
    REFERENCES `corpoteg`.`servicio` (`pk_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
