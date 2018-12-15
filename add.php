<?php
require_once "functions.php";
require_once "init.php";
$is_auth      = rand(0, 1);
$user_name    = "Marya";
$user_avatar  = "img/user.jpg";

$categories   = fetch_data($link, "SELECT `id`, `name` FROM categories");

$page_content = include_template("add-lot.php", [
        "categories" => $categories,
    ]);
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

     if (!is_numeric($lot['starting_price']) || $lot['starting_price'] <= 0) {
        $errors['starting_price'] = 'В поле должно быть целое положительное число';
    }
    
    if (!is_numeric($lot['bed_step']) || $lot['bed_step'] <= 0) {
        $errors['bed_step'] = 'В поле  должно быть целое положительное число';
    }

    if ($lot['category'] == 'Выберите категорию') {
        $errors['category'] = 'Нужно выбрать категорию';
    }

    if (strtotime($lot['date_end']) <= strtotime('now')) {
        $errors['date_end'] = 'Дата завершения торгов должна быть больше текущей даты хотя бы на 1 день';
    }
    
    if (isset($_FILES['img_path']['name']) && !empty($_FILES['img_path']['tmp_name'])) {
        $tmp_name  = $_FILES["img_path"]["tmp_name"];
        $path      = $_FILES["img_path"]["name"];
        $finfo     = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/png" && $file_type !== "image/jpg")  {
            $errors["img_path"] = 'Загрузите картинку в формате jpg/jpeg или png';
        } else {
            
            move_uploaded_file($tmp_name, "img/" . $path);
            $lot["img_path"] = "img/" . $path;
        }
    } else {
        $errors["img_path"] = 'Вы не загрузили файл';
    }
    
    if (count($errors)) {
        $page_content = include_template("add-lot.php", [
            "lot"       => $lot,
            "errors"     => $errors,
            "dict"       => $dict,
            "categories" => $categories
        ]);
    } else {
        $sql = "INSERT INTO lots (`category_id`, `user_id`, `winner_id`, `dt_add`, `title`, `img_path`, `description`,`starting_price`, `expiration_dt`,`bet_step`)
            VALUES (?, 1, 0, NOW(), ?, ?, ?, ?, ?, ?);";
        $stmt = db_get_prepare_stmt($link, $sql,[$lot['category'], $lot['title'], $lot['img_path'], $lot['description'], $lot['starting_price'], $lot['date_end'],$lot['bed_step']]);
        $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $lot_id = mysqli_insert_id($link);
            header('Location: lot.php?id=' . $lot_id);
            exit();
        } else {
            $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
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
