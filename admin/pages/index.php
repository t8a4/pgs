<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$stmt = $pdo->query("SELECT * FROM pages");

$pages = $stmt->fetchAll();

?>

<h1>Страници</h1>

<a href="create.php">+ Нова страница</a>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Заглавие</th>
<th>Slug</th>
<th></th>
</tr>

<?php foreach($pages as $page): ?>

<tr>

<td><?= $page['id'] ?></td>

<td><?= htmlspecialchars($page['title']) ?></td>

<td><?= $page['slug'] ?></td>

<td>

<a href="edit.php?id=<?= $page['id'] ?>">Редакция</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php require_once "../layout/footer.php"; ?>