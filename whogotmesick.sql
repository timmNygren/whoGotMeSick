use team17_database;

drop table if exists users, reports, locations;

create table users (
		userID int unsigned not null AUTO_INCREMENT primary key,
		username char(30) not null,
		password char(50) not null,
		settings blob not null);

create table reports (
		id int unsigned not null AUTO_INCREMENT primary key,
		user_id int not null,
		location_id int not null,
		symptoms blob not null,
		date timestamp not null,
		note char(256));

create table locations (
		id int unsigned not null AUTO_INCREMENT primary key,
		zip_code int unsigned not null);
		
		