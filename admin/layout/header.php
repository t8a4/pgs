<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="bg">

<head>

<meta charset="UTF-8">
<title>Admin Panel</title>

<link rel="stylesheet" href="/pgea/assets/css/admin.css">

</head>

<body>

<div class="admin-container">

<aside class="sidebar">

<h2>PGEA CMS</h2>

<nav>

<a href="dashboard.php">Dashboard</a>
<a href="posts/">Новини</a>
<a href="events/">Събития</a>
<a href="pages/">Страници</a>
<a href="gallery/">Галерия</a>

<a href="logout.php">Изход</a>

</nav>

</aside>

<main class="admin-content">