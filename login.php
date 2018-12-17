<?php
require_once "functions.php";
require_once "init.php";

$categories   = fetch_data($link, "SELECT `id`, `name` FROM categories");

$page_content = include_template("login.php", ["categories" => $categories,]);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $login    = $_POST['login'];
    $errors   = [];
    $required = ["email", "password"];
    foreach ($required as $key) {
        if (isset($login[$key])) {
            if (empty($login[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }
    }

    if (!empty($login['email'])) {
        $email = mysqli_real_escape_string($link, $login['email']);
        $sql   = "SELECT * FROM users WHERE email = '$email'";
        $res   = mysqli_query($link, $sql);
        $user  = mysqli_fetch_array($res, MYSQLI_ASSOC);
        if (!$user) {
            $errors['email'] = 'Пользователь с таким email не найден';
        }
    }

    if (empty($errors) && $user) {
        if (password_verify($login['password'], $user['password'])) {
           $_SESSION['user']   = $user;
        } else {
           $errors['password'] = 'Вы ввели неверный пароль';
        }
    }

    if (count($errors)) {
        $page_content = include_template('login.php', [
            'login'  => $login,
            'errors' => $errors
        ]);
    } else {
        header("Location: /index.php");
    }

} else {
    $page_content = isset($_SESSION['user']) ? include_template('index.php',
        ['username' => $_SESSION['user']['name']]) : include_template('login.php', []);
}

$layout_content = include_template('layout.php', [
   "title"      => 'Yeticave - Вход на сайт',
   "content"    => $page_content,
   "categories" => $categories
]);
print($layout_content);

?>
