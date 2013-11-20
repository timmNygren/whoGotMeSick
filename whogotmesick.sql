create database if not exists team17_database;
use team17_database;

drop table if exists users, reports, locations;

create table users (
		id int unsigned not null AUTO_INCREMENT primary key,
		username char(30) not null,
		password char(50) not null,
		settings blob not null);

create table reports (
		id int unsigned not null AUTO_INCREMENT primary key,
		user_id int not null,
		location_id int not null,
		symptoms blob not null,
		points int not null,
		note char(255),
		date timestamp not null);

create table locations (
		id int unsigned not null AUTO_INCREMENT primary key,
		zip_code int unsigned not null);
		
		