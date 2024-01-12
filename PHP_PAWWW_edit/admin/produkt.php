<?php
error_reporting(E_ALL);
include '../cfg.php';
session_start();

if (empty($_REQUEST)) {
    ShowAll($conn);
}
if (isset($_REQUEST['chose'])) {
    if ($_REQUEST['chose'] === 'Dodaj') {
        return DodajProdukt($conn);
    }
    if ($_REQUEST['chose'] === 'Usun') {
        return UsunProdukt($conn);
    }
    if ($_REQUEST['chose'] === 'Edytuj') {
        return EdytujProdukt($conn);
    }
}
if (isset($_REQUEST['info'])) {
    if ($_REQUEST['info'] == 'add') {
        echo '<div>Udało się dodać produkt</div>';
        ShowAll($conn);
        exit();
    }
    if ($_REQUEST['info'] === 'del') {
        echo '<div>Udało się usunąć produkt</div>';
        ShowAll($conn);
        exit();
    }
    if ($_REQUEST['info'] === 'nie') {
        echo '<div>Nie dokonano zmiany</div>';
        ShowAll($conn);
        exit();
    }
    if ($_REQUEST['info'] === 'update') {
        echo '<div>Zmieniono</div>';
        ShowAll($conn);
        exit();
    } else {
        echo 'coś jest nie tak';
    }
}


function ShowAll($conn)
{
    $query = 'SELECT * FROM produkty';
    $result = mysqli_query($conn, $query);
    foreach ($result as  $value) {
        echo '<form class="show" method="post"> 
        id: ' . $value['id'] . ' nazwa: ' . $value['tytul'] . ' -> ilość sztuk: ' . $value['ilosc_sztuk'] . '
        <input type="hidden" name="item_id" value=' . $value['id'] . ' />
        <input type="hidden" name="item_name" value=' . $value['tytul'] . ' />
        <input type="submit" name="chose" value="Edytuj" />
        <input type="submit" name="chose" value="Usun" /></form>';
    }
    echo '<form><input type="submit" name="chose" value="Dodaj" />
    </form>';
}
function EdytujProdukt($conn)
{
    $query = 'SELECT id, tytul, opis, cena_netto, vat, ilosc_sztuk, kategoria, gabaryt FROM produkty WHERE id="' . $_REQUEST['item_id'] . '"';
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_array($result);
    $query2 = 'SELECT id, nazwa_kategorii FROM sklep ';
    $result2 = mysqli_query($conn, $query2);
    $item2 = mysqli_fetch_array($result2);
    $query4 = $query2 = 'SELECT nazwa_kategorii FROM sklep WHERE id=' . $item['kategoria'] . '';
    $item3 = mysqli_fetch_array(mysqli_query($conn, $query4));
    echo '<form class="change" method="post">
    <label >Tytuł</label>
    <input required type="text" name="title" value="' . $item['tytul'] . '" /><br>
    <label >Opis</label>
    <input required type="text" name="desc" value="' . $item['opis'] . '"/> <br>
    <label >Cena NETTO</label>
    <input required type="number" step="0.01" name="value_net" value="' . $item['cena_netto'] . '"><br>
    <label >VAT</label>
    <input required type="number"step="0.01" name="value_vat" value="' . $item['vat'] . '"> %<br>
    <label >Ilość sztuk</label>
    <input required type="number" name="number" value="' . $item['ilosc_sztuk'] . '"><br>
    
    <label >Gabaryt wcześniej: ' . $item['gabaryt'] . '</label><br>
    <input type="radio" name="size" value="mały"/> Mały<br>
    <input type="radio" name="size" value="średni"/>Średni<br>
    <input type="radio" name="size" value="duży"/>Duży<br>
    <label>Kategoria wcześniejsza: ' . $item3['nazwa_kategorii'] . '</label><br>';
    foreach ($result2 as $value) {
        echo '<input required type="radio" name="category" value="' . $value['id'] . '">' . $value['nazwa_kategorii'] . '</input><br>';
    }
    echo '<input type="submit" name="update" value="Zapisz">
    <input type="hidden" name="chose" value="Edytuj">
    <input type="hidden" name="id" value="' . $item['id'] . '">
    <br>
    <a href="produkt.php"> Back</a>
    </form>';
    if (isset($_REQUEST['update'])) {
        $query3 = 'UPDATE produkty SET
        tytul="' . $_REQUEST['title'] . '",
        opis="' . $_REQUEST['desc'] . '",
        cena_netto=' . $_REQUEST['value_net'] . ',
        vat="' . $_REQUEST['value_vat'] . '",
        ilosc_sztuk=' . $_REQUEST['number'] . ',
        kategoria=' . $_REQUEST['category'] . ',
        gabaryt="' . $_REQUEST['size'] . '"
         WHERE id=' . $_REQUEST['id'] . ' LIMIT 1';
        mysqli_query($conn, $query3);
        header('Location: produkt.php?info=update');
    }
}

function UsunProdukt($conn)
{
    echo '<form method="post" action=""> Czy na pewno chcesz usunąć  ' . $_REQUEST['item_name'] . '  ?
        <input type="hidden" name="id" value="' . $_REQUEST['item_id'] . '">
        <input type="hidden" name="chose" value="Usun">
        <input type="submit" name="answer" value="TAK">
        <input type="submit" name="answer" value="NIE">
        </form>
        <a href="produkt.php"> Back</a> ';

    if (isset($_REQUEST['answer'])) {
        if ($_REQUEST['answer'] === 'TAK') {
            $query = 'DELETE from produkty WHERE id=' . $_REQUEST['id'];
            mysqli_query($conn, $query);
            header("location: produkt.php?info=del");
            exit();
        }
        if ($_REQUEST['answer'] === 'NIE') {
            header('location:produkt.php?info=nie');
            exit();
        }
    }
}


function DodajProdukt($conn)
{
    $query = 'SELECT id, nazwa_kategorii FROM sklep';
    $result = mysqli_query($conn, $query);
    // <label for="photo">Zdjęcie</label>
    // <input type="text" name="photo"><br>

    echo $_REQUEST['chose'];
    echo '<form class="add" method="post">
        <label for="title">Tytuł</label>
        <input required type="text" name="title" /><br>
        <label for="desc">Opis</label>
        <input required type="text" name="desc" /> <br>
        <label for="value_net">Cena NETTO</label>
        <input required type="text" name="value_net"><br>
        <label for="value_vat">VAT</label>
        <input required type="text" name="value_vat"><br>
        <label for="number">Ilość sztuk</label>
        <input required type="text" name="number"><br>
        
        <label for="size">Gabaryt</label>
        <input required type="text" name="size"><br>

        <label for="category">Kategoria</label><br>';
    foreach ($result as $value) {
        echo '<input  required type="radio" id="category" value="' . $value['id'] . '">' . $value['nazwa_kategorii'] . '</input><br>';
    }
    echo '<input type="submit" name="add" value="Dodaj">
    <a href="produkt.php"> Back</a>
    </form>';
    if (isset($_REQUEST['add'])) {
        $query = 'INSERT INTO produkty (tytul, opis, cena_netto, vat, ilosc_sztuk, kategoria, gabaryt) VALUES ("' . $_POST['title'] . '","' . $_POST['desc'] . '","' . $_POST['value_net'] . '","' . $_POST['value_vat'] . '","' . $_POST['number'] . '", "' . $_POST['category'] . '", "' . $_POST['size'] . '")';
        mysqli_query($conn, $query);
        header('Location: produkt.php?info=add');
    }
}
