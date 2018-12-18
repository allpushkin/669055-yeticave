<?php
function include_template($name, $data) {
    $name   = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


function format_sum($sum){
    $sum = ceil($sum);
    if ($sum >= 1000) {
        $sum = number_format($sum, 0, ' ', ' ');
    }
    $sum .= "<b class=\"rub\">₽</b>";

    return $sum;
    }

function esc ($arg){
    return htmlspecialchars($arg);
}


function lot_time_left() { 
    $now      = date_create("now");
    $tomorrow = date_create("tomorrow");

    $diff     = date_diff($now, $tomorrow);
    return date_interval_format($diff,"%H:%I");
} 



function lotTimeLeft($expiration_dt) {
    $time_left = strtotime($expiration_dt) - time();
    $hours     = floor($time_left / 3600);
    $minutes   = floor(($time_left % 3600) / 60);
    if ($minutes < 10) {
        $minutes = 0 . $minutes;
    }
    if ($hours < 10) {
        $hours = 0 . $hours;
    }
    $time_left = $hours . ':' . $minutes;
    return $time_left;
}



function fetch_data($link,$sql) {
    $result = mysqli_query ($link, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC );
}


function add ($link, $lot){
    foreach ($lot as & $add_lot) {
        $add_lot =mysqli_real_escape_string($link, $add_lot);
    }
    return implode("', '", $lot);
}


function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}


function isFormError($errors, $key) {
  return isset($errors[$key]) ? true : false;
}


function time_passed($date) {
    $interval = strtotime('now') - strtotime($date);
    if ($interval > 86400) {
        return date('d.m.Y в H:i', strtotime($date));
    }
    if ($interval > 3600 && $interval < 86400) {
        return floor($interval / 3600) . ' часов назад';
    }
    if ($interval > 60 && $interval < 3600) {
        return floor($interval / 60) . ' минут назад';
    }
    else {
        return 'меньше минуты назад';
    }
}



?>
