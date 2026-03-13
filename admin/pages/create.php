<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

$title = $_POST['title'];
$slug = $_POST['slug'];

$stmt=$pdo->prepare("INSERT INTO pages (title,slug,created_at)
VALUES (?,?,NOW())");

$stmt->execute([$title,$slug]);

header("Location:index.php");
exit;

}

?>

<h1>Нова страница</h1>

<form method="POST">

<label>Заглавие</label>
<br>
<input type="text" name="title">

<br><br>

<label>Slug</label>
<br>
<input type="text" name="slug">

<br><br>

<button>Създай</button>

</form>

<?php require_once "../layout/footer.php"; ?>