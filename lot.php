<?php
require_once "functions.php";
require_once "init.php";
$error         = "";
$user_id       = "";
$expiration_dt = "";
$categories    = fetch_data($link, "SELECT `id`, `name` FROM categories");

session_start();

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
}

if (isset($_GET['id'])) {
    $lot_id = mysqli_real_escape_string($link, $_GET['id']);
} else {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
}

$lots = fetch_data($link, "SELECT l.id, l.title, starting_price, img_path, bet_step, description, expiration_dt,price, name as category_name FROM lots l
LEFT JOIN bets b
ON l.id = b.lot_id
INNER JOIN categories c
ON l.category_id = c.id
WHERE l.id = $lot_id");
$lot = $lots[0];

if (strtotime($lot['expiration_dt']) < strtotime('now')) {
    $expiration_dt = true;
}

if ($lot['price']) {
    $current_price = $lot['price'];
} else {
    $current_price = $lot['starting_price'];
}

$min_bet = $current_price + $lot['bet_step'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bet   = $_POST['price'];
     if (empty($bet)) {
        $error = 'Вы не указали ставку';
    }
     if (intval($bet) < $min_bet) {
        $error = 'Вы указали ставку меньше указанной минимальной ставки';
    }
     if (!is_numeric($bet)) {
        $error = 'Укажите целое положительное число';
    }
     if (empty($error)) {
        $sql  = "INSERT INTO bets (`dt_add`, `price`, `user_id`, `lot_id`)
                 VALUES (NOW(), ?, ?, ?);";
        $bet_data =[
            $bet,
            $user_id,
            $lot_id
        ];
        $stmt = db_get_prepare_stmt($link, $sql,$bet_data);
        $res  = mysqli_stmt_execute($stmt);
        header("Refresh:0");
        if (!$res) {
            $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
}

$bets = fetch_data($link, "SELECT b.id, title, b.dt_add,name, price FROM bets b
LEFT JOIN lots l
ON l.id = b.lot_id
INNER JOIN users u
ON l.user_id = u.id
WHERE b.lot_id = $lot_id
ORDER BY `dt_add` DESC;");

if(!isset($lot['id'])) {
    http_response_code(404);
    $page_content = include_template('404.php', ['categories' => $categories]);
} else {
    $page_content = include_template('lot.php', [
        "expiration_dt"  => $expiration_dt,
        "min_bet"        => $min_bet,
        "lot"            => $lot,
        "categories"     => $categories,
        "error"          => $error,
        "user_id"        => $user_id,
        "bets"           => $bets
]);
}

$layout_content = include_template('layout.php', [
    "title"      => 'Yeticave - Главная',
    "content"    => $page_content,
    "categories" => $categories
]);
print($layout_content);

?>