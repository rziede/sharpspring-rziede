CREATE DATABASE `c1`;

USE `c1`;

CREATE TABLE `users` (
  `id` bigint(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	CREATE TABLE `user_notes` (
	  `id` bigint(64) NOT NULL AUTO_INCREMENT,
	  `user_id` bigint(64) NOT NULL,
	  `note_id` bigint(64) NOT NULL,
	  PRIMARY KEY (`id`),
	  FOREIGN KEY(`user_id`)
	    REFERENCES users(`id`)
	    ON DELETE CASCADE,
	  FOREIGN KEY(`note_id`)
	    REFERENCES notes(`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notes` (
  `id` bigint(64) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(64) NOT NULL,
  `title` VARCHAR(120) NOT NULL,
  `body` TEXT,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`)
    REFERENCES users(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
