<?php
include '../showpage.php';
?>


<div class='lista_postron'>
    <?php
    ListaPodstron($conn);
    if (isset($_GET)) {
        if (empty($_GET)) {
            echo 'nie ma get';
        } else {
            EdytujPodstrone();
        }
    }
    ?>
</div>


<?php

function ListaPodstron($conn)
{
    echo 'Niżej wyświetlam wszystkie podstrony z bazy';
    $query = 'SELECT * FROM page_list LIMIT 10';
    $result = mysqli_query($conn, $query);
    $calc = 1;
    while ($row = mysqli_fetch_array($result)) {
        $list = ['' . $row['id'] . ''];
    }
    for(i=0;i<sizeof($list);i++){
        echo $list[i];
    }
}

// echo '<div class="item nr' . $calc . '"> ' . $row['id'] . '  -->  ' . $row['page_title'] . '
// <form action="podstrony.php" method="get">
// <input type="submit" name="edytuj" value="Edytuj">
// </form></div>';


function EdytujPodstrone()
{
    $content = '<form action="podstrony.php" method="get">
    <div class="box">
        podaj Tytuł
        <input type="text" name="tytul" placeholder="tytul">
    </div>
    <div class="box">
        Podaj treść strony
        <input type="textarea" name="tresc" placeholder="tresc strony">
    </div>
    <div class="box">
        Czy strona ma być aktywna
        <input type="checkbox" name="aktywna"> TAK
    </div>
    <input type="submit" name="zmiana" value="zapisz">
</form>';
    echo $content;
}
?>