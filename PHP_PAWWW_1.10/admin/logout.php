<?php
session_start();
if ($_SESSION['login'] && $_SESSION['haslo']) {

    echo '<h1>Czy na pewno chcesz zakończyć sesje?</h1>
    <form method="post">
    <input type="submit" name="chose" value="TAK">
    <input type="submit" name="chose" value="NIE">
    </form>';
} else {
    header('location: admin.php');
}
?>

<?php
if (isset($_POST['chose'])) {
    if ($_POST['chose'] == 'TAK') {
        session_unset();
        session_destroy();
        header('location: admin.php');
    } else {
        header('location: podstrony.php');
    }
}
?>