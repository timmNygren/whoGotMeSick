create database team17_database;
use team17_database;

grant all on *.* to 'team17'@'localhost' identified by 'rhubarb';

drop table if exists users, reports;

create table users (
		id int unsigned not null AUTO_INCREMENT primary key,
		username char(30) not null,
		password char(50) not null,
		settings blob not null,
		date_joined timestamp not null);

create table reports (
		id int unsigned not null AUTO_INCREMENT primary key,
		user_id int not null,
		zip_code int not null,
		symptoms char(9) not null,
		note text,
		report_date DATE not null);