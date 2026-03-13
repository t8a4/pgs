<?php

require_once "models/Post.php";

$postModel = new Post($pdo);

$posts = $postModel->getAll();

?>

<h1>Новини</h1>

<?php foreach($posts as $post): ?>

<div class="news-card">

<h2>

<a href="/pgea/news/<?php echo $post['slug']; ?>">

<?php echo htmlspecialchars($post['title']); ?>

</a>

</h2>

<p>

<?php echo date("d.m.Y", strtotime($post['created_at'])); ?>

</p>

</div>

<?php endforeach; ?>