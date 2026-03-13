<!DOCTYPE html>
<html lang="bg">

<head>
<?php if(isset($sections)): ?>

<?php foreach($sections as $section): ?>

<link rel="stylesheet" href="/pgea/sections/<?= $section['type'] ?>/<?= $section['type'] ?>.css">

<?php endforeach; ?>

<?php endif; ?>

<meta charset="UTF-8">
<title>PGEA</title>

<link rel="stylesheet" href="/pgea/assets/css/style.css">

</head>

<body>

<header>

<nav>

<a href="/pgea/">Начало</a>
<a href="/pgea/news">Новини</a>
<a href="/pgea/events">Събития</a>
<a href="/pgea/gallery">Галерия</a>
<a href="/pgea/contact">Контакти</a>

</nav>

</header>

<main>