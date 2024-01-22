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
CREATE SCHEMA IF NOT EXISTS `infotabdb` DEFAULT CHARACTER SET utf8 ;
USE `infotabdb` ;

-- -----------------------------------------------------
-- Table `mydb`.`uzivatele`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infotabdb`.`uzivatele` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  `jmeno` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `heslo` VARCHAR(45) NOT NULL,
  `admin` ENUM('0', '1') NOT NULL
  )
ENGINE = InnoDB;
-- index pro jmeno
CREATE INDEX idx_jmeno
ON uzivatele(jmeno);

-- -----------------------------------------------------
-- Table `mydb`.`prezentace`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infotabdb`.`prezentace` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  `nadpis` VARCHAR(100) NULL,
  `obsah` VARCHAR(1000) NULL,
  `scroll text` VARCHAR(1000) NULL,
  `vyditelnost` DATETIME NULL,
  `created.by` VARCHAR(50),
  `modified.by` VARCHAR(50),
  `aktivni` ENUM("0", "1"),
  FOREIGN KEY (uzivatele_id) REFERENCES uzivatele(id)
  )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `infotab`.`snimky` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  FOREIGN KEY (prezentace_id) REFERENCES prezentace(id),
  `htmltext` VARCHAR(5000)
  )
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
