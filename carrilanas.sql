SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `carrilanas` DEFAULT CHARACTER SET latin1 ;
USE `carrilanas` ;

-- -----------------------------------------------------
-- Table `carrilanas`.`carrera`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`carrera` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `fecha` DATE NOT NULL ,
  `lugar` VARCHAR(80) NOT NULL ,
  `distancia` INT NOT NULL ,
  `mapa` VARCHAR(80) NOT NULL ,
  `nombre` VARCHAR(50) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`equipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`equipo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  `vehiculo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`piloto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`piloto` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  `direccion` VARCHAR(30) NOT NULL ,
  `telefono` VARCHAR(30) NOT NULL ,
  `email` VARCHAR(30) NOT NULL ,
  `fecha_de_nacimiento` DATE NOT NULL ,
  `foto` VARCHAR(30) NOT NULL ,
  `equipo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_piloto_equipo1` (`equipo_id` ASC) ,
  CONSTRAINT `fk_piloto_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `carrilanas`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`vehiculo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`vehiculo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  `equipo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vehiculo_equipo1` (`equipo_id` ASC) ,
  CONSTRAINT `fk_vehiculo_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `carrilanas`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`inscripcion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`inscripcion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `carrera_id` INT(11) NULL ,
  `equipo_id` INT(11) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_carrera_has_equipo_equipo1` (`equipo_id` ASC) ,
  INDEX `fk_carrera_has_equipo_carrera1` (`carrera_id` ASC) ,
  CONSTRAINT `fk_carrera_has_equipo_carrera1`
    FOREIGN KEY (`carrera_id` )
    REFERENCES `carrilanas`.`carrera` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrera_has_equipo_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `carrilanas`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `carrilanas`.`llegada`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `carrilanas`.`llegada` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tiempo` TIME NULL ,
  `puesto` INT NULL ,
  `categoria_id` INT NOT NULL ,
  `inscripcion_id` INT NOT NULL ,
  `carrera_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_llegada_categoria1` (`categoria_id` ASC) ,
  INDEX `fk_llegada_inscripcion1` (`inscripcion_id` ASC) ,
  INDEX `fk_llegada_carrera1` (`carrera_id` ASC) ,
  CONSTRAINT `fk_llegada_categoria1`
    FOREIGN KEY (`categoria_id` )
    REFERENCES `carrilanas`.`categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_llegada_inscripcion1`
    FOREIGN KEY (`inscripcion_id` )
    REFERENCES `carrilanas`.`inscripcion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_llegada_carrera1`
    FOREIGN KEY (`carrera_id` )
    REFERENCES `carrilanas`.`carrera` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

