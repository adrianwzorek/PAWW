<?php
$dbhost = 'localhost';
$dbuster = 'root';
$dbpass = '';
$baza = 'moja_strona';

// Hasło do wejścia admina
$_SESSION['login'] = 'Adrian';
$_SESSION['haslo'] = 'Wzorek';


// Łączenie się z bazą danych
$conn = mysqli_connect($dbhost, $dbuster, $dbpass, $baza);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
