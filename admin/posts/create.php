<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

function slugify($text){

$text = mb_strtolower($text);

$map = [
'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y',
'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u',
'ф'=>'f','х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sht','ъ'=>'a','ь'=>'','ю'=>'yu','я'=>'ya'
];

$text = strtr($text,$map);
$text = preg_replace('/[^a-z0-9]+/','-',$text);
$text = trim($text,'-');

return $text;

}
function createUniqueSlug($pdo,$slug){

$originalSlug = $slug;
$counter = 1;

while(true){

$stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE slug=?");
$stmt->execute([$slug]);

if($stmt->fetchColumn() == 0){
return $slug;
}

$slug = $originalSlug . '-' . $counter;
$counter++;

}

}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$title = $_POST['title'];
$content = $_POST['content'];
$image = null;

if(!empty($_FILES['image']['name'])){

$filename = time() . "_" . $_FILES['image']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../../uploads/posts/".$filename
);

$image = $filename;

}

$slug = slugify($title);
$slug = createUniqueSlug($pdo,$slug);

$stmt = $pdo->prepare("INSERT INTO posts (title,slug,content,image,created_at)
VALUES (?,?,?,?,NOW())");

$stmt->execute([$title,$slug,$content,$image]);

header("Location: index.php");
exit;

}

?>

<h1>Добави новина</h1>

<form method="POST" enctype="multipart/form-data">

<label>Заглавие</label>
<br>
<input type="text" name="title" required>

<br><br>

<label>Текст</label>
<br>

<div id="editor" style="height:400px;"></div>

<input type="hidden" name="content" id="content">


<br><br>

<label>Снимка</label>
<br>
<input type="file" name="image">

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

document.querySelector("#content").value = quill.root.innerHTML;

};

</script>