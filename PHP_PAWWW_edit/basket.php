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
                Cena
            </th>
            <th>
                Data wygaśniecia
            </th>
            <th>
                Akcje
            </th>
            <?php
            ShowBasket($conn);
            ?>
        </tr>
    </table>
    <?php
    if (isset($_SESSION['count']) && $_SESSION['count'] != 0) {
        echo '<h1>Suma:' . $_SESSION['suma'] . ' </h1>';
        echo '<form action="basket.php" method="post">
        <input type="submit" name="sub" value="Kup">
        <input type="submit" name="sub" value="Usuń">
        </form>';
    } else {
        echo '<h1>Brak przedmiotów w koszyku<h1>
        <a href="shop.php">Wróć do sklepu</a>';
    } ?>

    <?php
    if (isset($_REQUEST['sub'])) {
        if ($_REQUEST['sub'] === 'Kup' && !empty($_SESSION['count'])) {
            // Zapytanie co zmienia ilość sztuk w magazynie
            echo '<h1>Transakcja zakończona</h1>';
            unset($_SESSION['count']);
            unset($_SESSION['suma']);
        }
        if ($_REQUEST['sub'] === 'Usuń') {
            session_unset();
            header('Location: basket.php');
        }
    }
    ?>
</body>

</html>