<?php
include '../cfg.php';
session_start();
echo '<form action="post">
    <input type="submit" name="chose" value="Dodaj" />
</form>';

?>




<?php


echo $_POST['chose'];



function DodajProdukt($conn)
{
    echo '<form action="get">
    <label for="title">Tytuł</label>
    <input type="text" name="title" /><br>
    <label for="desc">Opis</label>
    <input type="text" name="desc" /> <br>
    <label for="value_net">Cena NETTO</label>
    <input type="text" name="value_net"><br>
    <label for="value_vat">VAT</label>
    <input type="text" name="value_vat"><br>
    <label for="number">Ilość sztuk</label>
    <input type="text" name="number"><br>
    <label for="category">Kategoria</label>
    <input type="text" name="category"><br>
    <label for="size">Gabaryt</label>
    <input type="text" name="size"><br>
    <label for="photo">Zdjęcie</label>
    <input type="text" name="photo"><br>
    <input type="submit" value="Dodaj">
</form>';
}
?>