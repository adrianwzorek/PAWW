<?php
include './shop/items.php';
include './cfg.php';
include './shop/add_to_basket.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep</title>
</head>

<body>
    <a href="basket.php" class="basket">
        <img src="./css/Pictures/shopping-basket.png" alt="basket" style="width: 50px;">
    </a>
    <table>
        <tr>
            <th>
                Nazwa
            </th>
            <th>
                Opis
            </th>
            <th>
                Cena
            </th>
            <th>
                ilość sztuk
            </th>
            <th>
                data wygaśnięcia
            </th>
            <th>
                Akcje
            </th>
        </tr>
        <?php
        ShowItem($conn);
        ?>
    </table>
    <?php
    if (isset($_REQUEST['sub'])) {
        // funkcja dodawania do koszyka
        Add($conn);
    }
    ?>
    <form action="exit.php" method="post">
        <input type="submit" value="Wyjscie">
    </form>

</body>

</html>