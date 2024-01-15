<?php
include './cfg.php';
include 'add_to_basket.php';
function ShowBasket()
{
    if (isset($_SESSION['count']) && $_SESSION['count'] != 0) {
        for ($i = 1; $i <= $_SESSION['count']; $i++) {
            // wyświetlam wszystkie przedmioty z koszyka
            if (isset($_SESSION[$i . '_0'])) {
                echo '<tr>
                <th>' . $_SESSION[$i . '_2'] . '</th>
                <th>' . $_SESSION[$i . '_3'] . '</th>
                <th>' . $_SESSION[$i . '_4'] . '</th>
                <th>' . $_SESSION[$i . '_5'] . '</th>
                <th><form method="POST">
                <input type="hidden" name="id" value="' . $_SESSION[$i . '_0'] . '">
                <input type="submit" name="zmien" value="Edytuj">
                <input type="submit" name="usun" value="Usun">
                </form></th>
                </tr>';
            }
        }
    }
}
