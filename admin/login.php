<?php

session_start();

require_once "../config/config.php";

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);

$user = $stmt->fetch();

if($user && $password === $user['password']){

$_SESSION['user'] = $user['id'];

header("Location: dashboard.php");
exit;

}else{

$error = "Грешно потребителско име или парола.";

}

}

?>

<h2>Admin Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Username">

<input type="password" name="password" placeholder="Password">

<button type="submit">Login</button>

</form>

<p><?php echo $error; ?></p>