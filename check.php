<?php
    $r = htmlspecialchars($_GET['r']);
    $x = htmlspecialchars($_GET['x']);
    $y = htmlspecialchars($_GET['y']);

    function validate($x, $y, $r) {
        if (is_numeric($r) && in_array($r, array(1,1.5,2,2.5,3)) && is_numeric($x) && in_array($x, array(-4, -3, -2, -1, 0, 1, 2, 3, 4)) && is_numeric($y) && $y >= -3 && $y <= 3) {
            return true;
        } else return false;
    }

    function check($x, $y, $r)
    {
        if (($x >= 0 && $x <= $r && $y >= 0 && $y <= ($r / 2)) ||
            ($x <= 0 && $y >= 0 && $y <= $x + $r / 2) ||
            (($x * $x + $y * $y) <= $r * $r / 4 && $x >= 0 && $y <= 0)) {
            return "<span style='color: green'>Попал</span>";
        } return "<span style='color: red'>Мимо</span>";
    }

    session_start();

    if (!validate($x, $y, $r)) {
//        http_response_code(400);
        ?>
        <div class="nigger">
            <img src="img/servernigger.jpg" alt="хачу серверсайд валидацию" style="width: 100%;
    height: 100%;">
        </div>
<?php
        return;
    }

    date_default_timezone_set('Europe/Moscow');
    $currentTime = date("H:i:s");
    $start = microtime(true);

    $res = check ($x, $y, $r);

    $time = microtime(true) - $start;

    $result = array($x, $y, $r, $res, $currentTime, $time);

    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = array();
    }

    array_push($_SESSION['history'], $result);

    include "table.php";

?>
