<?php
require './cfg.php';
require './shop/items.php';
include './shop/show_items.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
</head>

<body>
    <a href="shop.php">Cofnij</a>
    <table>
        <tr>
            <th>
                Produkt
            </th>
            <th>
                Ilość sztuk
            </th>
            <th>
                Cena za sztukę
            </th>
            <th>
                Data wygaśniecia
            </th>
            <th>
                Akcje
            </th>
            <?php
            ShowBasket();
            ?>
        </tr>
    </table>
    <?php
    if (isset($_SESSION['count']) && $_SESSION['count'] != 0) {
        echo '<h1>Suma: ' . $_SESSION['suma'] . 'zł </h1>';
        echo '<form action="basket.php" method="post">
        <input type="submit" name="sub" value="Kup">
        <input type="submit" name="sub" value="Usuń">
        </form>';
    } else {
        echo '<h1>Brak przedmiotów w koszyku<h1>
        <a href="shop.php">Wróć do sklepu</a>';
    } ?>

    <?php
    if (isset($_REQUEST['usun'])) {
        // usuń jeden przediot z koszyka
        // przepisz następne przedmioty w koszyku
        // zmniejsz sume o wartość przedmiotu
        // zmniejsz licznik o 1
        if ($_SESSION['suma'] > 0) {
            $_SESSION['suma'] -= $_SESSION[$_REQUEST['id'] . '_4'];
        }
        if ($_SESSION['suma'] < 0) {
            $_SESSION['suma'] = 0;
        }
        // for ($i = $_REQUEST['id']; $i < $_SESSION['count']; $i++) {
        //     $_SESSION[$i . '_0'] = $_SESSION[$i + 1 . '_0'];
        //     $_SESSION[$i . '_1'] = $_SESSION[$i + 1 . '_1'];
        //     $_SESSION[$i . '_2'] = $_SESSION[$i + 1 . '_2'];
        //     $_SESSION[$i . '_3'] = $_SESSION[$i + 1 . '_3'];
        //     $_SESSION[$i . '_4'] = $_SESSION[$i + 1 . '_4'];
        //     $_SESSION[$i . '_5'] = $_SESSION[$i + 1 . '_5'];
        //     $_SESSION[$i . '_6'] = $_SESSION[$i + 1 . '_6'];
        // }
        unset($_SESSION[$_SESSION['count'] . '_0']);
        unset($_SESSION[$_SESSION['count'] . '_1']);
        unset($_SESSION[$_SESSION['count'] . '_2']);
        unset($_SESSION[$_SESSION['count'] . '_3']);
        unset($_SESSION[$_SESSION['count'] . '_4']);
        unset($_SESSION[$_SESSION['count'] . '_5']);
        unset($_SESSION[$_SESSION['count'] . '_6']);
        $_SESSION['count']--;

        header('Location: basket.php');
    }

    if (isset($_REQUEST['zmien'])) {
        echo '<div class="edit">
        <form action="basket.php" method="post">
        <label for="number">Nazwa produktu ' . $_SESSION[$_REQUEST['id'] . '_2'] . '</label><br>
        <label for="number">Ilość sztuk na magazynie: ' . $_SESSION[$_REQUEST['id'] . '_6'] . '</label><br>
        <input type="number" name="number" min="1" max="' . $_SESSION[$_REQUEST['id'] . '_6'] . '" value="' . $_SESSION[$_REQUEST['id'] . '_3'] . '">
        <input type="hidden" name="id" value="' . $_REQUEST['id'] . '">
        <input type="submit" name="zmien" value="Zapisz">
        </form>
        </div>';
        if ($_REQUEST['zmien'] === 'Zapisz') {
            // Zapytanie co zmienia ilość sztuk w koszyku
            // Zapytanie co zmienia wartość sumy wszystkich produktów w koszyku

            $_SESSION['suma'] -= $_SESSION[$_REQUEST['id'] . '_4'];
            $_SESSION[$_REQUEST['id'] . '_4'] = $_SESSION[$_REQUEST['id'] . '_4'] / $_SESSION[$_REQUEST['id'] . '_3'] * intval($_REQUEST['number']);
            $_SESSION[$_REQUEST['id'] . '_3'] = intval($_REQUEST['number']);
            $_SESSION['suma'] += $_SESSION[$_REQUEST['id'] . '_4'];
            header('Location: basket.php');
        }
    }
    if (isset($_REQUEST['sub'])) {

        if ($_REQUEST['sub'] === 'Kup') {
            // alert w js o zakupe
            // zapytanie do bazy o zmniejszenie ilości sztuk w magazynie

            for ($i = 1; $i <= $_SESSION['count']; $i++) {
                $query = 'SELECT * FROM `produkty` WHERE `id` = ' . $_SESSION[$i . '_1'];
                $result = mysqli_query($conn, $query);
                $item = mysqli_fetch_array($result);
                $item['ilosc_sztuk'] -= $_SESSION[$i . '_3'];
                $query = 'UPDATE `produkty` SET `ilosc_sztuk` = ' . $item['ilosc_sztuk'] . ' WHERE `produkty`.`id` = ' . $_SESSION[$i . '_1'];
                $result = mysqli_query($conn, $query);
            }

            session_unset();
            header('Location: basket.php?buy=true');
        }

        if ($_REQUEST['sub'] === 'Usuń') {
            session_unset();
            header('Location: basket.php');
        }
    }
    if (isset($_REQUEST['buy'])) {
        echo '<script>alert("Zakupiono przedmioty")</script>';
    }
    ?>
</body>

</html>