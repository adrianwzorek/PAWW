<link rel="stylesheet" href="../css/style.css">
<?php
include '../cfg.php';
?>
<?php
FormularzLogoawania();
?>
<?php
// Tworze formularz Logowania
function FormularzLogoawania()
{
  $form = '<div class="container">
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
  </div>
    ';
  echo $form;
  // Sprawdzam czy Post i Get istnieją i są podane prawidłowo
  if (isset($_POST['login']) && isset($_POST['haslo'])) {
    if ($_SESSION['login'] == $_POST['login'] && $_SESSION['haslo'] == $_POST['haslo']) {
      // Jeśli tak przechodze do innego pliku i zaczynam sesje
      header('Location: podstrony.php');
      session_start();
      exit();
    } else {
      // jeśli jest błąd wyświtlam komunikat
      echo '<div class="answer"> BŁĄD </br>popraw login lub hasło</div>';
    }
  }
}
