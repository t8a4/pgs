<?php

require_once "../../config/config.php";

$id = $_GET['id'];
$dir = $_GET['dir'];

$stmt = $pdo->prepare("SELECT * FROM sections WHERE id=?");
$stmt->execute([$id]);
$current = $stmt->fetch();

$page_id = $current['page_id'];
$pos = $current['position'];

if($dir == "up"){

$stmt = $pdo->prepare("
SELECT * FROM sections
WHERE page_id=? AND position < ?
ORDER BY position DESC
LIMIT 1
");

}else{

$stmt = $pdo->prepare("
SELECT * FROM sections
WHERE page_id=? AND position > ?
ORDER BY position ASC
LIMIT 1
");

}

$stmt->execute([$page_id,$pos]);
$swap = $stmt->fetch();

if($swap){

$pdo->prepare("UPDATE sections SET position=? WHERE id=?")
->execute([$swap['position'],$current['id']]);

$pdo->prepare("UPDATE sections SET position=? WHERE id=?")
->execute([$pos,$swap['id']]);

}

header("Location: edit.php?id=".$page_id);