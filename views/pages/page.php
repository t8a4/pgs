<?php

$slug = $_GET['slug'];

$stmt = $pdo->prepare("SELECT * FROM pages WHERE slug=?");
$stmt->execute([$slug]);

$page = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM sections
WHERE page_id=? ORDER BY position");

$stmt->execute([$page['id']]);

$sections = $stmt->fetchAll();

foreach($sections as $section){

$data=json_decode($section['data'],true);

include "components/".$section['type'].".php";

}