<?php

$data = $data ?? [];

$title = $data['title'] ?? '';
$subtitle = $data['subtitle'] ?? '';
$background = $data['background'] ?? '';
$buttons = $data['buttons'] ?? [];

?>

<section class="hero" style="background-image:url('/pgea/uploads/<?= $background ?>')">

<div class="hero-overlay"></div>

<div class="hero-content">

<h1><?= htmlspecialchars($title) ?></h1>

<p><?= htmlspecialchars($subtitle) ?></p>

<?php if(!empty($buttons)): ?>

<div class="hero-buttons">

<?php foreach($buttons as $btn): ?>

<a href="<?= htmlspecialchars($btn['link']) ?>" class="btn">

<?= htmlspecialchars($btn['text']) ?>

</a>

<?php endforeach; ?>

</div>

<?php endif; ?>

</div>

</section>