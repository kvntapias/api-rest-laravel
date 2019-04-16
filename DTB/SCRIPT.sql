-- MySQL Script generated by MySQL Workbench
-- Mon Apr 15 10:29:10 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema apilaravel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema apilaravel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `apilaravel` DEFAULT CHARACTER SET utf8 ;
USE `apilaravel` ;

-- -----------------------------------------------------
-- Table `apilaravel`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apilaravel`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `surname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NULL,
  `description` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `remember_token` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apilaravel`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apilaravel`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apilaravel`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apilaravel`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `posts_categories_idx` (`category_id` ASC) ,
  INDEX `posts_users_idx` (`user_id` ASC) ,
  CONSTRAINT `posts_categories`
    FOREIGN KEY (`category_id`)
    REFERENCES `apilaravel`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `posts_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `apilaravel`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;