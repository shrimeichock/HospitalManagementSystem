/*  Author: @shrimeichock
	Date created: April 2, 2022
	Description: SQL script to build the database. Includes some sample data for each table.
*/
BEGIN;

DROP TABLE IF EXISTS is_experiencing;
DROP TABLE IF EXISTS assigned_to;
DROP TABLE IF EXISTS sick_from;
DROP TABLE IF EXISTS symptom_of;
DROP TABLE IF EXISTS patients;
DROP TABLE IF EXISTS departments;
DROP TABLE IF EXISTS doctors;
DROP TABLE IF EXISTS illnesses;
DROP TABLE IF EXISTS symptoms;

CREATE TABLE patients (
    ID int NOT NULL PRIMARY KEY AUTO_INCREMENT, -- patient's ID
    FirstName varchar(30) NOT NULL, -- first name
    LastName varchar(30) NOT NULL, -- last name
	Sex varchar(1), -- M or F
    PhoneNumber varchar(15), -- phone number (XXX-XXX-XXXX)
    Email varchar(30), -- email address (ex. someone@gmail.com)
    Address varchar(50), -- home address (ex. 123 Rocker Ave)
    Birthdate date, -- date of birth (YYYY-MM-DD)
    Insurance varchar(15), -- health insurance number
    DateAdmitted date NOT NULL -- date admitted (YYYY-MM-DD)
);

INSERT INTO patients VALUES (1, 'Isla-Grace', 'Adams', 'F', '611-893-2312', 'isla@yahoo.com', '132 Tapestry Way', '1998-01-01', 'ISLA19980101', '2022-04-01');
INSERT INTO patients VALUES (2, 'Mahima', 'Rudd', 'F', '613-823-9012', 'mahima@gmail.com', '222 Berkshire Drive', '1978-02-19', 'MAHI19780219', '2022-03-30');
INSERT INTO patients VALUES (3, 'Owen', 'Casanova', 'M', '981-823-7301', 'owen@gmail.com', '59 Queens Cresent', '2001-10-09', 'OWEN20011009', '2022-04-10');
INSERT INTO patients VALUES (4, 'Manal', 'Carty', 'F', '689-889-2002', 'manal@yahoo.com', '199 Starling Ave', '2006-04-11', 'MANA20060411', '2022-02-12');
INSERT INTO patients VALUES (5, 'Alex', 'Bertram', 'M', '101-855-5311', 'alex@gmail.com', '78 Hathaway Ave', '1999-08-20', 'ALEX19990820', '2021-12-15');
INSERT INTO patients VALUES (6, 'Sarah', 'Turner', 'F', '101-855-5311', 'sarah@hotmail.com', '456 Willow Drive', '1985-12-30', 'SARA19851230', '2021-09-22');
INSERT INTO patients VALUES (7, 'Sarah', 'Bertram', 'F', '987-654-3210', 'sarah2@hotmail.com', '48 Mallow Drive', '1992-10-29', 'SARA19921029', '2022-01-12');

CREATE TABLE doctors (
	ID int NOT NULL PRIMARY KEY, -- doctor’s ID
    FirstName varchar(30) NOT NULL, -- first name
    LastName varchar(30) NOT NULL, -- last name
    PhoneNumber varchar(15), -- phone number (XXX-XXX-XXXX)
    Email varchar(30), -- email address (ex. someone@gmail.com)
    Address varchar(50), -- home address (ex. 123 Rocker Ave)
    Position varchar(30), -- title or type of doctor (ex. Cardiologist)
    Date_joined date NOT NULL, -- start of employment (YYYY-MM-DD)
    Department varchar(20) references departments(Dept_name) -- department the doctor is under  
);

INSERT INTO doctors VALUES(1,'Brent', 'Rock', '123-456-7890', 'brent@gmail.com', '555 Waterfall Way', 'Cardiologist', '2004-01-10', 'Cardiology');
INSERT INTO doctors VALUES(2,'Carly', 'Manchester', '222-567-0000', 'carly@gmail.com', '343 Mist Drive', 'Cardiovascular specalist', '2009-12-01', 'Cardiology');
INSERT INTO doctors VALUES(3,'Marty', 'Drago', '812-999-3219', 'carly@yahoo.com', '40 Ventnor Avenue', 'Surgeon', '1999-05-19', 'Operation Theatre');
INSERT INTO doctors VALUES(4,'Meena', 'Walters', '645-023-1092', 'meena@gmail.com', '121 Barkley Drive', 'Resident', '2020-09-12', 'Operation Theatre');
INSERT INTO doctors VALUES(5,'Melissa', 'Jackson', '613-229-8970', 'melissa@yahoo.com', '390 Vanier Way', 'Surgical assitant', '2011-08-27', 'Operation Theatre');
INSERT INTO doctors VALUES(6,'Eric', 'Wang', '914-555-2367', 'eric@gmail.com', '123 Redpath Cresent', 'Radiologist', '2003-10-04', 'Radiology');
INSERT INTO doctors VALUES(7,'Brent', 'Walters', '000-011-3452', 'brent2@gmail.com', '109 Rudolf Cresent', 'Radiologist', '2003-10-04', 'Radiology');

CREATE TABLE departments (
	Dept_name varchar(20) NOT NULL PRIMARY KEY, -- department name
	Building varchar(20), -- building that the department is located
	Head integer references doctors(id) -- head doctor for the department
);

INSERT INTO departments VALUES('Cardiology', 'Azrieli Pavillion', 1);
INSERT INTO departments VALUES('Operation Theatre', 'Canal Building', 3);
INSERT INTO departments VALUES('Radiology', 'Herzberg Building', 6);

CREATE TABLE illnesses (
	Name varchar(30) NOT NULL PRIMARY KEY, -- name of the illness or condition
	Description text, -- a short description of the illness
	Url text -- a link to information about the illness
);

INSERT INTO illnesses VALUES('Common cold', "The common cold is a viral infection of your nose and throat (upper respiratory tract). It's usually harmless, although it might not feel that way. Many types of viruses can cause a common cold.", "https://www.mayoclinic.org/diseases-conditions/common-cold/symptoms-causes/syc-20351605");
INSERT INTO illnesses VALUES('Diabetes', "Diabetes mellitus refers to a group of diseases that affect how your body uses blood sugar (glucose). Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes.", "https://www.mayoclinic.org/diseases-conditions/diabetes/symptoms-causes/syc-20371444");
INSERT INTO illnesses VALUES('Covid-19', "Coronaviruses are a family of viruses that can cause illnesses such as the common cold, severe acute respiratory syndrome (SARS) and Middle East respiratory syndrome (MERS).", "https://www.mayoclinic.org/diseases-conditions/coronavirus/symptoms-causes/syc-20479963");

CREATE TABLE symptoms (
	ID integer NOT NULL PRIMARY KEY, -- symptom id
	Symptom_name varchar(20) NOT NULL -- name of the symptom
);

INSERT INTO symptoms VALUES(1,'Cough');
INSERT INTO symptoms VALUES(2,'Fatigue');
INSERT INTO symptoms VALUES(3,'Fever');
INSERT INTO symptoms VALUES(4,'Vomiting');
INSERT INTO symptoms VALUES(5,'Shortness Of Breath');
INSERT INTO symptoms VALUES(6,'Headache');
INSERT INTO symptoms VALUES(7,'Sore Throat');
INSERT INTO symptoms VALUES(8,'Diarrhea');
INSERT INTO symptoms VALUES(9,'Nausea');
INSERT INTO symptoms VALUES(10,'Congestion');
INSERT INTO symptoms VALUES(11,'Blurred Vision');
INSERT INTO symptoms VALUES(12,'Extreme Weight Loss');
INSERT INTO symptoms VALUES(13,'Extreme Thirst');

CREATE TABLE assigned_to (
	Doctor_id integer NOT NULL references doctors(ID),
	Patient_id integer NOT NULL references patients(ID),
	PRIMARY KEY (Doctor_id, Patient_id)
);

INSERT INTO assigned_to VALUES(1,1);
INSERT INTO assigned_to VALUES(1,3);
INSERT INTO assigned_to VALUES(2,2);
INSERT INTO assigned_to VALUES(2,3);
INSERT INTO assigned_to VALUES(4,5);
INSERT INTO assigned_to VALUES(6,1);
INSERT INTO assigned_to VALUES(4,1);
INSERT INTO assigned_to VALUES(4,6);

CREATE TABLE sick_from (
	Patient_id integer NOT NULL references patients(ID),
	Illness varchar(30) NOT NULL references illnesses(name),
	Status varchar(10), -- status of patient with regards to the illness (serious, recovered, stable)
	PRIMARY KEY (Patient_id, Illness)
);

INSERT INTO sick_from VALUES(1,'Common cold', 'Recovered');
INSERT INTO sick_from VALUES(1,'Diabetes', 'Stable');
INSERT INTO sick_from VALUES(1,'Covid-19', 'Serious');
INSERT INTO sick_from VALUES(2,'Diabtes', 'Serious');
INSERT INTO sick_from VALUES(5,'Covid-19', 'Recovered');
INSERT INTO sick_from VALUES(6,'Common cold', 'Recovered');
INSERT INTO sick_from VALUES(6,'Covid-19', 'Serious');

CREATE TABLE symptom_of (
	Illness varchar(30) NOT NULL references illnesses(name),
	Symptom integer NOT NULL references symptoms(ID),
	PRIMARY KEY (Illness, Symptom)
);

/*symptoms of common cold (cough, congestion, fever, headache, sore throat)*/
INSERT INTO symptom_of VALUES ('Common cold', 1);
INSERT INTO symptom_of VALUES ('Common cold', 10);
INSERT INTO symptom_of VALUES ('Common cold', 3);
INSERT INTO symptom_of VALUES ('Common cold', 6);
INSERT INTO symptom_of VALUES ('Common cold', 7);

/*symptoms of diabetes (fatigue, blurred vision, weight loss, extreme thirst)*/
INSERT INTO symptom_of VALUES ('Diabetes', 2);
INSERT INTO symptom_of VALUES ('Diabetes', 11);
INSERT INTO symptom_of VALUES ('Diabetes', 12);
INSERT INTO symptom_of VALUES ('Diabetes', 13);

/*symptoms of covid (fever, cough, fatigue, sore throat, headache, diarrhea, vomiting, nausea) 4678*/
INSERT INTO symptom_of VALUES ('Covid-19', 1);
INSERT INTO symptom_of VALUES ('Covid-19', 2);
INSERT INTO symptom_of VALUES ('Covid-19', 3);
INSERT INTO symptom_of VALUES ('Covid-19', 9);
INSERT INTO symptom_of VALUES ('Covid-19', 4);
INSERT INTO symptom_of VALUES ('Covid-19', 6);
INSERT INTO symptom_of VALUES ('Covid-19', 7);
INSERT INTO symptom_of VALUES ('Covid-19', 8);

CREATE TABLE is_experiencing (
 	Patient_id integer NOT NULL references patients(ID),
	Symptom integer NOT NULL references symptoms(ID),
	Severity integer, -- severity of the symptom on a scale of 1 to 10
	PRIMARY KEY (Patient_id, Symptom)
);

INSERT INTO is_experiencing VALUES(1,1,5);
INSERT INTO is_experiencing VALUES(1,10,3);
INSERT INTO is_experiencing VALUES(1,6,10);
INSERT INTO is_experiencing VALUES(1,3,4);
INSERT INTO is_experiencing VALUES(1,2,5);
INSERT INTO is_experiencing VALUES(1,11,2);
INSERT INTO is_experiencing VALUES(2,2,8);
INSERT INTO is_experiencing VALUES(2,11,9);
INSERT INTO is_experiencing VALUES(2,12,7);
INSERT INTO is_experiencing VALUES(3,1,3);
INSERT INTO is_experiencing VALUES(3,4,2);
INSERT INTO is_experiencing VALUES(3,8,6);
INSERT INTO is_experiencing VALUES(4,11,7);
INSERT INTO is_experiencing VALUES(5,4,4);
INSERT INTO is_experiencing VALUES(5,6,1);
INSERT INTO is_experiencing VALUES(5,7,6);
INSERT INTO is_experiencing VALUES(5,8,5);
INSERT INTO is_experiencing VALUES(6,10,9);
INSERT INTO is_experiencing VALUES(6,3,3);
INSERT INTO is_experiencing VALUES(6,6,5);
INSERT INTO is_experiencing VALUES(6,7,2);

COMMIT;
