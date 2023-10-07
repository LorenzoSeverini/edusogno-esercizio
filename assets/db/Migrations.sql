-- table for users
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

-- insert users
INSERT INTO users (name , surname, email, password) VALUES
    ('Marco', 'Rossi', 'ulysses200915@varen8.com', 'Edusogno123#'),
    ('Filippo', 'D’Amelio', 'qmonkey14@falixiao.com', 'Edusogno?123'),
    ('Gian Luca', 'Carta', 'mavbafpcmq@hitbase.net', 'EdusognoCiao1@'),
    ('Stella', 'De Grandis', 'dgipolga@edume.me', 'EdusognoGia1#');
    ('Admin', 'Admin', 'admin@esempio.com', 'Admin123#');

-- table for events
CREATE TABLE IF NOT EXISTS events (
id int NOT NULL AUTO_INCREMENT,
attendees text,
event_name varchar(255),
event_date datetime,
description text DEFAULT NULL,
admin_access tinyint(1) DEFAULT 1,
PRIMARY KEY (id)
);

-- insert events
INSERT INTO `events`(`attendees`, `event_name`, `event_date`, `description` `admin_access`) VALUES 
    ('ulysses200915@varen8.com', 'Test Edusogno 1', '2022-10-13 14:00', 'Descrizione Test tecnico numero 1!', 1), 
    ('dgipolga@edume.me', 'Test Edusogno 2', '2022-10-15 19:00', 'Descrizione Test tecnico numero 2!', 1), 
    ('dgipolga@edume.me', 'Test Edusogno 3', '2022-10-15 19:00', 'Descrizione Test tecnico numero 3!', 1);

-- table for admins_privileges
CREATE TABLE admin_privileges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- insert admins_privileges
INSERT INTO admin_privileges (user_id) VALUES
    (5),
