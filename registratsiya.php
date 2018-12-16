<?php
require_once "functions.php";
require_once "init.php";
$is_auth      = rand(0, 1);
$user_name    = "Marya";
$user_avatar  = "img/user.jpg";
$categories   = fetch_data($link, "SELECT `id`, `name` FROM categories");

$page_content = include_template("sign-up.php", ["categories" => $categories,]);

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user'])) {
    $user      = $_POST['user'];
    $required  = ["email","password","name","message"];
    $errors    = [];
    foreach ($required as $key) {
        if (empty($user[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Данный email некорректен';
    } else {
        if (!count($errors)) {
        $email = mysqli_real_escape_string($link, $user['email']);
        $sql   = "SELECT id FROM users WHERE email = '$email'";
        $res   = mysqli_query($link, $sql);
            if ($res) {
                if (mysqli_num_rows($res) > 0) {
                    $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
                }
            }
        }
    }

    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['tmp_name'])) {
        $tmp_name  = $_FILES["avatar"]["tmp_name"];
        $file_name = uniqid() . '.jpg';
        $finfo     = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/png" && $file_type !== "image/jpg")  {
            $errors["avatar"] = 'Загрузите картинку в формате jpg/jpeg или png';
        } else {
            if (!count($errors)) {
                move_uploaded_file($tmp_name, 'img/' . $file_name);
                $user["avatar"] = 'img/' . $file_name;
            }
        }
    } else {
        $user['avatar'] = 'NULL';
    }

    if (count($errors)) {
    $page_content = include_template("sign-up.php", [
        "user"       => $user,
        "errors"     => $errors,
        "categories" => $categories
    ]);
    } else {
        $password      = password_hash($user['password'], PASSWORD_DEFAULT);
        $newUsers_data = [
            $user['email'],
            $user['name'],
            $password,
            $user['avatar'],
            $user['message']
        ];
        $sql  = "INSERT INTO users (`dt_add`, `email`, `name`, `password`, `avatar_path`, `contact`,`lot_id`,`bet_id`)
              VALUES (NOW(),?, ?, ?, ?, ?, 0, 0);";
        $stmt = db_get_prepare_stmt($link, $sql,$newUsers_data);
        $res  = mysqli_stmt_execute($stmt);
        if ($res) {
            $lot_id = mysqli_insert_id($link);
            header("Location:login.php");
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