<?php
include './cfg.php';
function ShowItem($conn)
{
    $query = 'SELECT * FROM produkty';
    $result = mysqli_query($conn, $query);
    $items = mysqli_fetch_all($result);
    foreach ($items as $value) {
        if ($value[9] != 0) {
            $cost = floatval($value[6]) + (floatval($value[6]) * (floatval($value[7]) / 100));
            echo '<tr>
            <th>' . $value[1] . '</th>
            <th>' . $value[2] . '</th>
            <th>' . $cost . 'zł</th>
            <th>' . $value[8] . '</th>
            <th>' . $value[5] . '</th>
            <th><form action="./shop/add.php" method="post">
            <input type="submit" name="add" value="Kup">
            <input type="hidden" name="id" value="' . $value[0] . '">
            </form></th>
            </tr>';
        }
    }
}
