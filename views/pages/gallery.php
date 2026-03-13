<?php

$stmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC");

$images = $stmt->fetchAll();

?>

<h1>Галерия</h1>

<div style="display:flex;flex-wrap:wrap;gap:20px;">

<?php foreach($images as $img): ?>

<img src="/pgea/uploads/gallery/<?php echo $img['image']; ?>" width="200">

<?php endforeach; ?>

</div>