<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exit</title>
</head>

<body>
    <h1>Czy chcesz wyjść?</h1>
    <form action="" method="post">
        <input type="submit" name="chose" value="Tak">
        <input type="submit" name="chose" value="Nie">
    </form>
</body>

<?php
if (isset($_POST['chose'])) {
    if ($_POST['chose'] === 'Tak') {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
    if ($_POST['chose'] === "Nie") {
        header("Location: shop.php");
    }
}

?>

</html>