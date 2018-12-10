 <?php
function include_template($name, $data) {
    $name = 'templates/' . $name;
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
    $now = date_create("now");
    $tomorrow = date_create("tomorrow");

    $diff = date_diff($now, $tomorrow);
    return date_interval_format($diff,"%H:%I");
} 

function fetch_data($link,$sql) {
    $result = mysqli_query ($link, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC );
}

 function fetch_data_lot($link, $lot_id, $sql) {
    $result = mysqli_query ($link, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC );
}

?>
