<?php
include '../cfg.php';
session_start();
if ($_SESSION['login'] == $login && $_SESSION['haslo'] == $haslo) {

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
            return Edit($conn);
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
    if (isset($_REQUEST['edit'])) {
        if ($_REQUEST['edit'] == 'tak') {
            echo 'Zmieniono nazwę';
            return ShowAll($conn);
        }
    }
} else {
    header('location: admin.php');
}


function Add($conn)
{
    /******************************************* */
    // Dodaje do 3 podkategorii włącznie
    /******************************************* */

    echo '<form method="post">
    <a href="sklep.php">Cofnij</a>
    <h1>Jaką kategorię dodajesz?</h1>
    <input type="submit" name="chose" value="glowna"/>
    <input type="submit" name="chose" value="podkategoria"/>
    </form>';

    if (isset($_REQUEST['chose'])) {
        if ($_REQUEST['chose'] == 'glowna') {
            echo '<form method="post">
            <label for="name">Podaj nazwę dla głownej:</label>
            <input type="text" name="name"/>
            <input type="hidden" name="chose" value="main"/>
            <input type="submit" name="add" value="Dodaj"/> <br>
            </form>';
        }
        if ($_REQUEST['chose'] == 'podkategoria') {
            $query = 'SELECT * FROM sklep';
            $result1 = mysqli_query($conn, $query);

            echo '<h1>Wybierz do której kategorii chcesz dodać:</h1>
                <form method="post">';
            foreach ($result1 as $row) {
                if ($row['matka'] == 0) {
                    $query = 'SELECT * FROM sklep WHERE matka=' . $row['id'] . '';
                    $result2 = mysqli_query($conn, $query);
                    echo '<input required type="radio" name="item" value="' . $row['id'] . '"><b>' . $row['nazwa_kategorii'] . ' [Kategoria glowna]</b></input> </br>';
                    foreach ($result2 as $secrow) {
                        echo '<input required type="radio" name="item" value="' . $secrow['id'] . '">' . $secrow['nazwa_kategorii'] . ' [Podkategoria -> ' . $row['nazwa_kategorii'] . '] </input> </br>';
                        $query = 'SELECT * FROM sklep WHERE matka=' . $secrow['id'] . '';
                        $result3 = mysqli_query($conn, $query);
                        foreach ($result3 as $thirdrow) {
                            echo '<input required type="radio" name="item" value="' . $thirdrow['id'] . '">' . $thirdrow['nazwa_kategorii'] . ' [Podkategoria -> ' . $secrow['nazwa_kategorii'] . '] </input> </br>';
                        }
                    }
                }
            }
            echo ' </br>
                <label>Podaj nazwę:</label>
            <input type="text" name="name"/>
            <input type="submit" name="add" value="Dodaj"/> <br>
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
    /************************** */
    // Edycja nazwy oraz głównej kategorii
    /************************** */

    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == 'EDIT') {
            $query = 'SELECT * FROM sklep';
            $result = mysqli_query($conn, $query);
            echo '<div class="container">
            <h1>Wybierz kategorie i nadaj nazwę: </h1>
            <form method="post">';
            foreach ($result as $item) {
                if ($item['matka'] == 0) {
                    echo '<input type="radio" required name="item" value="' . $item['id'] . '" > ' . $item['nazwa_kategorii'] . '</input><br>';
                }
            }
            echo '
            <input type="text" required  name="name"  value="' . $_REQUEST['itemName'] . '" /> </br>
            <input type="hidden" name="itemId" value="' . $_REQUEST['itemId'] . '"/>
            <input type="submit" name="sub" value="Dodaj"/>
            <a href="sklep.php">Cofnij</a>
            </form>
            </div>';
        }
    }
    if (isset($_REQUEST['sub'])) {
        if (isset($_REQUEST['name']) && isset($_REQUEST['itemId']) && isset($_REQUEST['item'])) {
            $query = 'UPDATE sklep SET `nazwa_kategorii`="' . $_REQUEST['name'] . '", `matka`="' . $_REQUEST['item'] . '" WHERE id="' . $_REQUEST['itemId'] . '" ';
            mysqli_query($conn, $query);
            header("Location: sklep.php?edit=tak");
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
        ' . $item['id'] . ' -> ' . $item['nazwa_kategorii'] . ' [matka : 
        ' . $item['matka'] . ']<br>
        <input type="submit" name="action" value="DELETE"/>
        <input type="submit" name="action" value="EDIT"/>
        <input type="hidden" name="itemId" value="' . $item['id'] . '"/>
        <input type="hidden" name="itemName" value="' . $item['nazwa_kategorii'] . '"/>
        </form>';
    }
    echo '<form method="get">
    <input type="submit" name="action" value="DODAJ">
    </form>
    <a href="podstrony.php">Zarządzaj Podstronami</a><br>
    <a href="produkt.php"> Zarządzaj Produktem</a><br>
    <a href="logout.php"> Wyloguj</a>
    ';
}

function DeleteOne($conn)
{
    /****************************** */
    // Usuwa kategorię i pozsotałe podkategorie danej kategorii
    // Usuwa kaskadowo
    /****************************** */
    echo '<form class="popup" method="post">Chcesz usunąć ' . $_REQUEST['itemName'] . ' ?
        <input type="submit" name="val" value="TAK"/>
        <input type="submit" name="val" value="NIE"/>
        </form>';
    if (isset($_REQUEST['val'])) {
        if ($_REQUEST['val'] == "TAK") {
            $query = 'DELETE FROM sklep WHERE id=' . $_REQUEST['itemId'] . '';
            mysqli_query($conn, $query);
            $query = 'DELETE FROM sklep WHERE matka=' . $_REQUEST['itemId'] . '';
            mysqli_query($conn, $query);
            header("Location: sklep.php?del=tak");
        } else {
            header("Location: sklep.php?del=nie");
        }
    }
}
