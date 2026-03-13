<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=?");
$stmt->execute([$id]);

$post = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$title = $_POST['title'];
$content = $_POST['content'];

$stmt = $pdo->prepare("UPDATE posts SET title=?, content=? WHERE id=?");

$stmt->execute([$title,$content,$id]);

header("Location: index.php");
exit;

}

?>

<h1>Редакция</h1>

<form method="POST">

<label>Заглавие</label>
<br>

<input type="text" name="title"
value="<?php echo htmlspecialchars($post['title']); ?>">

<br><br>

<label>Текст</label>
<br>

<!-- Quill editor -->
<div id="editor" style="height:400px;">
<?php echo $post['content']; ?>
</div>

<!-- hidden input за изпращане към PHP -->
<input type="hidden" name="content" id="content">

<br><br>

<button type="submit">Запази</button>

</form>

<?php require_once "../layout/footer.php"; ?>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
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