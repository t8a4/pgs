<?php

$cards = json_decode($data['cards_data'] ?? "[]", true);

?>

<?php if(!empty($card['svg'])): ?>

<img src="/pgea/uploads/icons/<?= $card['svg'] ?>" class="card-icon">

<?php endif; ?>

<section class="cards">

<h2><?= htmlspecialchars($data['cards_title'] ?? '') ?></h2>

<div class="cards-grid">

<?php foreach($cards as $card): ?>

<div class="card">

<h3><?= htmlspecialchars($card['title']) ?></h3>

<p><?= htmlspecialchars($card['text']) ?></p>

</div>

<?php endforeach; ?>

</div>

</section>