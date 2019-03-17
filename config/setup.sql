CREATE DATABASE IF NOT EXISTS CAMAGRU DEFAULT CHARACTER SET utf8;

USE CAMAGRU;

CREATE TABLE IF NOT EXISTS users (
		id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		username VARCHAR(15) NOT NULL,
		mail VARCHAR(30) NOT NULL,
		password VARCHAR(150) NOT NULL
);

CREATE TABLE IF NOT EXISTS images(
		id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		userid VARCHAR(15) NOT NULL,
		path VARCHAR(150) NOT NULL
);

CREATE TABLE IF NOT EXISTS comments (
		id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		userid INT(11) NOT NULL,
		imgid INT(11) NOT NULL,
		contents VARCHAR(250) NOT NULL,
		date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		KEY (`userid`),
		KEY (`imgid`),
		CONSTRAINT `commentary_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
		CONSTRAINT `commentary_img` FOREIGN KEY (`imgid`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS likes (
		id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		userid INT(11) NOT NULL,
		imgid INT(11) NOT NULL,
		KEY (`userid`),
		KEY (`imgid`),
		CONSTRAINT `likes_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
		CONSTRAINT `likes_img` FOREIGN KEY (`imgid`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);