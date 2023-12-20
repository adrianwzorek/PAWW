<?php
include '../cfg.php';
Add($conn);
ShowAll($conn);
DeleteOne($conn);
















function Add($conn)
{
    $option = '<div class="container">
    <form method="post">
    <label>Podaj nazwę kategorii </label> </br>
    <input type="text" required name="nazwa" /> </br>
    <label>Czy jest to kategoria główna?</label> </br>
    <input type="checkbox" name="kategoria" value="tak"  /> TAK 
    <input type="checkbox" name="kategoria" value="tak"  /> NIE </br>
    <input type="submit" name="sub" value="Dodaj"/>
    </form>
    </div>';
    /****************************************************** */
    // Dodawnie na razie tylko i wyłądznie kategorii głównych
    // Brak przejścia do podkategorii -> zrobić to w odpoowiednim czasie
    // Dodaj 2x to samo -> zmienić to
    /****************************************************** */
    if (isset($_POST['sub']) && isset($_POST['nazwa'])) {
        if (!isset($_POST['kategoria'])) $_POST['kategoria'] = 'nie';
        // echo 'wyniki Post:</br>
        // nazwa = ' . $_POST['nazwa'] . ' </br>
        // czy główna? = ' . $_POST['kategoria'] . '
        // ';
        $query = 'INSERT INTO `sklep`(`nazwa_kategorii`,`matka`) VALUES ("' . $_POST['nazwa'] . '","' . $_POST['kategoria'] . '")';
        mysqli_query($conn, $query);
    }

    echo $option;
}

function ShowAll($conn)
{
    $query = 'SELECT * FROM `sklep`';
    $result = mysqli_query($conn, $query);

    while ($item = mysqli_fetch_array($result)) {
        echo '<form class="item" method="post">
        ' . $item['id'] . ' -> ' . $item['nazwa_kategorii'] . '
        <input type="submit" name="usun" value="USUŃ"/>
        <input type="hidden" name="itemId" value="' . $item['id'] . '"/>
        <input type="hidden" name="itemName" value="' . $item['nazwa_kategorii'] . '"/>
        </form>';
    }
}

function DeleteOne($conn)
{
    /********************************* */
    // Usuwa ale zostawia informacje przy następnej operacji
    // Błąd w 88 lini
    /********************************* */


    if (isset($_POST['usun'])) {
        $id = $_POST['itemId'];
        echo '<form class="popup" method="get">Chcesz usunąć ' . $_POST['itemName'] . ' ?
            <input type="submit" name="val" value="TAK"/>
            <input type="submit" name="val" value="NIE"/>
            </form>';
    }
    if (empty($_GET['val']) && empty($id)) {
        return;
    } else {

        if (isset($_GET) && $_GET['val'] == "TAK") {
            echo '<div class="info yes">Usunięto pomyślnie stronę</div>';
            $query = 'DELETE FROM sklep WHERE id="' . $id . '" LIMIT 1';
            mysqli_query($conn, $query);
        }
        if ($_GET['val'] == "NIE") {
            echo '<div class="info no"> Nie usunięto strony</div>';
            unset($_GET['val']);
        }
    }
}
