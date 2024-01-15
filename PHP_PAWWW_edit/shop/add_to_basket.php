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
        $_SESSION['suma'] = 0;
    } else {

        $_SESSION['count']++;
    }
    // sprawdzenie czy istnieje tablica koszyka 
    // czy jest tam już przedmiot o tym id
    // jeśli tak to dodaj do ilości sztuk
    // jeśli nie to dodaj nowy przedmiot do koszyka
    // zapisz dane do sesji
    // zapisz dane do tablicy
    // jeśli ilość sztuk jest większa niż ilość w magazynie to wyświetl komunikat
    // jeśli nie to dodaj do koszyka
    // zapisz dane do sesji

    for ($i = 1; $i <= $_SESSION['count']; $i++) {
        if (isset($_SESSION[$i . '_1']) && $_SESSION[$i . '_1'] === $_REQUEST['id']) {
            if ($_SESSION[$i . '_3'] + intval($_REQUEST['number']) > $item['ilosc_sztuk']) {
                echo 'Można kupić maksymalnie ' . $item['ilosc_sztuk'] . ' sztuk';
                $_SESSION[$i . '_3'] = $item['ilosc_sztuk'];
                return;
            }
            $_SESSION[$i . '_4'] += $cost;
            $_SESSION['suma'] += $cost;
            $_SESSION[$i . '_3'] += intval($_REQUEST['number']);
            echo '<script>alert("Dodano do koszyka")</script>';

            return;
        }
    }

    $nr = $_SESSION['count'];
    $prod[$nr]['id'] = $item['id'];
    $prod[$nr]['name'] = $item['tytul'];
    $prod[$nr]['number'] = intval($_REQUEST['number']);
    $prod[$nr]['cost'] = $cost;
    $prod[$nr]['data'] = $item['data_wygasniecia'];


    // numeracja dla 2-wymiarowej tablicy
    $nr_0 = $nr . '_0';
    $nr_1 = $nr . '_1';
    $nr_2 = $nr . '_2';
    $nr_3 = $nr . '_3';
    $nr_4 = $nr . '_4';
    $nr_5 = $nr . '_5';
    $nr_6 = $nr . '_6';

    $_SESSION[$nr_0] = $nr;
    $_SESSION[$nr_1] = $prod[$nr]['id'];
    $_SESSION[$nr_2] = $prod[$nr]['name'];
    $_SESSION[$nr_3] = intval($prod[$nr]['number']);
    $_SESSION[$nr_4] = $prod[$nr]['cost'];
    $_SESSION[$nr_5] = $prod[$nr]['data'];
    $_SESSION[$nr_6] = $item['ilosc_sztuk'];
    $_SESSION['id'] = $_REQUEST['id'];
    $_SESSION['suma'] += $cost;
    // wyświetl allert o dodaniu do koszyka
    echo '<script>alert("Dodano do koszyka")</script>';
}
