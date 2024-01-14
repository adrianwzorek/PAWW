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
                LP
            </th>
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
            <?php
            ShowBasket($conn);
            ?>
        </tr>
    </table>
    <form action="" method="post">
        <input type="submit" name='sub' value="Kup">
        <input type="submit" name="sub" value="Usuń">
    </form>
    <?php
    if (isset($_REQUEST['sub'])) {
        if ($_REQUEST['sub'] === 'Kup' && !empty($_SESSION['count'])) {
            // Zapytanie co zmienia ilość wsztuk w magazynie
        }
        if ($_REQUEST['sub'] === 'Usuń') {
            session_unset();
            header('Location: basket.php');
        }
    }
    ?>
</body>

</html>