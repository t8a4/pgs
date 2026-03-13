<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$stmt = $pdo->query("SELECT * FROM events ORDER BY date DESC");

$events = $stmt->fetchAll();

?>

<h1>Събития</h1>

<a href="create.php">+ Добави събитие</a>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Заглавие</th>
<th>Дата</th>
<th>Действия</th>
</tr>

<?php foreach($events as $event): ?>

<tr>

<td><?php echo $event['id']; ?></td>

<td><?php echo htmlspecialchars($event['title']); ?></td>

<td><?php echo $event['date']; ?></td>

<td>

<a href="edit.php?id=<?php echo $event['id']; ?>">Редакция</a>

<a href="delete.php?id=<?php echo $event['id']; ?>">Изтрий</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php require_once "../layout/footer.php"; ?>