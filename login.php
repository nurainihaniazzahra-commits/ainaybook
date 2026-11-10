<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Ainibookstore</title>

<link rel="stylesheet" href="style.css">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="login-container">

<div class="login-box">

<h2>Login</h2>

<form action="proses/login_proses.php" method="POST">

<div class="input-box">

<label>Email</label>

<input
type="email"
name="email"
placeholder="Masukkan Email"
required>

</div>

<div class="input-box">

<label>Password</label>

<input
type="password"
name="password"
placeholder="Masukkan Password"
required>

</div>

<button type="submit" class="login-btn">

Masuk

</button>

<p>

Belum punya akun?

<a href="register.php">

Daftar

</a>

</p>

</form>

</div>

</div>

</body>

</html>