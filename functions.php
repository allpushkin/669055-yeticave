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


function lot_left() { 
    $time = strtotime('tomorrow') - time(); 
    $hours = floor($time / 3600); 
    $minutes = floor(($time % 3600) / 60); 
    if ($minutes < 10) { 
       $minutes = (0 . $minutes); 
    } 
    if  ($hours < 10) { 
       $hours = (0 . $hours); 
    } 
    $time_left = ($hours . ':' . $minutes); 
    return $time_left; 
} 

?>
