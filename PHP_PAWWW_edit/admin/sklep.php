<?php
include '../cfg.php';

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "DELETE") {
        return DeleteOne($conn);
    }
    if ($_REQUEST['action'] == 'DODAJ') {
        return Add($conn);
    } else {
        echo 'brak możliwości';
    }
}
if (isset($_REQUEST['add']) && $_REQUEST['add'] == 'tak') {
    echo 'Dodano podstrone';
    ShowAll($conn);
} else {
    ShowAll($conn);
}


function Add($conn)
{

    echo '<div class="container">
            <form method="post">
            <label>Podaj nazwę kategorii </label> </br>
            <input type="text" required name="nazwa" /> </br>
            <label>Czy jest to kategoria główna?</label> </br>
            <input type="checkbox" name="kategoria" value="tak"  /> TAK 
            <input type="checkbox" name="kategoria" value="nie"  /> NIE </br>
            <input type="submit" name="sub" value="Dodaj"/>
            </form>
            <a href="sklep.php">Cofnij</a>
            </div>';


    /****************************************************** */
    // Dodawnie na razie tylko i wyłądznie kategorii głównych
    // Brak przejścia do podkategorii -> zrobić to w odpoowiednim czasie
    /****************************************************** */
    if (isset($_REQUEST['sub']) && $_REQUEST['sub'] == 'Dodaj') {
        $query = 'INSERT INTO `sklep`(`nazwa_kategorii`,`matka`) VALUES ("' . $_REQUEST['nazwa'] . '","' . $_REQUEST['kategoria'] . '")';
        mysqli_query($conn, $query);
        echo '<div class="info">Dodano nową strone<div>';
        header("Location: sklep.php?add=tak");
    }
}



function ShowAll($conn)
{
    $query = 'SELECT * FROM `sklep`';
    $result = mysqli_query($conn, $query);
    echo '<div class="title"> Wszystkie kategorie</div> <br>';
    while ($item = mysqli_fetch_array($result)) {
        echo '<form class="item" method="get">
        ' . $item['id'] . ' -> ' . $item['nazwa_kategorii'] . '
        <input type="submit" name="action" value="DELETE"/>
        <input type="hidden" name="itemId" value="' . $item['id'] . '"/>
        <input type="hidden" name="itemName" value="' . $item['nazwa_kategorii'] . '"/>
        </form>';
    }
    echo '<form method="get">
    <input type="submit" name="action" value="DODAJ">
    </form>';
}

function DeleteOne($conn)
{
    $form = '<form class="popup" method="post">Chcesz usunąć ' . $_REQUEST['itemName'] . ' ?
        <input type="submit" name="val" value="TAK"/>
        <input type="submit" name="val" value="NIE"/>
        </form>';
    echo $form;
    if (isset($_REQUEST['val'])) {

        if ($_REQUEST['val'] == "TAK") {
            echo 'Właśnie usunięto stronę ' . $_REQUEST['itemName'];
            $query = 'DELETE FROM sklep WHERE id=' . $_REQUEST['itemId'] . '';
            mysqli_query($conn, $query);
            unset($form);
            ShowAll($conn);
        } else {
            echo 'Nie usunięto strony';
            ShowAll($conn);
        }
    }
}
