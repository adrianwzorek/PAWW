<?php
include '../cfg.php';
// pokaż zdjęcie z bazy przy użyciu id produktu
$query = 'SELECT zdjecie FROM produkty WHERE id="' . $_REQUEST['id'] . '"';
$result = mysqli_query($conn, $query);
$item = mysqli_fetch_array($result);
// var_dump($_REQUEST);
if ($item['zdjecie'] != null) {
    echo '<img src="data:image/jpeg;base64,' . base64_encode($item['zdjecie']) . '"/>
    <a href="../shop.php">Powrót</a>';
}
if ($item['zdjecie'] == null) {
    echo 'Nie znaleziono zdjęcia dla produktu o id: ' . $_REQUEST['id'] .
        '<br><a href="../shop.php">Powrót</a>';
}
