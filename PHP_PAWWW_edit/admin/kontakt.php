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
    $kontakt = '<form  method="post">

    <div class="place">
        <label> E-mail:</label>
        <input required type="text" name="email" placeholder="E-Mail" class="write__place" />
    </div>

    <div class="place">
        <label>Temat:</label>
        <input required  type="text" name="title" placeholder="Nadaj Temat" class="write__place" />
    </div>
    <br />
    <textarea required name="tekst" id="description" cols="30" rows="10" placeholder="Opis"></textarea>
    <br />
    <input type="submit" name="wyslij" value="Wyślij" class="button" />
    <input type="reset" name ="reset" value="Resetuj" class="button" />
    </form>';
    echo $kontakt;
}

function WyslijMailKontakt()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wyslij'])) {

        $email = $_POST['email'];
        $tytul = $_POST['title'];
        $text = $_POST['tekst'];

        mail($email, $tytul, $text);
        echo 'Wiadomość została przesłana :D';
    }
    if (isset($_POST['email'])) {
        echo 'Działa';
    }
}
?>