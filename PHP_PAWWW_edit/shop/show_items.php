<?php
include './cfg.php';
include 'add_to_basket.php';
function ShowBasket($conn)
{
    if (isset($_SESSION['count']) && $_SESSION['count'] != 0) {
        for ($i = 1; $i <= $_SESSION['count']; $i++) {
            if ($_SESSION['id'] = $_SESSION[$i . '_1']) {
                echo 'jest juz taki produkt';
                break;
            }
            echo '<tr>
                <th>' . $_SESSION[$i . '_0'] . '</th>
                <th>' . $_SESSION[$i . '_2'] . '</th>
                <th>' . $_SESSION[$i . '_3'] . '</th>
                <th>' . $_SESSION[$i . '_4'] . '</th>
                <th>' . $_SESSION[$i . '_5'] . '</th>
                </tr>';
        }
    } else {
        echo 'Brak przedmiotów w koszyku';
    }

    if (isset($_REQUEST['chose']) && $_POST['chose'] === 'Usun') {
        header('Location: basket.php');
    }
}
