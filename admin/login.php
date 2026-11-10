<?php
session_start();

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Admin | AiniBookStore</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0d6efd,#6f42c1);
}

.login-box{
    width:400px;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(12px);
    border-radius:20px;
    padding:35px;
    color:white;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

.login-box h2{
    text-align:center;
    margin-bottom:25px;
}

.form-control{
    border-radius:10px;
    height:50px;
}

.btn-login{
    width:100%;
    height:50px;
    border:none;
    border-radius:10px;
    background:#ffc107;
    color:black;
    font-weight:bold;
    transition:.3s;
}

.btn-login:hover{
    background:#ffca2c;
}

.logo{
    text-align:center;
    font-size:60px;
    margin-bottom:15px;
}

</style>

</head>
<body>

<div class="login-box">

<div class="logo">
<i class="fa-solid fa-book-open"></i>
</div>

<h2>AiniBookStore Admin</h2>

<form action="login_proses.php" method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Masukkan Username"
required>

</div>

<div class="mb-4">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

<button class="btn-login">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</form>

</div>

</body>
</html>