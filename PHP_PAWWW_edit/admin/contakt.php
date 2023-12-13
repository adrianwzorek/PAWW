 <div>
     <?php
        if (isset($_POST)) {
            if ($_POST['edytuj']) {
                echo $_POST['edytuj'];
            }
        }

        ?>
 </div>
 <form action="podstrony.php" method="get">
     <div class="box">
         podaj Tytuł
         <input type="text">
     </div>
     <div class="box">
         Podaj treść strony
         <input type="textarea">
     </div>
     <div class="box">
         Czy strona ma być aktywna
         <input type="checkbox"> TAK
     </div>
     <input type="submit" name="zmiana" id="zmiana" value="zapisz">
 </form>