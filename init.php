<?php
require_once "functions.php";
$db = require_once "config/db.php";

$link = mysqli_connect($db["host"],$db["user"],$db["password"],$db["database"]);

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ["error" => $error]);
    $layout_content = include_template('layout.php', [
       "title"      => 'Yeticave - Главная',
       "is_auth"    => $is_auth,
       "user_name"  => $user_name,
       "content"    => $content,
       "categories" => []
    ]);
    print($layout_content);
    exit;
}

mysqli_set_charset($link,"utf8");
?>