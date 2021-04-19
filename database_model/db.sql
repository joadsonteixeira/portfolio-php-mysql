-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema portfolio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema portfolio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `portfolio` DEFAULT CHARACTER SET utf8 ;
USE `portfolio` ;

-- -----------------------------------------------------
-- Table `portfolio`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio`.`pessoa` (
  `idpessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `celular` VARCHAR(15) NOT NULL,
  `avatar-ref` VARCHAR(200) NULL,
  PRIMARY KEY (`idpessoa`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portfolio`.`valor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio`.`valor` (
  `idvalor` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `icone-ref` VARCHAR(200) NOT NULL,
  `pessoa_idpessoa` INT NOT NULL,
  PRIMARY KEY (`idvalor`),
  INDEX `fk_valor_pessoa1_idx` (`pessoa_idpessoa` ASC),
  CONSTRAINT `fk_valor_pessoa1`
    FOREIGN KEY (`pessoa_idpessoa`)
    REFERENCES `portfolio`.`pessoa` (`idpessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portfolio`.`projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio`.`projeto` (
  `idprojeto` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `imagem-ref` VARCHAR(45) NOT NULL,
  `pessoa_idpessoa` INT NOT NULL,
  PRIMARY KEY (`idprojeto`),
  INDEX `fk_projeto_pessoa1_idx` (`pessoa_idpessoa` ASC),
  CONSTRAINT `fk_projeto_pessoa1`
    FOREIGN KEY (`pessoa_idpessoa`)
    REFERENCES `portfolio`.`pessoa` (`idpessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
