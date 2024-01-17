<?php
include '../cfg.php';
session_start();
$query = 'SELECT * FROM produkty WHERE id=' . $_POST['id'];
$result = mysqli_query($conn, $query);
$item = mysqli_fetch_array($result);
echo 'Jaką liczbę ' . $item['tytul'] . ' chcesz kupić?<br>
Dostępna ilość: ' . $item['ilosc_sztuk'];
?>
<form action="../shop.php" method="post">
    <input required type="number" name="number" min="0" max="<?php echo intval($item['ilosc_sztuk']) ?>">
    <input type="submit" name="sub" value="Kup">
    <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
    <a href="../shop.php">Cofnij</a>
</form>