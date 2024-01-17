<?php
error_reporting(E_ALL);
include '../cfg.php';
session_start();
if ($_SESSION['login'] == $login && $_SESSION['haslo'] == $haslo) {

    if (empty($_REQUEST)) {
        CheckItem($conn);
        ShowAll($conn);
    }
    if (isset($_REQUEST['chose'])) {
        if ($_REQUEST['chose'] === 'Zdjecie') {
            return ShowImageById($conn);
        }
        if ($_REQUEST['chose'] === 'Dodaj') {
            return DodajProdukt($conn);
        }
        if ($_REQUEST['chose'] === 'Usun') {
            return UsunProdukt($conn);
        }
        if ($_REQUEST['chose'] === 'Edytuj') {
            return EdytujProdukt($conn);
        }
        if ($_REQUEST['chose'] === 'Help') {
            return CheckItem($conn);
        }
    }
    if (isset($_REQUEST['info'])) {
        CheckItem($conn);
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
} else {
    header("Location: admin.php");
}

function ShowImageById($conn)
{
    $query = 'SELECT zdjecie FROM produkty WHERE id="' . $_REQUEST['item_id'] . '"';
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_array($result);
    var_dump($_REQUEST);
    if ($item) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($item['zdjecie']) . '"/>';
    } else {
        echo 'Nie znaleziono zdjęcia dla produktu o id: ' . $_REQUEST['item_id'];
    }
}

function CheckItem($conn)
{
    $query = 'SELECT * FROM produkty';
    $result = mysqli_query($conn, $query);
    foreach ($result as $value) {
        if ($value['ilosc_sztuk'] === '0' | $value['data_wygasniecia'] === date('Y-m-d')) {
            $query = 'UPDATE produkty SET status = "0" WHERE id=' . $value['id'];
            mysqli_query($conn, $query);
        }
    }
}

function ShowAll($conn)
{
    $query = 'SELECT * FROM produkty';
    $result = mysqli_query($conn, $query);
    while ($value = mysqli_fetch_array($result)) {
        if ($value['ilosc_sztuk'] == "0" | $value['data_wygasniecia'] === date('Y-m-d')) {
            echo '<form class="show" method="post" enctype="multipart/form-data">';
            echo '<div class="item">Produkt: ' . $value['tytul'] . ' jest już niedostępny</div>
            <input type="hidden" name="item_id" value=' . $value['id'] . ' />
            <input type="hidden" name="item_name" value=' . $value['tytul'] . ' />
            <input type="submit" name="chose" value="Usun"><br>';
        } else {
            echo '<form class="show" method="post" enctype="multipart/form-data">';

            echo '<div class="item">id: ' . $value['id'] . ' nazwa: ' . $value['tytul'] . ' -> ilość sztuk: ' . $value['ilosc_sztuk'] . '</div>
            <input type="hidden" name="item_id" value=' . $value['id'] . ' />
            <input type="hidden" name="item_name" value=' . $value['tytul'] . ' />
            <input type="submit" name="chose" value="Zdjecie" />
            <input type="submit" name="chose" value="Edytuj" />
            <input type="submit" name="chose" value="Usun" /><br>
            </form>';
            var_dump($value['id']);
        }
    }
    echo '<br><form method="post"><input type="submit" name="chose" value="Dodaj" />
    </form>
    <a href="podstrony.php"> Zarządzaj Podstronami</a><br>
    <a href="sklep.php"> Zarządzaj Sklepem</a><br>
    <a href="logout.php"> Wyloguj</a>
    ';
}
function EdytujProdukt($conn)
{
    $query = 'SELECT id, tytul, opis, data_wygasniecia, cena_netto, vat, ilosc_sztuk, kategoria, gabaryt, zdjecie FROM produkty WHERE id="' . $_REQUEST['item_id'] . '"';
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_array($result);
    $query2 = 'SELECT id, nazwa_kategorii, matka FROM sklep ';
    $result2 = mysqli_query($conn, $query2);
    $query3 = 'SELECT nazwa_kategorii FROM sklep WHERE id="' . $item['kategoria'] . '"';
    $result3 = mysqli_query($conn, $query3);
    $item3 = mysqli_fetch_array($result3);
    echo '<form class="change" method="post" enctype="multipart/form-data">
    <label >Tytuł</label>
    <input required type="text" name="title" value="' . $item['tytul'] . '" /><br>
    <label >Opis</label>
    <input required type="text" name="desc" value="' . $item['opis'] . '"/> <br>
    <label >Cena NETTO</label>
    <input required type="number" step="0.01" name="value_net" value="' . $item['cena_netto'] . '">zł<br>
    <label >VAT</label>
    <input required type="number"step="0.01" name="value_vat" value="' . $item['vat'] . '"> %<br>
    <label >Ilość sztuk</label>
    <input required type="number" name="number" value="' . $item['ilosc_sztuk'] . '"><br>
    <label>Do kiedy aktywna</label>
    <input required type="date" name="date_to" value="' . $item['data_wygasniecia'] . '"><br>
    <input type="file" name="file" accept=".jpg, .jpeg, .png, .svg" value=""><br>

    <label >Gabaryt wcześniej: ' . $item['gabaryt'] . '</label><br>
    <input required type="radio" name="size" value="Mały"/> Mały<br>
    <input required type="radio" name="size" value="Średni"/>Średni<br>
    <input required type="radio" name="size" value="Duży"/>Duży<br>
    <label>Kategoria wcześniejsza: ' . $item3['nazwa_kategorii'] . '</label><br>';
    foreach ($result2 as $value) {
        echo '<input required type="radio" name="category" value="' . $value['id'] . '">' . $value['nazwa_kategorii'] . '</input><br>';
    }
    echo '<input type="submit" name="update" value="Zapisz">
    <input type="hidden" name="date_mod" value=' . date("Y-m-d") . '>
    <input type="hidden" name="chose" value="Edytuj">
    <input type="hidden" name="id" value="' . $item['id'] . '">
    <br>
    <a href="produkt.php"> Back</a>
    </form>';
    if (isset($_REQUEST['update'])) {

        $query3 = 'UPDATE produkty SET
        tytul="' . $_REQUEST['title'] . '",
        opis="' . $_REQUEST['desc'] . '",
        data_modyfikacji="' . $_POST['date_mod'] . '",
        data_wygasniecia="' . $_POST['date_to'] . '",
        cena_netto=' . $_REQUEST['value_net'] . ',
        vat="' . $_REQUEST['value_vat'] . '",
        ilosc_sztuk=' . $_REQUEST['number'] . ',
        kategoria=' . $_REQUEST['category'] . ',
        gabaryt="' . $_REQUEST['size'] . '",
        zdjecie="' . addslashes(file_get_contents($_FILES['file']['tmp_name'])) . '"
        WHERE id=' . $_REQUEST['id'] . ' LIMIT 1';
        mysqli_query($conn, $query3);
        header('Location: produkt.php?info=update');
    }
}
// zdjecie = "' . addslashes(file_get_contents($_FILES['file']['file_name'])) . '"
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


    echo '<form class="add" method="post" enctype="multipart/form-data">
        <label >Tytuł</label>
        <input required type="text" name="title" /><br>
        <label >Opis</label>
        <input required type="text" name="desc" /> <br>
        <label >Cena NETTO</label>
        <input required type="number" step="0.01" name="value_net">zł<br>
        <label >VAT</label>
        <input required type="number" step="0.01" name="value_vat">%<br>
        <label>Ilość sztuk</label>
        <input required type="text" name="number"><br>
        <label>Do kiedy aktywna</label>
        <input required type="date" name="date_to"><br>  
        <input type="file" name="file" accept=".jpg, .jpeg, .png, .svg" value=""><br>
        <label>Gabaryt</label><br>
        <input type="hidden" name="chose" value="Dodaj">
    <input required type="radio" name="size" value="mały"/> Mały<br>
    <input required type="radio" name="size" value="średni"/>Średni<br>
    <input required type="radio" name="size" value="duży"/>Duży<br>

        <label>Kategoria</label><br>';
    foreach ($result as $value) {
        echo '<input  required type="radio" name="category" value="' . $value['id'] . '">' . $value['nazwa_kategorii'] . '</input><br>';
    }
    echo '<input type="submit" name="add" value="Dodaj">
    <input type="hidden" name="date_add" value=' . date("Y-m-d") . '>
    <a href="produkt.php"> Back</a>
    </form>';
    if (isset($_REQUEST['add'])) {
        $query = 'INSERT INTO produkty
        (tytul, opis, data_utworzenia, data_wygasniecia, cena_netto, vat, ilosc_sztuk, kategoria, gabaryt, zdjecie)VALUES 
        ("' . $_POST['title'] . '","' . $_POST['desc'] . '", "' . $_POST['date_add'] . '" , "' . $_POST['date_to'] . '" ,"' . $_POST['value_net'] . '",
        "' . $_POST['value_vat'] . '","' . $_POST['number'] . '", "' . $_POST['category'] . '",
        "' . $_POST['size'] . '", "' . addslashes(file_get_contents($_FILES['file']['tmp_name'])) . '")';
        mysqli_query($conn, $query);
        header('Location: produkt.php?info=add');
    }
}
