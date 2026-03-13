<?php

require_once "../../config/config.php";
require_once "../layout/header.php";

$stmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC");
$images = $stmt->fetchAll();

?>

<h1>Галерия</h1>

<a href="upload.php">+ Качи снимка</a>

<div style="display:flex;gap:20px;flex-wrap:wrap;margin-top:20px;">

<?php foreach($images as $img): ?>

<div>

<img src="/pgea/uploads/gallery/<?php echo $img['image']; ?>" width="150">

<p><?php echo htmlspecialchars($img['category']); ?></p>

<a href="delete.php?id=<?php echo $img['id']; ?>">Изтрий</a>

</div>

<?php endforeach; ?>

</div>

<?php require_once "../layout/footer.php"; ?>