<?php
$is_auth = rand(0, 1);
$user_name = "Marya";
$user_avatar = "img/user.jpg";
$categories = [];
$content = "";
require_once "functions.php";
require_once "init.php";

if (!$content) {
    $sql = "SELECT `id`, `name` FROM categories";
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC );
}else {
    $error = mysqli_error($link);
    $content = include_template('error.php', ["error" => $error]);
}

$sql = "SELECT l.id, l.title, starting_price, img_path, name FROM lots l
INNER JOIN categories c
ON l.category_id = c.id
ORDER BY l.dt_add DESC";
$result = mysqli_query ($link, $sql);

if ($result){
    $lots = mysqli_fetch_all($result, MYSQLI_ASSOC );
}else{
    $error = mysqli_error($link);
    $content = include_template('error.php', ["error" => $error]);
}




if (!$content){
    $content = include_template('index.php', [
        "lots" => $lots,
        "categories" => $categories]);
}

$layout_content = include_template('layout.php', [
    "title" => 'Yeticave - Главная',
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "content" => $content,
    "categories" => $categories]);
print($layout_content);

?>
