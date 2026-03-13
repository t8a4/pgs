<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");

$posts = $stmt->fetchAll();

?>

<h1>Новини</h1>

<a href="create.php">+ Добави новина</a>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Заглавие</th>
<th>Дата</th>
<th>Действия</th>
</tr>

<?php foreach($posts as $post): ?>

<tr>

<td><?php echo $post['id']; ?></td>

<td><?php echo htmlspecialchars($post['title']); ?></td>

<td><?php echo $post['created_at']; ?></td>

<td>

<a href="edit.php?id=<?php echo $post['id']; ?>">Редакция</a>

<a href="delete.php?id=<?php echo $post['id']; ?>">Изтрий</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php require_once "../layout/footer.php"; ?>