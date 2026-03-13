<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM sections WHERE id=?");
$stmt->execute([$id]);

$section = $stmt->fetch();

$data = json_decode($section['data'], true);

if($_SERVER['REQUEST_METHOD']=="POST"){

$newdata = json_encode([
"title"=>$_POST['title'],
"text"=>$_POST['text'],
"button_text"=>$_POST['button_text'],
"button_link"=>$_POST['button_link']
]);

$stmt=$pdo->prepare("UPDATE sections SET data=? WHERE id=?");
$stmt->execute([$newdata,$id]);

if($section['type']=="cards"){

$newdata = json_encode([
"title"=>$_POST['title'],
"text"=>$_POST['cards_data']
]);

$svg = "";

if(!empty($_FILES['svg_icon']['name'])){

$ext = pathinfo($_FILES['svg_icon']['name'], PATHINFO_EXTENSION);

$filename = time()."_".rand(1000,9999).".".$ext;

move_uploaded_file(
$_FILES['svg_icon']['tmp_name'],
"../../uploads/icons/".$filename
);

$svg = $filename;
$data['svg_icon'] = $svg;
}
}

header("Location: edit.php?id=".$section['page_id']);
exit;

}

?>

<h1>Edit Section</h1>

<form method="POST">

Title
<br>
<input name="title" value="<?= htmlspecialchars($data['title'] ?? '' )?>">

<br><br>

Text
<br>
<textarea name="text"><?= htmlspecialchars($data['text'] ?? '') ?></textarea>

<br><br>

<?php if($section['type']=="cards"): ?>

<h3>Карти</h3>

<div id="cards">

</div>

<button type="button" onclick="addCard()">Добави карта</button>

<input type="hidden" name="cards_data" id="cards_data">

<script>

let cards = [];

function addCard(){

let title = prompt("Card title");
let text = prompt("Card text");

cards.push({title:title,text:text});

document.getElementById("cards_data").value =
JSON.stringify(cards);

}

</script>

<?php endif; ?>

<br><br>
Button text
<br>
<input name="button_text" value="<?= $data['button_text'] ?? '' ?>">

<br><br>

Button link
<br>
<input name="button_link" value="<?= $data['button_link'] ?? '' ?>">

<br><br>

<button>Save</button>

</form>

<?php require_once "../layout/footer.php"; ?>