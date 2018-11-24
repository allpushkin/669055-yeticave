<?php
require("functions.php");
$is_auth = rand(0, 1);
$user_name = "Marya";
$user_avatar = "img/user.jpg";
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$ads = [
    [ 
        "title" => "2014 Rossignol District Snowboard",
        "category" => "Доски и лыжи",
        "price" => "10999",
        "img_url" => "img/lot-1.jpg"
    ],
    [ 
        "title" => "DC Ply Mens 2016/2017 Snowboard",
        "category" => "Доски и лыжи",
        "price" => "159999",
        "img_url" => "img/lot-2.jpg"
    ],
    [ 
        "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => "Крепления",
        "price" => "8000",
        "img_url" => "img/lot-3.jpg"
    ],
    [ 
        "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => "Крепления",
        "price" => "8000",
        "img_url" => "img/lot-3.jpg"
    ],
    [ 
        "title" => "Куртка для сноуборда DC Mutiny Charocal",
        "category" => "Одежда",
        "price" => "7500",
        "img_url" => "img/lot-5.jpg"
    ],
    [ 
        "title" => "Маска Oakley Canopy",
        "category" => "Разное",
        "price" => "5400",
        "img_url" => "img/lot-6.jpg"
    ]
] ;

$page_content = include_template('index.php', [
    "ads" => $ads,
    "categories" => $categories]);

$layout_content = include_template('layout.php', [
    "title" => 'Yeticave - Главная',
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "content" => $page_content,
    "categories" => $categories]);
print($layout_content);
?>
