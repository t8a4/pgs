<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];

$stmt = $pdo->prepare("
INSERT INTO events (title,description,date)
VALUES (?,?,?)
");

$stmt->execute([$title,$description,$date]);

header("Location: index.php");
exit;

}

?>

<h1>Добави събитие</h1>

<form method="POST">

<label>Заглавие</label>
<br>
<input type="text" name="title" required>

<br><br>

<label>Описание</label>
<br>

<div id="editor" style="height:300px;"></div>

<input type="hidden" name="description" id="description">

<br><br>

<label>Дата</label>
<br>
<input type="date" name="date">

<br><br>

<button type="submit">Запази</button>

</form>

<?php require_once "../layout/footer.php"; ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>

var quill = new Quill('#editor', {

theme: 'snow',

modules: {
toolbar: [
['bold','italic','underline'],
[{ 'header': [1,2,3,false] }],
[{ 'list':'ordered'}, { 'list':'bullet'}],
['link']
]
}

});

document.querySelector("form").onsubmit = function(){

document.querySelector("#description").value = quill.root.innerHTML;

};

</script>