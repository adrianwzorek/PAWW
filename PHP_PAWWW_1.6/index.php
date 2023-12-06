<!DOCTYPE html>
<?php
error_reporting(E_ALL ^ E_WARNING);
if($_GET['id']=='')$strona = './html/glowny.html';
if($_GET['id']=='gryfindor')$strona = './html/gryfindor.html';
if($_GET['id']=='slytherin')$strona = './html/slytherin.html';
if($_GET['id']=='ravenclaw')$strona = './html/ravenclaw.html';
if($_GET['id']=='hufflepuff')$strona = './html/hufflepuff.html';
if($_GET['id']=='mail')$strona = './html/mail.html';
if($_GET['id']=='movies')$strona = './html/movies.html';
  if($strona == null || !file_exists($strona)){
    $strona = './html/glowna.html';
  }
?>
<html lang="pl">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Adrian Wzorek" content="Adrian Wzorek" />
    <title>Moja Strona Internetowa</title>
    <link
      rel="website icon"
      href="./css/Pictures/harry-potter-zoom-background-ey1wy31b6pclofru.webp"
    />
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
  </head>
  <body>
    <?php
    include($strona);
    ?>
      <footer>
        Nacisnij
        <a href="./index.php?id=mail" class="mail">&#10170;</a> żeby wysłać do mnie
        maila
          <img
          id="info"
          src="./css/Pictures/Icons/interrogation.png"
          alt="Question"
          onclick="showInfo(this)"
          >
          <img id="movies" src="./css/Pictures/Icons/clapperboard.png" alt="movie" onclick="goToMovie()">
        
      </footer>
    </div>
  </body>
</html>
