<?php
require_once "functions.php";
require_once "init.php";

$categories = fetch_data($link, "SELECT `id`, `name` FROM categories");

session_start();

if (isset($_GET['id'])) {
    $lot_id = mysqli_real_escape_string($link, $_GET['id']);
} else {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
}


$lots = fetch_data($link, "SELECT l.id, l.title, starting_price, img_path, description, price, name as category_name FROM lots l
LEFT JOIN bets b
ON l.id = b.lot_id
INNER JOIN categories c
ON l.category_id = c.id
WHERE l.id = $lot_id");

if(!isset($lots[0]['id'])) {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
} else {
    $page_content = include_template('lot.php', [
        "lot"        => $lots[0],
        "categories" => $categories
]);
}


$layout_content = include_template('layout.php', [
    "title"      => 'Yeticave - Главная',
    "content"    => $page_content,
    "categories" => $categories
]);
print($layout_content);

?>