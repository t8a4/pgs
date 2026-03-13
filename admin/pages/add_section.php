<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$page_id = $_GET['page_id'];

if($_SERVER['REQUEST_METHOD']=="POST"){

$type = $_POST['type'];

$image = "";

if(!empty($_FILES['image']['name'])){

$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$filename = time()."_".rand(1000,9999).".".$ext;

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../../uploads/pages/".$filename
);

$image = $filename;

}

$data = json_encode($_POST);

$stmt=$pdo->prepare("
INSERT INTO sections (page_id,type,position,data)
VALUES (?,?,0,?)
");

$stmt->execute([$page_id,$type,$data]);

header("Location:edit.php?id=".$page_id);
exit;

}
?>

<h1>Добави секция</h1>

<form method="POST" enctype="multipart/form-data">

<label>Тип секция</label>

<select name="type" id="sectionType">

<option value="">-- Избери тип секция --</option>

<option value="hero">Hero</option>
<option value="title_text">Title + Text</option>
<option value="cards">Cards</option>
<option value="image_text">Image + Text</option>
<option value="cta">CTA</option>

</select>

<br><br>

<!-- HERO -->

<div class="section-form hero-form hidden">

<h3>Hero Settings</h3>

<label>Title</label>
<input name="hero_title">

<label>Text</label>
<textarea name="hero_text"></textarea>

<h4>Buttons</h4>

<input name="hero_btn1_text" placeholder="Button 1 text">
<input name="hero_btn1_link" placeholder="Button 1 link">

<input name="hero_btn2_text" placeholder="Button 2 text">
<input name="hero_btn2_link" placeholder="Button 2 link">

<h4>Background</h4>

<label>Background Color</label>
<input type="color" name="hero_bg_color">

<label>Background Image</label>
<input type="file" name="image">

<label>Text Color</label>
<input type="color" name="hero_text_color">

</div>

<!-- TITLE TEXT -->

<div class="section-form title-text-form hidden">

<h3>Title + Text</h3>

<label>Title</label>
<input name="title_text_title">

<label>Text</label>
<textarea name="title_text_text"></textarea>

<label>Background color</label>
<input type="color" name="title_text_bg">

<label>Text color</label>
<input type="color" name="title_text_color">

</div>

<!-- CARDS -->

<div class="section-form cards-form hidden">

<h3>Cards</h3>

<label>Section Title</label>
<input name="cards_title">

<label>Cards per row</label>

<select name="cards_columns">
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>

<label>Card style</label>

<select name="cards_style">

<option value="title">Title</option>
<option value="title_svg">Title + SVG</option>
<option value="title_text">Title + Text</option>
<option value="title_text_svg">Title + Text + SVG</option>

</select>

<label>Section background</label>
<input type="color" name="cards_section_bg">

<label>Card background</label>
<input type="color" name="cards_card_bg">

<label>SVG color</label>
<input type="color" name="cards_svg_color">

<label>Upload SVG</label>
<input type="file" name="svg_icon">
<h4>Cards</h4>

<div id="cards-container"></div>

<button type="button" onclick="addCard()">+ Добави карта</button>

<input type="hidden" name="cards_data" id="cards_data">

</div>

<!-- IMAGE TEXT -->

<div class="section-form image-text-form hidden">

<h3>Image + Text</h3>

<label>Title</label>
<input name="image_text_title">

<label>Text</label>
<textarea name="image_text_text"></textarea>

<label>Image</label>
<input type="file" name="image">

<label>Layout</label>

<select name="image_text_layout">

<option value="left">Image Left</option>
<option value="right">Image Right</option>

</select>

<label>Background</label>
<input type="color" name="image_text_bg">

<label>Text color</label>
<input type="color" name="image_text_color">

</div>

<!-- CTA -->

<div class="section-form cta-form hidden">

<h3>CTA</h3>

<label>Title</label>
<input name="cta_title">

<label>Text</label>
<textarea name="cta_text"></textarea>

<h4>Buttons</h4>

<input name="cta_btn1_text" placeholder="Button text">
<input name="cta_btn1_link" placeholder="Button link">

<select name="cta_btn1_style">

<option value="primary-btn">Primary</option>
<option value="outline-btn">Outline</option>

</select>

<input name="cta_btn2_text" placeholder="Button text">
<input name="cta_btn2_link" placeholder="Button link">

<select name="cta_btn2_style">

<option value="primary-btn">Primary</option>
<option value="outline-btn">Outline</option>

</select>

<label>Background</label>
<input type="color" name="cta_bg">

<label>Text color</label>
<input type="color" name="cta_text_color">

</div>

<br><br>

<button type="submit">Добави секция</button>

</form>

<script>

const typeSelect = document.getElementById("sectionType");

typeSelect.addEventListener("change", function(){

document.querySelectorAll(".section-form").forEach(el=>{
el.classList.add("hidden");
});

let selected = this.value;

if(!selected) return;

selected = selected.replaceAll("_","-");

const form = document.querySelector("." + selected + "-form");

if(form){
form.classList.remove("hidden");
}

});

</script>
<script>

let cards = [];

function addCard(){

const title = prompt("Card title:");
const text = prompt("Card text:");

if(!title) return;

const card = {
title:title,
text:text
};

cards.push(card);

renderCards();

}

function renderCards(){

const container = document.getElementById("cards-container");

container.innerHTML = "";

cards.forEach((card,index)=>{

const div = document.createElement("div");

div.style.border="1px solid #ccc";
div.style.padding="10px";
div.style.margin="10px 0";

div.innerHTML = `
<strong>${card.title}</strong><br>
${card.text}<br>
<button type="button" onclick="removeCard(${index})">Remove</button>
`;

container.appendChild(div);

});

document.getElementById("cards_data").value =
JSON.stringify(cards);

}

function removeCard(index){

cards.splice(index,1);

renderCards();

}

</script>

<?php require_once "../layout/footer.php"; ?>