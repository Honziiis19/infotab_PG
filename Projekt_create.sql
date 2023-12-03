-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projdb` DEFAULT CHARACTER SET utf8 ;
USE `projdb` ;

-- -----------------------------------------------------
-- Table `mydb`.`uzivatele`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projdb`.`uzivatele` (
  `iduzivatele` INT NOT NULL AUTO_INCREMENT,
  `jmeno` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `heslo` VARCHAR(45) NOT NULL,
  `admin` ENUM('0', '1') NOT NULL,
  PRIMARY KEY (`iduzivatele`),
  UNIQUE INDEX `iduzivatele_UNIQUE` (`iduzivatele` ASC) VISIBLE,
  UNIQUE INDEX `jmeno_UNIQUE` (`jmeno` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`prezentace`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projdb`.`prezentace` (
  `idprezentace` INT NOT NULL AUTO_INCREMENT,
  `nadpis` VARCHAR(100) NULL,
  `obsah` VARCHAR(1000) NULL,
  `scroll text` VARCHAR(1000) NULL,
  `cas` DATETIME NULL,
  `obrazky_URL` VARCHAR(2000) NULL,
  PRIMARY KEY (`idprezentace`),
  UNIQUE INDEX `idprezentace_UNIQUE` (`idprezentace` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projdb`.`uzivatele_has_prezentace`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projdb`.`uzivatele_has_prezentace` (
  `uzivatele_iduzivatele` INT NOT NULL,
  `prezentace_idprezentace` INT NOT NULL,
  PRIMARY KEY (`uzivatele_iduzivatele`, `prezentace_idprezentace`),
  INDEX `fk_uzivatele_has_prezentace_prezentace1_idx` (`prezentace_idprezentace` ASC) VISIBLE,
  INDEX `fk_uzivatele_has_prezentace_uzivatele_idx` (`uzivatele_iduzivatele` ASC) VISIBLE,
  CONSTRAINT `fk_uzivatele_has_prezentace_uzivatele`
    FOREIGN KEY (`uzivatele_iduzivatele`)
    REFERENCES `projdb`.`uzivatele` (`iduzivatele`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uzivatele_has_prezentace_prezentace1`
    FOREIGN KEY (`prezentace_idprezentace`)
    REFERENCES `projdb`.`prezentace` (`idprezentace`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
