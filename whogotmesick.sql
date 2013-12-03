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
		date timestamp not null);

insert into users(username, password, settings, date_joined)
	values("tnygren", "drowssap", "00", NOW()),
			("hlang", "password", "00", NOW()),
			("abodnar", "superpassword", "00", NOW()),
			("testUser", "testPassword", "00", NOW());

insert into reports(user_id, zip_code, symptoms, note, date)
	values(1, 81637, "000000000", NULL, NOW()),
		  (2, 80401, "111111111", "This cold kicked my butt!", NOW()),
		  (3, 92014, "000000000", "Not too bad of a cold", NOW()),
		  (4, 81631, "000000001", "Super bad cold, I had no symptoms", NOW());
