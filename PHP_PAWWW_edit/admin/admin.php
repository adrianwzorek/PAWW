<link rel="stylesheet" href="../css/logowanie.css">
<?php
include '../cfg.php';
?>
<?php
FormularzLogoawania();
?>
<?php
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
  if (isset($_POST['login']) && isset($_POST['haslo'])) {
    if ($_SESSION['login'] == $_POST['login'] && $_SESSION['haslo'] == $_POST['haslo']) {
      header('Location: podstrony.php');
      session_start();
      exit();
    } else {
      echo '<div class="answer"> BŁĄD </br>popraw login lub hasło</div>';
    }
  }
}
