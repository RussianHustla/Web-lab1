<?php
    $r = htmlspecialchars($_GET['r']);
    $x = htmlspecialchars($_GET['x']);
    $y = htmlspecialchars($_GET['y']);

    function check($x, $y, $r)
    {
        if (($x >= 0 && $x <= $r && $y >= 0 && $y <= ($r / 2)) ||
            ($x <= 0 && $y >= 0 && $y <= $x + $r / 2) ||
            (($x * $x + $y * $y) <= $r * $r / 4 && $x >= 0 && $y <= 0)) {
            return "<span style='color: green'>Попал</span>";
        } return "<span style='color: red'>Мимо</span>";
    }

    session_start();

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
