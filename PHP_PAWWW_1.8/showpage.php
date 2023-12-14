<?php
include 'cfg.php';

function showTab($id, $conn)
{
    $id_clear = htmlspecialchars($id);
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if (empty($row['id'])) {
        echo 'nie znaleziono </br>';
    } else {
        echo $row['id'];
        $web = html_entity_decode($row['page_content'], ENT_HTML5 | ENT_QUOTES | ENT_SUBSTITUTE);
    }
    return $web;
}
//$mysqli -> close();
