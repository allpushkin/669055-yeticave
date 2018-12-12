<?php
require_once "functions.php";
require_once "init.php";

$is_auth     = rand(0, 1);
$user_name   = "Marya";
$user_avatar = "img/user.jpg";

$categories   = fetch_data($link, "SELECT `id`, `name` FROM categories");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lot'])) {
    $lot      = $_POST['lot'];
    $required = ["title", "description", "starting_price", "bed_step", "category", "date_end"];
    $dict     = [
    	"title"          =>'Название',
        "description"    => 'Описание', 
        "img_path"       => 'Изображение',
        "starting_price" =>'Начальная цена', 
        "bed_step"       => 'Шаг ставки',
        "category"       => 'Категория',
        "date_end"       => 'Дата окончания торгов'
    ];
    $errors = [];
    foreach ($required as $key) {
        if (empty($lot[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }
    
    if (isset($_FILES["lot_img"]["name"])) {
        $tmp_name  = $_FILES["lot_img"]["tmp_name"];
        $path      = $_FILES["lot_img"]["name"];
        $finfo     = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpg") {
            $errors["lot_img"] = 'Загрузите картинку в формате jpg/jpeg или png';
        } else {
            move_uploaded_file($tmp_name, "img/" . $path);
            $lot["lot_img"] = "img/" . $path;
        }
    } else {
        $errors["lot_img"] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
        $page_content = render_template("add-lot", [
            "lots"       => $lots,
            "errors"     => $errors,
            "dict"       => $dict,
            "categories" => $categories
        ]);
    } else {
    $page_content = include_template('wiew.php', ["categories" => $categories]);
    }
} else {
    $page_content = include_template("add-lot", [
        "categories" => $categories,
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
