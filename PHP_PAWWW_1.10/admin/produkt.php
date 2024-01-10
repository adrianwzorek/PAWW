<?php
error_reporting(E_ALL);
include '../cfg.php';
session_start();

if (empty($_REQUEST)) {
    return ShowAll($conn);
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

?>


<?php


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
        <input type="submit" name="chose" value="Usun" /><br>
        <input type="submit" name="chose" value="Dodaj" />
    </form>';
    }
}
function EdytujProdukt($conn)
{
    echo 'edytuj';
}

function UsunProdukt($conn)
{
    $id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $name = mysqli_real_escape_string($conn, $_POST['item_name']);
    echo 'Czy na pewno chcesz usunąć ' . $name . '?
        <form class="question" method="get">
        <input type="hidden" name="item_id" value=' . $id . ' />
        <input type="submit" name="yes" value="TAK" />
        <input type="submit" name="no" value="NIE" />
        </form>';

    if (isset($_REQUEST['yes'])) {
        echo 'jest';
        // if ($_POST['answer'] === 'TAK') {
        //     $query = 'DELETE from produkty WHERE id=' . $id;
        //     mysqli_query($conn, $query);
        //     header("location: produkt.php?del=tak");
        //     exit();
        // }
        // if ($_POST['answer'] === 'NIE') {
        //     header('location:produkt.php?del=nie');
        //     exit();
        // }
    }
}

function DodajProdukt($conn)
{
    // <label for="category">Kategoria</label>
    // <input type="text" name="category"><br>
    // <label for="photo">Zdjęcie</label>
    // <input type="text" name="photo"><br>

    echo $_REQUEST['chose'];
    echo '<form class="add" method="get">
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
        
        <input type="submit" name="add" value="Dodaj"></form>';
    var_dump($_REQUEST);
    if (isset($_GET['add'])) {
        echo 'jest';
        // $query = 'INSERT INTO produkty (tytul, opis, cena_netto, vat, ilosc_sztuk, gabaryt) VALUES ("' . $_GET['title'] . '","' . $_GET['desc'] . '","' . $_GET['value_net'] . '","' . $_GET['value_vat'] . '","' . $_GET['number'] . '","' . $_GET['size'] . '")';
        // mysqli_query($conn, $query);
    }
}
?>