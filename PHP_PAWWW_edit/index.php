<!DOCTYPE html>
<?php
include 'cfg.php';
include 'showpage.php';
// wyłapywanie błędów i pobieranie odpowiedniej strony z bazy danych 
// przez id
error_reporting(E_ALL ^ E_WARNING);
if ($_GET['id'] == '') $strona = '2';
if ($_GET['id'] == 'gryfindor') $strona = '3';
if ($_GET['id'] == 'slytherin') $strona = '4';
if ($_GET['id'] == 'ravenclaw') $strona = '5';
if ($_GET['id'] == 'hufflepuff') $strona = '6';
if ($_GET['id'] == 'mail') $strona = '7';
if ($_GET['id'] == 'movies') $strona = '8';
if ($_GET['id'] == 'form_login') $strona = '9';
if ($_GET['id']  == 'admin') $strona = 'admin.php';

?>
<html lang="pl">

<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="pl" />
  <meta name="Adrian Wzorek" content="Adrian Wzorek" />
  <title>Moja Strona Internetowa</title>
  <link rel="website icon" href="./css/Pictures/harry-potter-zoom-background-ey1wy31b6pclofru.webp" />
  <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="./js/script.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/index.css" />
</head>

<body>
  <?php
  // Wyświetlenie odpowiedniej strony
  echo showTab($strona, $conn);
  ?>
  <footer>
    <a class='panel' href="./admin/admin.php">Admin</a>
    <a class='panel' href="./shop.php">Zajrzyj na sklep</a>
    Nacisnij
    <a href="./index.php?id=mail" class="mail">&#10170;</a> żeby wysłać do mnie
    maila
    <img id="info" src="./css/Pictures/Icons/interrogation.png" alt="question" onclick="showInfo(this)">
    <img id="movies" src="./css/Pictures/Icons/clapperboard.png" alt="movie" onclick="goToMovie()">

  </footer>
  </div>
</body>

</html>