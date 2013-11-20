drop database if exists team17_database;
create database team17_database;
use team17_database;

grant all on *.* to 'team17'@'localhost' identified by 'rhubarb';

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
		

insert into users(username, password, settings)
	values("tnygren", "drowssap", "100101"),
			("hlang", "password", "101101"),
			("abodnar", "superpassword", "000000"),
			("testUser", "testPassword", "011101");

insert into locations(zip_code)
	values(80401),(81637),(81631),(91201);

insert into reports(user_id, location_id, symptoms, points, note, date)
	values(1, 2, "111", 25, NULL, NOW()),
			(2, 1, "101", 50, "This cold kicked my butt!", NOW()),
			(3, 4, "000", 35, "Not too bad of a cold", NOW()),
			(4, 3, "000", 1, "Super bad cold, I had no symptoms", NOW());


		