<link rel="stylesheet" href="../css/style.css">
<div class='container--kontakt'>
    <h1>Napisz do mnie Maila :D</h1>
    <?php
    PokazKontakt();
    WyslijMailKontakt();
    ?>

</div>
<a href="../admin/admin.php">Cofnij</a>
<?php
// Tworze formularz
function PokazKontakt()
{
    $kontakt = '<form  method="post">
        <input required type="email" name="email" placeholder="E-Mail" class="write__place" />
    
        <input required  type="text" name="title" placeholder="Nadaj Temat" class="write__place" />
    
    <br />
    <textarea required name="tekst" id="description" cols="30" rows="10" placeholder="Opis"></textarea>
    <input type="submit" name="wyslij" value="Wyślij" class="button" />
    <input type="reset" name ="reset" value="Resetuj" class="button" />
    </form>';
    echo $kontakt;
}

function WyslijMailKontakt()
{
    ini_set('error_reporting', 'E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED');
    // sprawdzam czy wymaganą metodą jest POST i czy naciśnięto przycisk 'submit'
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wyslij'])) {

        $email = $_POST['email'];
        $tytul = $_POST['title'];
        $text = $_POST['tekst'];

        mail($email, $tytul, $text);
    }
    if (isset($_POST['email'])) {
        echo '<span style="position: absolute; font-size: 2.5em; bottom:-2em;">Wiadomość została przesłana</span>';
    }
}
?>