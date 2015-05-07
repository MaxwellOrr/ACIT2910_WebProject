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
  `incRegion` INT NOT NULL,
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
  `suspPhone` VARCHAR(40) NULL,
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
-- Table PoliceDB.Login
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `PoliceDB`.`login` (
 `ID` int(11) NOT NULL,
 `secLevel` int(11) NOT NULL,
 `username` varchar(10) NOT NULL,
 `password` varchar(64) NOT NULL,
 PRIMARY KEY (`ID`)
);
-- ----------------------------------------------------------------------------
-- Table PoliceDB.Department VALUES
-- ----------------------------------------------------------------------------
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

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Officer VALUES
-- ----------------------------------------------------------------------------
INSERT INTO `PoliceDB`.`Officer` VALUES (14000, 1001, 'Patrick',
 'Jung', 10/08/1983, 'Cadet' );
 INSERT INTO `PoliceDB`.`Officer` VALUES (14001, 1002, 'Joe',
 'Johnson', 9/07/1982, 'Police Constable 4th Class' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14002, 1003, 'Andrei',
 'Tchakovsky', 8/06/1981, 'Police Constable 3rd Class' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14003, 1004, 'Raymond',
 'Lo', 10/08/1983, 'Police Constable 4th Class' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14004, 1005, 'Geric',
 'Farell', 10/08/1980, 'Police Constable 1st Class' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14005, 1006, 'Daryl',
 'Williams', 10/08/1979, 'Police Constable 2nd Class' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14006, 1007, 'Justin',
 'Tesoto', 10/08/1978, 'Detective Constable' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14007, 1008, 'Paolo',
 'Sanchez', 10/08/1977, 'Detective Constable' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14008, 1001, 'Fredrick',
 'Myer', 10/08/1976, 'Detective' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14009, 1002, 'Derek',
 'Roy', 10/08/1975, 'Sergeant Major' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14010, 1003, 'Frank',
 'Cho', 10/08/1974, 'Inspector' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14011, 1004, 'Adam',
 'Reichel', 10/08/1973, 'Inspector' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14012, 1005, 'Philip',
 'Sun', 10/08/1972, 'Staff Inspector' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14013, 1006, 'Hung',
 'Li', 10/08/1971, 'Superintendent' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14014, 1007, 'Stella',
 'Gardner', 10/08/1970, 'Cadet' );
INSERT INTO `PoliceDB`.`Officer` VALUES (14015, 1008, 'Alfred',
 'Ehroff', 10/08/1989, 'Chief Constable' );


-- ----------------------------------------------------------------------------
-- Table PoliceDB.Incident VALUES
-- ----------------------------------------------------------------------------
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1001, '593 Aspen Court', 1, 27/07/2002, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1002, '487 George Street', 3, 12/05/2003, 'Battery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1003, '35 Charles Street', 4, 05/30/2007, 'Robbery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1004, '198 8th Street', 5, 07/15/2002, 'Forgery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1005, '259 Route 202', 9,  02/25/2011, 'False Imprisonment');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1006, '598 Meadow Street ', 6,  10/23/2012, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1007, '438 Lawrence Street ', 3, 05/21/2008, 'Kidnapping');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1008, '618 Ridge Avenue', 7, 11/11/2000, 'Sexual assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1009, '811 Grant Street ', 1, 12/07/2004, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1010, '177 Lincoln Avenue', 2, 10/06/2007, 'Solicitation');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1011, '643 Central Avenue', 5, 07/02/2006, 'Robbery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1012, '506 Hartford Road ', 8, 02/07/2012, 'Forgery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1013, '241 Hillside Drive ', 9, 01/12/2013, 'False Imprisonment');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1014, '814 Route 10', 2, 02/05/2012, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1015, '700 Locust Street ', 6, 11/29/2007, 'False pretenses');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1016, '38 Henry Street', 2, 06/14/2003, 'Sexual assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1017, '777 Laurel Street', 2, 11/22/2010, 'Sexual assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1018, '964 North Avenue', 2, 10/08/2003, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1019, '185 Wood Street', 3, 03/07/2008, 'Solicitation');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1020, '190 Fairview Road', 1, 07/19/2008, 'Robbery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1021, '769 Garden Street', 1, 01/30/2007, 'Forgery');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1022, '618 Cottage Street', 2, 10/08/2011, 'False Imprisonment');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1023, '103 West Street', 5, 01/06/2004, 'Assault');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1024, '596 Sycamore Street', 9, 05/28/2003, 'False pretenses');
INSERT INTO `PoliceDB`.`incident`(incID, incAddress, incRegion, incDate, incType) VALUES(1025, '652 Lincoln Street', 2, 11/18/2009, 'Sexual assault');

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Vehicles VALUES (type: truck sedan bike sport
-- ----------------------------------------------------------------------------
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100111, 1001, 'Maroon' , 'Sedan' , '1v2b3n');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100112, 1001, 'Black' , 'Truck' , '2z3x4c');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100113, 1002, 'Yellow' , 'Sedan' , '2w3e4r');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100114, 1003, 'Black' , 'Bike' , '5t6y7u');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100115, 1004, 'Orange' , 'Sport' , '8i9o0p');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100116, 1004, 'Red' , 'Truck' , '0p9o8i');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100117, 1005, 'Red' , 'Sedan' , '7u6y5t');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100118, 1006, 'Pink' , 'Sedan' , '4r3e2w');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100119, 1007, 'White' , 'Sedan' , '1q3e4r');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100120, 1008, 'Black' , 'Bike' , '2w4r6y');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100121, 1009, 'Silver' , 'Sport' , '7u9o0p');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100122, 1010, 'Black' , 'Sport' , '6y4r5t');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100123, 1011, 'Peach' , 'Sedan' , '4r7u9o');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100124, 1012, 'Orange' , 'Bike' , '0p7u6y');
INSERT INTO `PoliceDB`.`Vehicles`(vehRegNum, incID, vehColor, vehType, vehPlate) VALUES(100125, 1013, 'Black' , 'Sedan' , '1q4r6y');

-- ----------------------------------------------------------------------------
-- Table PoliceDB.Suspects VALUES 
-- ----------------------------------------------------------------------------
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES( 131313,14001, 1001, 'Arman' , 'Selhi' , 'Male', 10/08/1983, '2657 Arid Avenue', '133-453-4456' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Arman Selhi, who is accused of an offense or violation based on the following document filed with the court: Battery' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131314, 14000, 1002, 'Freddy' , 'Marsh' , 'Male', 8/6/1983, '1342 Tent Street', '133-134-2797' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Freddy Marsh, who is accused of an offense or violation based on the following document filed with the court: Assault' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131315,14002, 1003, 'Sasha' , 'Pukanich' , 'Male', 3/5/1983, '1342 Tent Street', '133-142-3940' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Sasha Pukanich, who is accused of an offense or violation based on the following document filed with the court: Robbery' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131316,14003, 1004, 'Robert' , 'Ling' , 'Male', 1/12/1983, '1342 Tent Street', '133-293-0009' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Robert Ling, who is accused of an offense or violation based on the following document filed with the court: Forgery' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131317,14004, 1005, 'April' , 'Wilmur' , 'Female', 10/08/1981, '1342 Tent Street', '133-167-9803' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay April Wilmur, who is accused of an offense or violation based on the following document filed with the court: False Imprisonment' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131318,14005, 1006, 'Segal' , 'Sutherland' , 'Male', 1/9/1982, '1342 Tent Street', '133-278-0190' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Segal Sutherland, who is accused of an offense or violation based on the following document filed with the court: Assault' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131319,14006, 1007, 'Esteban' , 'Mosare' , 'Male', 2/08/1983, '1342 Tent Street', '133-839-0198' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Esteban Mosare, who is accused of an offense or violation based on the following document filed with the court: Kidnapping' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131320,14007, 1008, 'Sunny' , 'Karnjit' , 'Male', 12/1/1984, '1342 Tent Street', '133-189-0298' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Sunny Karnjit, who is accused of an offense or violation based on the following document filed with the court: Sexual Assault' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131321,14008, 1009, 'Abraham' , 'Samar' , 'Male', 1/1/1981, '1342 Tent Street', '133-978-0989' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Abraham Samar, who is accused of an offense or violation based on the following document filed with the court: Assault' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131322,14009, 1010, 'Jeff' , 'Randall' , 'Male', 11/11/1982, '1342 Tent Street', '133-172-1890' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Jeff Randall, who is accused of an offense or violation based on the following document filed with the court: Solicitation' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131323,14010, 1011, 'Sedric' , 'Williams' , 'Male', 1/08/1983, '1342 Tent Street', '133-992-9203' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Sedric Williams, who is accused of an offense or violation based on the following document filed with the court: Robbery' );
INSERT INTO `PoliceDB`.`Suspect`(suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate, suspAddress, suspPhone, suspWarrants) VALUES(131324,14011, 1012, 'Ana' , 'Roland' , 'Female', 10/07/1987, '1342 Tent Street', '133-178-1829' , 'YOU ARE COMMANDED to arrest and bring before a United States magistrate judge without unnecessary delay Ana Roland, who is accused of an offense or violation based on the following document filed with the court: Forgery' );


-- ----------------------------------------------------------------------------
-- Table PoliceDB.Weapons
-- ----------------------------------------------------------------------------
    
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22245, 1001, '.92mm rimless sidearm glock' , 'Firearm');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22246, 1002, '8 inch m9 bayonet' , 'Knife');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22247, 1003, '3 foot steel baseball bat' , 'Blunt');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22248, 1004, '40 inch garrote' , 'Other');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22249, 1005, '.23mm rimless p250 sidearm' , 'Firearm');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22250, 1006, '9 inch karambit' , 'Knife');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22251, 1007, '4 inch steel knuckles' , 'Blunt');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22252, 1008, '8 inch bayonet' , 'Knife');
INSERT INTO `PoliceDB`.`Weapons`(weapID, incID, weapDesc, weapType) VALUES(22253, 1009, '.63 rimmed p2000' , 'Firearm');
    

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO PoliceDB.login (ID, secLevel, username , password) VALUES (109, 3, "Admin", "root");


