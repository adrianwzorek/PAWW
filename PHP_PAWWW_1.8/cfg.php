<?php
$dbhost = 'localhost';
$dbuster = 'root';
$dbpass = '';
$baza = 'moja_strona';

$_SESSION['login'] = 'Adrian';
$_SESSION['haslo'] = 'Wzorek';


$conn = mysqli_connect($dbhost, $dbuster, $dbpass, $baza);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
