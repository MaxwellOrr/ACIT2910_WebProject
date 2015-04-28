-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: PoliceDB
-- Source Schemata: PoliceDB
-- Created: Mon Apr 20 06:24:29 2015
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema PoliceDB
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `PoliceDB` ;
CREATE SCHEMA IF NOT EXISTS `PoliceDB` ;

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Department
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Department` (
  `depID` INT NOT NULL,
  `depName` VARCHAR(64) NOT NULL,
  `depAddress` VARCHAR(64) NOT NULL,
  `depCity` VARCHAR(64) NOT NULL,
  `depProvince` VARCHAR(64) NULL,
  PRIMARY KEY (`depID`));

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Officer
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Officer` (
  `offID` INT NOT NULL,
  `depID` INT NOT NULL,
  `offFirstname` VARCHAR(20) NOT NULL,
  `offLastname` VARCHAR(20) NOT NULL,
  `offBirthdate` DATE NOT NULL,
  `offRank` VARCHAR(64) NULL,
  PRIMARY KEY (`offID`),
  CONSTRAINT `FK__Officer__depID__276EDEB3`
    FOREIGN KEY (`depID`)
    REFERENCES `PoliceDB`.`Department` (`depID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Incident
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Incident` (
  `incID` INT NOT NULL,
  `incAddress` VARCHAR(20) NOT NULL,
  `incDate` DATE NOT NULL,
  `incType` VARCHAR(64) NULL,
  `incEvidence` VARCHAR(255) NULL,
  `incReport` VARCHAR(255) NULL,
  PRIMARY KEY (`incID`));

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Vehicles
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Vehicles` (
  `vehRegNum` INT NOT NULL,
  `incID` INT NOT NULL,
  `vehColor` VARCHAR(10) NULL,
  `vehType` VARCHAR(20) NOT NULL,
  `vehPlate` VARCHAR(10) NULL,
  PRIMARY KEY (`vehRegNum`),
  CONSTRAINT `FK__Vehicles__incID__2C3393D0`
    FOREIGN KEY (`incID`)
    REFERENCES `PoliceDB`.`Incident` (`incID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Suspect
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Suspect` (
  `suspID` INT NOT NULL,
  `offID` INT NOT NULL,
  `incID` INT NOT NULL,
  `suspFirstname` VARCHAR(20) NOT NULL,
  `suspLastname` VARCHAR(20) NOT NULL,
  `suspGender` VARCHAR(10) NOT NULL,
  `suspBirthdate` DATE NOT NULL,
  `suspAddress` VARCHAR(40) NULL,
  `suspPhone` VARCHAR(10) NULL,
  `suspWarrants` VARCHAR(255) NULL,
  PRIMARY KEY (`suspID`),
  CONSTRAINT `FK__Suspect__offID__2F10007B`
    FOREIGN KEY (`offID`)
    REFERENCES `PoliceDB`.`Officer` (`offID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Suspect__incID__300424B4`
    FOREIGN KEY (`incID`)
    REFERENCES `PoliceDB`.`Incident` (`incID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Weapons
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Weapons` (
  `weapID` INT NOT NULL,
  `incID` INT NOT NULL,
  `weapDesc` VARCHAR(255) NULL,
  `weapType` VARCHAR(255) NULL,
  PRIMARY KEY (`weapID`),
  CONSTRAINT `FK__Weapons__incID__32E0915F`
    FOREIGN KEY (`incID`)
    REFERENCES `PoliceDB`.`Incident` (`incID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Evidence
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`Evidence` (
  `incID` INT NOT NULL,
  `eviDesc` VARCHAR(255) NULL,
  PRIMARY KEY (`incID`),
  CONSTRAINT `FK__Evidence__incID__35BCFE0A`
    FOREIGN KEY (`incID`)
    REFERENCES `PoliceDB`.`Incident` (`incID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Login
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`login` (
 `ID` int(11) NOT NULL,
 `secLevel` int(11) NOT NULL,
 `username` varchar(10) NOT NULL,
 `password` varchar(64) NOT NULL,
 PRIMARY KEY (`ID`)
);

INSERT INTO `PoliceDB`.`department` VALUES (1001, 'New Westminster', '555 Columbia Street',
 'New Westminster', 'BC' );
 INSERT INTO `PoliceDB`.`department` VALUES (1002, 'Burnaby', '6355 Deer Lake AVE',
 'Burnaby', 'BC' );
 INSERT INTO `PoliceDB`.`department` VALUES (1003, 'Vancouver', '2120 Cambie Street',
 'Vancouver', 'BC' );
 INSERT INTO `PoliceDB`.`department` VALUES (1004, 'Delta', '4455 Clarence Taylor Cres',
 'Delta', 'BC' );
 INSERT INTO `PoliceDB`.`department` VALUES (1005, 'Surrey', '14355 57 Ave',
 'Surrey', 'BC' );
 INSERT INTO `PoliceDB`.`department` VALUES (1006, 'Ottawa', '474 Elgin St',
 'Ottawa', 'ON' );
 INSERT INTO `PoliceDB`.`department` VALUES (1007, 'Calgary', '5111 47 St N.E',
 'Calgary', 'AB' );
 INSERT INTO `PoliceDB`.`department` VALUES (1008, 'Edmonton', '9620 - 103A Avenue',
 'Edmonton', 'AB' );




SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO PoliceDB.login (ID, secLevel, username , password) VALUES (109, 3, "Admin", "root");

