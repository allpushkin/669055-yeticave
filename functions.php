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

function fetch_data($link,$sql) {
    $result = mysqli_query ($link, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC );
}


function add ($link, $values){
    foreach ($arr as & $value)
        $value =mysqli_real_escape_string($link, $value);
    return implode(",", $value);

/* $new_title          = mysqli_real_escape_string($link, $title);
  $new_description    = mysqli_real_escape_string($link, $description);
  $new_starting_price = mysqli_real_escape_string($link, $starting_price);
  $new_date_end       = mysqli_real_escape_string($link, $date_end);
  $newd_bed_step      = mysqli_real_escape_string($link, $bed_step);
  $new_user_id        = mysqli_real_escape_string($link, $user_id);
  
  $sql = "INSERT INTO lots (`category_id`, `user_id`, `winner_id`, `dt_add`, `title`, `img_path`, `description`, `starting_price`, `expiration_dt`,`bet_step`)
   VALUES ('$category', '$new_user_id', '0', 'NOW()', '$new_title', '$image', '$new_description', '$new_starting_price', '$new_date_end','$newd_bed_step')"

  $res = mysqli_query($link, $sql);
  return $res;
}

?>
