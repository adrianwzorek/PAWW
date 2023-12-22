<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../cfg.php';
if (empty($_REQUEST)) {
    ShowAll($conn);
}
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "DELETE") {
        return DeleteOne($conn);
    }
    if ($_REQUEST['action'] == 'DODAJ') {
        return Add($conn);
    }
    if ($_REQUEST['action'] == 'EDIT') {
        echo 'Edytuje';
    } else {
        echo 'brak możliwości';
    }
}
if (isset($_REQUEST['add'])) {
    if ($_REQUEST['add'] == 'main') {
        echo '<div class="info">Dodano nową Kategorię główną<div>';
        ShowAll($conn);
    }
    if ($_REQUEST['add'] == 'sub') {
        echo '<div class="info">Dodano nową Podkategorię<div>';
        ShowAll($conn);
    }
}

if (isset($_REQUEST['del'])) {
    if ($_REQUEST['del'] == 'tak') {
        echo 'Właśnie usunięto kategorię ';
        return ShowAll($conn);
    }
    if ($_REQUEST['del'] == 'nie') {
        echo 'Nie usunięto kategorii ';
        return ShowAll($conn);
    }
}


function Add($conn)
{
    echo '<form method="post">
    <h1>Jaką kategorię dodajesz?</h1>
    <input type="submit" name="chose" value="glowna"/>
    <input type="submit" name="chose" value="podkategoria"/>
    </form>';
    $name = '';
    if (isset($_REQUEST['chose'])) {
        if ($_REQUEST['chose'] == 'glowna') {
            echo '<form method="post">
            <label for="name">Podaj nazwę dla głownej:</label>
            <input type="text" name="name"/>
            <input type="hidden" name="chose" value="main"/>
            <input type="submit" name="add" value="Dodaj"/>';
        }
        if ($_REQUEST['chose'] == 'podkategoria') {
            $query = 'SELECT * FROM sklep';
            $result = mysqli_query($conn, $query);
            echo '<h1>Wybierz do której kategorii chcesz dodać:</h1>
                <form method="post">';
            foreach ($result as $row) {
                if ($row['matka'] == 0) {
                    echo '<input required type="radio" name="item" value="' . $row['id'] . '">' . $row['nazwa_kategorii'] . '</input> </br>';
                }
            }
            echo ' </br>
            <label for="name">Podaj nazwę:</label>
        <input type="text" name="name"/>
        <input type="submit" name="add" value="Dodaj"/>
                </form>';
        }
    }
    if (isset($_REQUEST['add']) && isset($_REQUEST['name'])) {
        if (isset($_REQUEST['chose']) && $_REQUEST['add'] == 'Dodaj') {
            if ($_REQUEST['chose'] == 'main') {
                // Dodawanie głównej strony
                $query = 'INSERT INTO sklep (nazwa_kategorii) VALUES ("' . $_REQUEST['name'] . '")';
                mysqli_query($conn, $query);
                header("Location: sklep.php?add=main");
                // Działa poprawnie
            }
        }
    }
    if (isset($_REQUEST['add']) && isset($_REQUEST['item'])) {
        $query = 'INSERT INTO sklep (nazwa_kategorii, matka) VALUES ("' . $_REQUEST['name'] . '","' . $_REQUEST['item'] . '")';
        mysqli_query($conn, $query);
        header("Location: sklep.php?add=sub");
    }
}

function Edit($conn)
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == 'EDIT') {
            echo '<div class="container">
            <form method="post">
            <input type="text" required name="' . $_REQUEST['itemName'] . '" /> </br>
            <label>Czy jest to kategoria główna?</label> </br>
            <input type="checkbox" name="kategoria" value="tak"  /> TAK 
            <input type="checkbox" name="kategoria" value="nie"  /> NIE </br>
            <input type="submit" name="sub" value="Dodaj"/>
            </form>
            <a href="sklep.php">Cofnij</a>
            </div>';
        }
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
        <input type="submit" name="action" value="EDIT"/>
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
    echo '<form class="popup" method="post">Chcesz usunąć ' . $_REQUEST['itemName'] . ' ?
        <input type="submit" name="val" value="TAK"/>
        <input type="submit" name="val" value="NIE"/>
        </form>';
    if (isset($_REQUEST['val'])) {
        if ($_REQUEST['val'] == "TAK") {
            $query = 'DELETE FROM sklep WHERE id=' . $_REQUEST['itemId'] . '';
            mysqli_query($conn, $query);
            header("Location: sklep.php?del=tak");
        } else {
            echo 'Nie usunięto strony';
            header("Location: sklep.php?del=nie");
        }
    }
}
