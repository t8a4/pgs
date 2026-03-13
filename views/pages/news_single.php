<?php

require_once "models/Post.php";

$postModel = new Post($pdo);

$slug = $_GET['slug'] ?? '';

$post = $postModel->getBySlug($slug);

if(!$post){

echo "Новината не е намерена.";
return;

}

?>

<h1><?php echo htmlspecialchars($post['title']); ?></h1>

<?php if($post['image']): ?>

<img src="/pgea/uploads/posts/<?php echo $post['image']; ?>" width="600">

<?php endif; ?>

<p>

<?php echo date("d.m.Y", strtotime($post['created_at'])); ?>

</p>

<div>

<?php echo $post['content']; ?>

</div>