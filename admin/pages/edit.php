<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM pages WHERE id=?");
$stmt->execute([$id]);

$page = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM sections
WHERE page_id=? ORDER BY position");

$stmt->execute([$id]);

$sections = $stmt->fetchAll();

?>

<div class="page-editor">
<h1><?= $page['title'] ?></h1>

<div class="preview-panel">

<h2>Preview</h2>

<div class="preview-controls">

<button onclick="setPreview(1200)">Desktop</button>
<button onclick="setPreview(768)">Tablet</button>
<button onclick="setPreview(375)">Mobile</button>

</div>

<div class="preview-wrapper">

<iframe
src="/pgea/page/<?= $page['slug'] ?>"
class="preview-frame"
id="previewFrame"
></iframe>

</div>

</div>

<hr>

<a href="add_section.php?page_id=<?= $id ?>">+ Добави секция</a>

<br>

<?php foreach($sections as $section):

$data = json_decode($section['data'], true);

?>

<strong><?= $section['type'] ?></strong>

<div class="section-item">

<strong><?= $section['type'] ?></strong>

<a href="edit_section.php?id=<?= $section['id'] ?>">Редакция</a>

<a href="delete_section.php?id=<?= $section['id'] ?>">Изтрий</a>

<a href="move.php?id=<?= $section['id'] ?>&dir=up">↑</a>

<a href="move.php?id=<?= $section['id'] ?>&dir=down">↓</a>

</div>

</div>

</div>

</div>
</div>

<?php endforeach; ?>

<script>
function refreshPreview(){

document
.getElementById("previewFrame")
.contentWindow
.location
.reload();

}

function setPreview(width){

const frame = document.getElementById("previewFrame");

frame.style.maxWidth = width + "px";

}
</script>

<?php require_once "../layout/footer.php"; ?>