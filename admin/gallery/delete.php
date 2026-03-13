<?php

require_once "../../config/config.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM gallery WHERE id=?");
$stmt->execute([$id]);

$image = $stmt->fetch();

unlink("../../uploads/gallery/".$image['image']);

$stmt = $pdo->prepare("DELETE FROM gallery WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;