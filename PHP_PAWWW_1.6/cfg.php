<?php
    $dbhost = 'localhost';
    $dbuster = 'root';
    $dbpass= '';
    $baza = 'moja_strona';

    $link = mysqli_connect($dbhost,$dbuster,$dbpass,$baza);
    if(!$link) echo '<b>Przerwane polaczenie</b>';
    else { 
        echo 'Połączono';
        $_GLOBALS['link'] = $link;
    }

?>