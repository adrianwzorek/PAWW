<?php
include '../cfg.php';
session_start();
ShowAll($conn);
echo '<form method="post">
<input type="submit" name="chose" value="Dodaj" />
</form>';

?>




<?php
if (isset($_POST['chose']) && $_POST['chose'] == 'Dodaj') {
    DodajProdukt($conn);
}
if (isset($_GET['sub'])) {
    echo 'poszło :D';
}

function ShowAll($conn)
{
    $query = 'SELECT * FROM produkty';
    $result = mysqli_query($conn, $query);
    foreach ($result as  $value) {
        echo 'id: ' . $value['id'] . ' nazwa: ' . $value['tytul'] . ' -> ilość sztuk: ' . $value['ilosc_sztuk'] . '<br>';
    }
}

function DodajProdukt($conn)
{
    // <label for="category">Kategoria</label>
    // <input type="text" name="category"><br>
    // <label for="photo">Zdjęcie</label>
    // <input type="text" name="photo"><br>

    echo '<form method="get">
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
 
    <input type="submit" name="sub" value="Dodaj">
</form>';
    if (isset($_GET['sub'])) {
        $query = 'INSERT INTO produkty (tytul, opis, cena_netto, vat, ilosc_sztuk, gabaryt) VALUES ("' . $_GET['title'] . '","' . $_GET['desc'] . '","' . $_GET['value_net'] . '","' . $_GET['value_vat'] . '","' . $_GET['number'] . '","' . $_GET['size'] . '")';
        mysqli_query($conn, $query);
    }
}
?>