<?php
include './cfg.php';
include 'add_to_basket.php';
function ShowBasket($conn)
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
                <input type="submit" name="sub" value="Edytuj">
                <input type="submit" name="sub" value="Usuń">
                </form></th>
                </tr>';
            }
        }
    }

    if (isset($_REQUEST['chose'])) {
        if ($_POST['chose'] === 'Edytuj') {
            // wyświetlam formularz edycji
            // zapisuje dane do sesji
            // zapisuje dane do tablicy
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                for ($i = 1; $i <= $_SESSION['count']; $i++) {
                    if (isset($_SESSION[$i . '_0']) && $_SESSION[$i . '_0'] === $id) {
                        echo '<form method="POST">
                        <input type="hidden" name="id" value="' . $_SESSION[$i . '_0'] . '">
                        <input type="number" name="number" value="' . $_SESSION[$i . '_3'] . '">
                        <input type="submit" name="chose" value="Zapisz">
                        </form>';
                    }
                }
            }
        }
        if ($_POST['chose'] === 'Usun') {
            header('Location: basket.php');
        }
    }
}
