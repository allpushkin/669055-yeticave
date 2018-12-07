<?php
require_once "functions.php";
require_once "init.php";

$is_auth = rand(0, 1);
$user_name = "Marya";
$user_avatar = "img/user.jpg";

$categories = frtch_data($link, "SELECT `id`, `name` FROM categories");

$lots = frtch_data($link,"SELECT l.id, l.title, starting_price, img_path, name FROM lots l
INNER JOIN categories c
ON l.category_id = c.id
ORDER BY l.dt_add DESC");

$page_content = include_template('index.php', [
    "lots" => $lots,
    "categories" => $categories
]);

$layout_content = include_template('layout.php', [
    "title" => 'Yeticave - Главная',
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "content" => $page_content,
    "categories" => $categories
]);
print($layout_content);

?>
