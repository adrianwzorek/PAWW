<?php
include './cfg.php';
session_start();
function Add($conn)
{

    $query = "SELECT * FROM produkty WHERE id=" . $_REQUEST['id'];
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_array($result);
    $cost = intval($_REQUEST['number']) * (floatval($item['cena_netto']) + (floatval($item['cena_netto']) * (floatval($item['vat']) / 100)));
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 1;
    } else {
        $_SESSION['count']++;
    }
    $nr = $_SESSION['count'];
    $prod[$nr]['id'] = $item['id'];
    $prod[$nr]['name'] = $item['tytul'];
    $prod[$nr]['number'] = $_REQUEST['number'];
    $prod[$nr]['cost'] = $cost;
    $prod[$nr]['data'] = $item['data_wygasniecia'];

    // numeracja dla 2-wymiarowej tablicy
    $nr_0 = $nr . '_0';
    $nr_1 = $nr . '_1';
    $nr_2 = $nr . '_2';
    $nr_3 = $nr . '_3';
    $nr_4 = $nr . '_4';
    $nr_5 = $nr . '_5';

    $_SESSION[$nr_0] = $nr;
    $_SESSION[$nr_1] = $prod[$nr]['id'];
    $_SESSION[$nr_2] = $prod[$nr]['name'];
    $_SESSION[$nr_3] = $prod[$nr]['number'];
    $_SESSION[$nr_4] = $prod[$nr]['cost'];
    $_SESSION[$nr_5] = $prod[$nr]['data'];
    $_SESSION['id'] = $_REQUEST['id'];
}
