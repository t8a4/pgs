<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$category = $_POST['category'];

$file = $_FILES['image'];

$filename = time() . "_" . $file['name'];

$target = "../../uploads/gallery/" . $filename;

move_uploaded_file($file['tmp_name'], $target);

$stmt = $pdo->prepare("
INSERT INTO gallery (image,category)
VALUES (?,?)
");

$stmt->execute([$filename,$category]);

header("Location: index.php");
exit;

}

?>

<h1>Качи снимка</h1>

<form method="POST" enctype="multipart/form-data">

<label>Категория</label>
<br>

<select name="category">

<option value="events">Събития</option>
<option value="school">Училище</option>
<option value="students">Ученици</option>

</select>

<br><br>

<label>Снимка</label>
<br>

<input type="file" name="image">

<br><br>

<button type="submit">Качи</button>

</form>

<?php require_once "../layout/footer.php"; ?>