CREATE TABLE IF NOT EXISTS users (
id int NOT NULL AUTO_INCREMENT,
name varchar(45),
surname varchar(45),
email varchar(255),
password varchar(255),
reset_token_hash varchar(64) NULL DEFAULT NULL,
reset_token_expires_at datetime NULL DEFAULT NULL,
Unique ('reset_token_hash');
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS events (
id int NOT NULL AUTO_INCREMENT,
attendees text,
event_name varchar(255),
event_date datetime,
PRIMARY KEY (id)
);

INSERT INTO `events`(`attendees`, `event_name`, `event_date`) VALUES ('ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 1', '2022-10-13 14:00'), ('dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00'), ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00');