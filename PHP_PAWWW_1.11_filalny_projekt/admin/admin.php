<link rel="stylesheet" href="../css/style.css">
<?php
session_start();
include '../cfg.php';
FormularzLogowania($login, $haslo);
?>
<?php
// Tworze formularz Logowania
function FormularzLogowania($login, $haslo)
{
  echo '<a href="../index.php">Cofnij</a><div class="container">
  <a href="kontakt.php" style="top: 3em;">Kontakt</a>
    <form action="admin.php" method="post">
      <div class="blok">
        <div class="top lg">Login</div>
        <input type="text" name="login" class="input" placeholder="Login" />
      </div>
      <div class="blok">
        <div class="top hl">Haslo</div>
        <input
          type="password"
          name="haslo"
          class="input"
          placeholder="Haslo"
        />
      </div>
      <input id="button" type="submit" value="Log in" />
    </form>
  </div>';

  // Sprawdzam czy Post  istnieje i jest podane prawidłowo

  if (isset($_POST['login']) && isset($_POST['haslo'])) {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['haslo'] = $_POST['haslo'];
    if ($_SESSION['login'] == $login   &&  $_SESSION['haslo'] == $haslo) {
      // Jeśli tak przechodze do innego pliku i zaczynam sesje
      header('Location: podstrony.php');
      // exit();
    } else {
      echo '<span class="popup">Nie poprawne hasło lub login</span>';
    }
  }
}
