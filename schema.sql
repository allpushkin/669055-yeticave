CREATE DATABASE `yeticave`
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE `yeticave`;

CREATE TABLE `categories`
( 
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`name` char(255) NOT NULL, 
	PRIMARY KEY (`id`), 
	UNIQUE INDEX c_name(name) 
);


CREATE TABLE `lots` 
( 
	`id`				 	int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`category_id`	 	int(11) unsigned NOT NULL, 
	`user_id`		 	int(11) unsigned NOT NULL, 
	`winner_id`	 		int(11) unsigned NOT NULL, 
	`dt_add`			 	timestamp default current_timestamp NOT NULL, 
	`title`			 	char(255) NOT NULL, 
	`img_path`			char(255) NOT NULL, 
	`description`	 	text DEFAULT NULL, 
	`starting_price` 	int(11) unsigned NOT NULL, 
	`expiration_dt` datetime NOT NULL, 
	`bet_step`			int(11) unsigned NOT NULL,
	PRIMARY KEY(`id`),
	INDEX l_titile(title),
	INDEX l_user_id(user_id),
	INDEX l_winner_id(winner_id),
	INDEX l_category_id(category_id)
);


CREATE TABLE `bets` 
(  `id`				int(11) unsigned NOT NULL AUTO_INCREMENT,
	`dt_add` 		timestamp default current_timestamp NOT NULL, 
	`price` 			int(11) unsigned NOT NULL, 
	`user_id` 		int(11) unsigned NOT NULL, 
	`lot_id` 		int(11) unsigned NOT NULL, 
	PRIMARY KEY(`id`),
	INDEX b_dt_add(dt_add),
	INDEX b_user_id(user_id),
	INDEX b_lot_id(lot_id)
);


CREATE TABLE `users` 
( 
	`id`				 int(11) unsigned NOT NULL AUTO_INCREMENT, 
	`dt_add` 		timestamp default current_timestamp NOT NULL,
	`lot_id`			 int(11) unsigned, 
	`bet_id`		    int(11) unsigned, 
	`email`			 char(255) NOT NULL, 
	`name`			 char(255) NOT NULL, 
	`password`		 char(64) NOT NULL, 
	`avatar_path`	 char(255) NOT NULL, 
	`contact`		 text DEFAULT NULL, 
	PRIMARY KEY (`id`), 
	UNIQUE INDEX un_email(`email`),
	INDEX u_lot_id(lot_id),
	INDEX u_bet_id(bet_id)

	 
);
