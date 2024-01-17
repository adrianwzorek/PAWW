<form method="get" enctype="multipart/form-data">
    <input type="submit" name="chose" value="TAK">
    <input type="submit" name="chose" value="NIE">
    <input type="file" name="file" accept="image/*" />
</form>


<?php
if (isset($_FILES['file'])) {
    $tempPath = $_FILES['file']['tmp_name'];
    $uploatPath = 'uploads/' . basename($_FILES['file']['name']);
    move_uploaded_file($tempPath, $uploatPath);

    echo '<h1>Obraz</h1>
        <img src="' . $uploatPath . '" alt="Uploated Photo" />';
}
?>