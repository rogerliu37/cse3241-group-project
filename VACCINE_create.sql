CREATE TABLE if not exists Customer (
	Cell_num varchar(20) PRIMARY KEY,
	NumberOfDoses int, 
	Customer_name varchar(20),
	Manufacturer varchar(20),
	Status varchar(20),
	Age int,
	Dose1 int default 0, 
	Dose2 int default 0,
	Booster int default 0,
) engine=innodb;

CREATE TABLE if not exists VaccineBatch (
	TrackingNumber int not null PRIMARY KEY,
	Manufacturer varchar(255) not null,
	Quantity int not null,
	ExpirationDate date not null,
) engine=innodb;

CREATE TABLE if not exists Dose(
	Dose_tracking int not null PRIMARY KEY,
	Batch_num int not null,
) engine=innodb;


CREATE TABLE if not exists Administrator (
	Admini_Id varchar(25) not null PRIMARY KEY,
) engine=innodb;