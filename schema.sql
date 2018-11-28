CREATE TABLE `stavka` 
( 
	`dt_add` 		timestamp default current_timestamp NOT NULL, 
	`id`				int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`price` 			int(11) unsigned NOT NULL, 
	`user_id` 		int(11) unsigned NOT NULL, 
	`lot_id` 		int(11) unsigned NOT NULL, 

	PRIMARY KEY(`id`) 
);

CREATE TABLE `users` 
( 
	`id`				 int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`lot_id`			 text, 
	`stavka_id`		 text, 
	`email`			 char(255) NOT NULL, 
	`name`			 char(255) NOT NULL, 
	`password`		 char(64) NOT NULL, 
	`avatar`			 char(255) NOT NULL, 
	`kontakt`		 text DEFAULT NULL, 
	PRIMARY KEY (`id`), 
	UNIQUE KEY (`email`) 
);

CREATE TABLE `lot` 
( 
	`id`				 	int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`category_id`	 	int(11) unsigned NOT NULL, 
	`user_id`		 	int(11) unsigned NOT NULL, 
	`user_winner`	 	int(11) unsigned NOT NULL, 
	`dt_add`			 	timestamp default current_timestamp NOT NULL, 
	`title`			 	char(255) NOT NULL, 
	`path`			 	char(255) NOT NULL, 
	`description`	 	text DEFAULT NULL, 
	`starting_price` 	int(11) unsigned NOT NULL, 
	`expiration date` datetime NOT NULL, 
	`bet_step`			int(11) unsigned NOT NULL,
	PRIMARY KEY(`id`) 
);

CREATE TABLE `categories`
( 
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`name` char(255) NOT NULL, 
	PRIMARY KEY (`id`), 
	UNIQUE KEY `name` (`name`) 
);