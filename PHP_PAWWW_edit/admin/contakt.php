<div class='container'>
    <h1> Pokaż kontakt</h1>
    <?php
    PokazKontakt();
    WyslijMailKontakt();
    ?>

</div>

<?php

function PokazKontakt()
{
    $kontakt = '<form action="contakt.php?acction=wyslij_mail" method="post" enctype="text/plain">

    <div class="place">
        <span> E-mail:</span>
        <input type="text" name="e-mail" placeholder="E-Mail" class="write__place" />
    </div>

    <div class="place">
        <span>Temat:</span>
        <input type="text" name="title" placeholder="Nadaj Temat" class="write__place" />
    </div>
    <br />
    <textarea name="text" id="description" cols="30" rows="10" placeholder="Opis"></textarea>
    <br />
    <input type="submit" value="Wyślij" class="button" />
    <input type="reset" value="Resetuj" class="button" />';
    echo $kontakt;
}

function WyslijMailKontakt()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'wyslij_mail') {

        $email = $_POST['e-mail'];
        $tytul = $_POST['title'];
        $text = $_POST['text'];

        @mail($email, $tytul, $text);

        echo 'Wiadomość została przesłana :D';
    }
}

?>