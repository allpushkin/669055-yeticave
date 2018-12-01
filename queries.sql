 /*Заполнение таблицы категорий*/
INSERT INTO categories (`name`) 
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');


/*Заполнение таблицы пользователей*/
INSERT INTO users (`dt_add`, `email`, `name`, `password`, `avatar_path`, `contact`,`lot_id`,`bet_id`)
VALUES ('2018-11-27 11:00:00', 'Bulavka@gmail.com', 'Дарья', '123qazwsx', 'img/avatar.jpg', 'т. +7(977)776-97-12, г. Москва', '0', '0'),
('2018-11-28 12:13:16', 'vivaldi@mail.ru', 'Кира', '123456789q', 'img/avatar.jpg', '0', '1', '2'),
('2018-11-27 21:25:00', 'Nikita@gmail.com', 'Nikita', '0', '1z2x3c2v', 'город Москва', '3', '1' );*/


/*Заполнение таблицы лотов*/
INSERT INTO lots (`category_id`, `user_id`, `winner_id`, `dt_add`, `title`, `img_path`, `description`, `starting_price`, `expiration_dt`,`bet_step`)
VALUES ('1', '1', '0', '2018-11-29 12:00:00', '2014 Rossignol District Snowboard', 'img/lot-1.jpg', 'ОПИСАНИЕ', '10999', '2018-11-30 00:00:00','0'),
('1', '2', '1', '2018-11-29 13:00:00', 'DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', 'ОПИСАНИЕ','159999', '2018-11-30 00:00:00', '5000'),
('2', '3', '1', '2018-11-29 14:00:00', 'Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', 'ОПИСАНИЕ','8000', '2018-11-30 00:00:00', '0'),
('3', '1', '2', '2018-11-29 15:00:00', 'Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', 'ОПИСАНИЕ', '10999', '2018-11-30 00:00:00', '0'),
('4', '2', '0', '2018-11-29 16:00:00', 'Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', 'ОПИСАНИЕ','7500', '2018-11-30 00:00:00', '0'),
('6', '3', '0','2018-11-29 17:00:00', 'Маска Oakley Canopy', 'img/lot-6.jpg', 'ОПИСАНИЕ','5400', '2018-11-30 00:00:00', '600');


/*Заполнение таблицы ставок*/
INSERT INTO bets (`dt_add`, `price`, `user_id`, `lot_id`)
VALUES('2018-12-29 17:00:00', '19000','1','1'),
('2018-12-29 18:00:00', '12000','2','2'),
('2018-12-29 19:00:00', '13000','3','1'); 

/*Получить все категории*/
SELECT*FROM categories;

/*Получить самые новые, открытые лоты*/
SELECT l.id, l.title, starting_price, img_path, price, name FROM lots l
LEFT JOIN bets b
ON l.id = b.lot_id
INNER JOIN categories c
ON l.category_id = c.id 
WHERE winner_id = 0
ORDER BY l.dt_add DESC ;

/*Показать лот по его id, получить название категории, к которой принадлежит лот*/
SELECT l.id, l.title, name FROM lots l
INNER JOIN categories c
ON l.category_id = c.id
WHERE l.id = '3';

/*Обновить название лота по его идентификатору*/
UPDATE lots SET `title` = 'Абсолютно новое крепления Union Contact Pro 2015 года размер L/XL '
WHERE id = '3'; 

/*Получить список самых свежих ставок для лота по его идентификатору
SELECT b.id, title, b.dt_add, price FROM bets b
LEFT JOIN lots l
ON b.lot_id = l.id
WHERE lot_id = '1'
ORDER BY `dt_add` DESC;*/

