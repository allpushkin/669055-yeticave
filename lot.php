<?php
require_once "functions.php";
require_once "init.php";

$is_auth     = rand(0, 1);
$user_name   = "Marya";
$user_avatar = "img/user.jpg";

$categories = fetch_data($link, "SELECT `id`, `name` FROM categories");

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];
} else {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
}

$lot = fetch_data($link, "SELECT l.id, l.title, starting_price, img_path, description, price, name as category_name FROM lots l
LEFT JOIN bets b
ON l.id = b.lot_id
INNER JOIN categories c
ON l.category_id = c.id
WHERE l.id = $lot_id ");

if(!isset($lot[0]['id'])) {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
} else {
    $page_content = include_template('lot.php', [
        "lot"        => $lot[0],
        "categories" => $categories
]);
}


$layout_content = include_template('layout.php', [
    "title"      => 'Yeticave - Главная',
    "is_auth"    => $is_auth,
    "user_name"  => $user_name,
    "content"    => $page_content,
    "categories" => $categories
]);
print($layout_content);

?>