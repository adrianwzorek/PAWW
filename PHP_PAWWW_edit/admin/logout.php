<?php

echo '<form action="admin.php" method="post">
    <label>Czy chcesz się wylogować?</label>
    <input type="submit" value="TAK" />
</form>';
if ($_REQUEST == "TAK") {
    session_unset();
    session_destroy();
}
