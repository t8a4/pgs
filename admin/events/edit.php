<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM events WHERE id=?");
$stmt->execute([$id]);

$event = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];

$stmt = $pdo->prepare("
UPDATE events
SET title=?, description=?, date=?
WHERE id=?
");

$stmt->execute([$title,$description,$date,$id]);

header("Location: index.php");
exit;

}

?>

<h1>Редакция на събитие</h1>

<form method="POST">

<label>Заглавие</label>
<br>
<input type="text" name="title"
value="<?php echo htmlspecialchars($event['title']); ?>">

<br><br>

<label>Описание</label>
<br>

<div id="editor" style="height:300px;"></div>

<input type="hidden" name="description" id="description">


<?php echo htmlspecialchars($event['description']); ?>

</textarea>

<br><br>

<label>Дата</label>
<br>
<input type="date" name="date"
value="<?php echo $event['date']; ?>">

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