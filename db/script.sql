-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema StudentInfoDB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema StudentInfoDB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `StudentInfoDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `StudentInfoDB` ;

-- -----------------------------------------------------
-- Table `StudentInfoDB`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`department` (
  `d_code` VARCHAR(10) NOT NULL COMMENT '',
  `d_name` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`d_code`)  COMMENT '',
  UNIQUE INDEX `d_name_UNIQUE` (`d_name` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`semester`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`semester` (
  `semester` DECIMAL(2) NOT NULL COMMENT '',
  PRIMARY KEY (`semester`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`section` (
  `section` VARCHAR(5) NOT NULL COMMENT '',
  PRIMARY KEY (`section`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`student_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`student_info` (
  `roll_no` DECIMAL(5) NOT NULL COMMENT '',
  `s_name` VARCHAR(100) NOT NULL COMMENT '',
  `d_code` VARCHAR(10) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  `phone_no` DECIMAL(10) NOT NULL COMMENT '',
  `address` VARCHAR(200) NOT NULL COMMENT '',
  `semester` DECIMAL(2) NOT NULL COMMENT '',
  `section` VARCHAR(10) NOT NULL COMMENT '',
  PRIMARY KEY (`roll_no`)  COMMENT '',
  UNIQUE INDEX `phone_no_UNIQUE` (`phone_no` ASC)  COMMENT '',
  INDEX `d_code_idx` (`d_code` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  INDEX `semester_idx` (`semester` ASC)  COMMENT '',
  INDEX `section_idx` (`section` ASC)  COMMENT '',
  CONSTRAINT `d_code`
    FOREIGN KEY (`d_code`)
    REFERENCES `StudentInfoDB`.`department` (`d_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `semester`
    FOREIGN KEY (`semester`)
    REFERENCES `StudentInfoDB`.`semester` (`semester`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `section`
    FOREIGN KEY (`section`)
    REFERENCES `StudentInfoDB`.`section` (`section`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`stu_login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`stu_login` (
  `roll_no` DECIMAL(5) NOT NULL COMMENT '',
  `passwd` VARCHAR(50) NOT NULL COMMENT '',
  PRIMARY KEY (`roll_no`)  COMMENT '',
  UNIQUE INDEX `passwd_UNIQUE` (`passwd` ASC)  COMMENT '',
  CONSTRAINT `roll_no`
    FOREIGN KEY (`roll_no`)
    REFERENCES `StudentInfoDB`.`student_info` (`roll_no`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`faculty_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`faculty_info` (
  `f_id` VARCHAR(10) NOT NULL COMMENT '',
  `f_name` VARCHAR(100) NOT NULL COMMENT '',
  `d_code` VARCHAR(10) NOT NULL COMMENT '',
  `phone_no` DECIMAL(10) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  `office` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`f_id`)  COMMENT '',
  UNIQUE INDEX `phone_no_UNIQUE` (`phone_no` ASC)  COMMENT '',
  INDEX `d_code_idx` (`d_code` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  CONSTRAINT `d_codecx`
    FOREIGN KEY (`d_code`)
    REFERENCES `StudentInfoDB`.`department` (`d_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`faculty_login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`faculty_login` (
  `f_id` VARCHAR(10) NOT NULL COMMENT '',
  `passwd` VARCHAR(50) NOT NULL COMMENT '',
  PRIMARY KEY (`f_id`)  COMMENT '',
  UNIQUE INDEX `passwd_UNIQUE` (`passwd` ASC)  COMMENT '',
  CONSTRAINT `f_idcx`
    FOREIGN KEY (`f_id`)
    REFERENCES `StudentInfoDB`.`faculty_info` (`f_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`course_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`course_info` (
  `course_code` VARCHAR(20) NOT NULL COMMENT '',
  `course_name` VARCHAR(45) NOT NULL COMMENT '',
  `d_code` VARCHAR(10) NOT NULL COMMENT '',
  PRIMARY KEY (`course_code`)  COMMENT '',
  UNIQUE INDEX `c_name_UNIQUE` (`course_name` ASC)  COMMENT '',
  INDEX `d_code_idx` (`d_code` ASC)  COMMENT '',
  CONSTRAINT `d_codecxx`
    FOREIGN KEY (`d_code`)
    REFERENCES `StudentInfoDB`.`department` (`d_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`teaching_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`teaching_info` (
  `course_code` VARCHAR(20) NOT NULL COMMENT '',
  `f_id` VARCHAR(10) NOT NULL COMMENT '',
  `lectures_held` DECIMAL(2) NULL COMMENT '',
  PRIMARY KEY (`course_code`)  COMMENT '',
  CONSTRAINT `f_id`
    FOREIGN KEY (`f_id`)
    REFERENCES `StudentInfoDB`.`faculty_info` (`f_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `course_codecx`
    FOREIGN KEY (`course_code`)
    REFERENCES `StudentInfoDB`.`course_info` (`course_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`marks_attendence`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`marks_attendence` (
  `roll_no` DECIMAL(5) NOT NULL COMMENT '',
  `course_code` VARCHAR(20) NOT NULL COMMENT '',
  `attendence` DECIMAL(2) NOT NULL COMMENT '',
  `periodical_marks` DECIMAL(2) NULL COMMENT '',
  `ass_marks` DECIMAL(2) NULL COMMENT '',
  `final_marks` DECIMAL(2) NULL COMMENT '',
  `total_marks` DECIMAL(2) NULL COMMENT '',
  PRIMARY KEY (`roll_no`, `course_code`)  COMMENT '',
  INDEX `course_code_idx` (`course_code` ASC)  COMMENT '',
  CONSTRAINT `roll_noc`
    FOREIGN KEY (`roll_no`)
    REFERENCES `StudentInfoDB`.`student_info` (`roll_no`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `course_codec`
    FOREIGN KEY (`course_code`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`day`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`day` (
  `day` VARCHAR(10) NOT NULL COMMENT '',
  PRIMARY KEY (`day`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`timetable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`timetable` (
  `section` VARCHAR(5) NOT NULL COMMENT '',
  `semester` DECIMAL(2) NOT NULL COMMENT '',
  `day` VARCHAR(10) NOT NULL COMMENT '',
  `class1` VARCHAR(45) NULL COMMENT '',
  `class2` VARCHAR(45) NULL COMMENT '',
  `class3` VARCHAR(45) NULL COMMENT '',
  `class4` VARCHAR(45) NULL COMMENT '',
  `class5` VARCHAR(45) NULL COMMENT '',
  `class6` VARCHAR(45) NULL COMMENT '',
  `class7` VARCHAR(45) NULL COMMENT '',
  `class8` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`section`, `semester`, `day`)  COMMENT '',
  INDEX `semester_idx` (`semester` ASC)  COMMENT '',
  INDEX `day_idx` (`day` ASC)  COMMENT '',
  INDEX `class1_idx` (`class1` ASC, `class2` ASC, `class3` ASC, `class4` ASC, `class5` ASC, `class6` ASC, `class7` ASC, `class8` ASC)  COMMENT '',
  CONSTRAINT `sectioncc`
    FOREIGN KEY (`section`)
    REFERENCES `StudentInfoDB`.`section` (`section`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `semestercc`
    FOREIGN KEY (`semester`)
    REFERENCES `StudentInfoDB`.`semester` (`semester`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `daycc`
    FOREIGN KEY (`day`)
    REFERENCES `StudentInfoDB`.`day` (`day`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (`class1`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
     FOREIGN KEY (`class2`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,	
     FOREIGN KEY (`class3`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
FOREIGN KEY (`class4`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
FOREIGN KEY (`class5`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
FOREIGN KEY (`class6`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
FOREIGN KEY (`class7`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
FOREIGN KEY (`class8`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
)
;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`admin_login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`admin_login` (
  `name` VARCHAR(50) NOT NULL COMMENT '',
  `passwd` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`name`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`assignment` (
  `course_code` VARCHAR(20) NOT NULL COMMENT '',
  `assignNo` DECIMAL(2) NOT NULL COMMENT '',
  `description` VARCHAR(500) NOT NULL COMMENT '',
  `handOutDate` DATE NOT NULL COMMENT '',
  `dueDate` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`course_code`, `assignNo`)  COMMENT '',
  CONSTRAINT `course_codeccc`
    FOREIGN KEY (`course_code`)
    REFERENCES `StudentInfoDB`.`teaching_info` (`course_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`doubt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`doubt` (
  `roll_no` DECIMAL(5) NOT NULL COMMENT '',
  `course_code` VARCHAR(20) NOT NULL COMMENT '',
  `description` VARCHAR(500) NOT NULL COMMENT '',
  `askDate` DATE NOT NULL COMMENT '',
  `response` VARCHAR(500) NULL COMMENT '',
  PRIMARY KEY (`roll_no`, `course_code`)  COMMENT '',
  INDEX `course_code_idx` (`course_code` ASC)  COMMENT '',
  CONSTRAINT `roll_nocxx`
    FOREIGN KEY (`roll_no`)
    REFERENCES `StudentInfoDB`.`marks_attendence` (`roll_no`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `course_codecxx`
    FOREIGN KEY (`course_code`)
    REFERENCES `StudentInfoDB`.`marks_attendence` (`course_code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`pwd_stu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`pwd_stu` (
  `roll_no` DECIMAL(5) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`roll_no`)  COMMENT '',
  INDEX `email_idx` (`email` ASC)  COMMENT '',
  CONSTRAINT `roll_nocxxx`
    FOREIGN KEY (`roll_no`)
    REFERENCES `StudentInfoDB`.`student_info` (`roll_no`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `emailcxxx`
    FOREIGN KEY (`email`)
    REFERENCES `StudentInfoDB`.`student_info` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentInfoDB`.`pwd_fac`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `StudentInfoDB`.`pwd_fac` (
  `f_id` VARCHAR(10) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`f_id`)  COMMENT '',
  INDEX `email_idx` (`email` ASC)  COMMENT '',
  CONSTRAINT `f_idcxxxx`
    FOREIGN KEY (`f_id`)
    REFERENCES `StudentInfoDB`.`faculty_info` (`f_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `emailcxxxx`
    FOREIGN KEY (`email`)
    REFERENCES `StudentInfoDB`.`faculty_info` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

