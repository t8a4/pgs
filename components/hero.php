<?php

$title = $data['hero_title'] ?? '';
$text = $data['hero_text'] ?? '';

$btn1_text = $data['hero_btn1_text'] ?? '';
$btn1_link = $data['hero_btn1_link'] ?? '';

$btn2_text = $data['hero_btn2_text'] ?? '';
$btn2_link = $data['hero_btn2_link'] ?? '';

$image = $data['image'] ?? '';
$bg_color = $data['hero_bg_color'] ?? '#000';
$text_color = $data['hero_text_color'] ?? '#fff';

?>

<section class="hero"
style="
background-color:<?= $bg_color ?>;
color:<?= $text_color ?>;
<?php if($image): ?>
background-image:url('/pgea/uploads/pages/<?= $image ?>');
background-size:cover;
background-position:center;
<?php endif; ?>
">

<div class="hero-inner">

<?php if($title): ?>
<h1><?= htmlspecialchars($title) ?></h1>
<?php endif; ?>

<?php if($text): ?>
<p><?= htmlspecialchars($text) ?></p>
<?php endif; ?>

<div class="hero-buttons">

<?php if($btn1_text): ?>
<a class="primary-btn" href="<?= $btn1_link ?>">
<?= htmlspecialchars($btn1_text) ?>
</a>
<?php endif; ?>

<?php if($btn2_text): ?>
<a class="outline-btn" href="<?= $btn2_link ?>">
<?= htmlspecialchars($btn2_text) ?>
</a>
<?php endif; ?>

</div>

</div>

</section>