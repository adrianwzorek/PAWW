<?php
//include('cfg.php');

function showTab($id){
    $id_clear = htmlspecialchars($id);
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1;";
    $mysql = new mysqli('localhost','root','','moja_strona');
    // $link = $_GLOBALS['link'];
    $result = mysqli_query($mysql,$query);
    $row = mysqli_fetch_array($result);

    if(empty($row['id'])){
        echo 'nie znaleziono </br>';
    }
    else{
            echo $row['id'];
        $web = $row['page_content'];
    }
    return $web;
}
//$mysqli -> close();

?>