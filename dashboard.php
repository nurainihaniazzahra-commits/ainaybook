<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Ainibookstore</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{
background:#F6F0E8;
}

/* Navbar */

nav{
background:#F2E5CF;
padding:25px 60px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.logo{
font-size:50px;
font-weight:700;
color:#6B4F3A;
}

.user{
display:flex;
align-items:center;
gap:20px;
}

.logout{
background:#8B5A2B;
padding:12px 28px;
border-radius:30px;
color:white;
text-decoration:none;
}

.logout:hover{
background:#6B4F3A;
}

/* Content */

.container{
width:90%;
margin:auto;
margin-top:70px;
}

.container h1{
font-size:50px;
color:#4D3322;
}

.container p{
font-size:22px;
margin-top:10px;
margin-bottom:40px;
}

/* Card */

.grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:30px;
}

.card{

background:white;
height:220px;
border:1px solid #ddd;
display:flex;
justify-content:center;
align-items:center;
flex-direction:column;
text-decoration:none;
color:#5A3A1E;
transition:.3s;
border-radius:10px;

}

.card:hover{

transform:translateY(-8px);
box-shadow:0 12px 20px rgba(0,0,0,.15);

}

.card i{

font-size:60px;
margin-bottom:20px;
color:#996633;

}

.card h2{

font-size:35px;

}

</style>

</head>

<body>

<nav>

<div class="logo">
<i class="fa-solid fa-book-open"></i> Ainibookstore
</div>

<div class="user">

<span>Halo, <b><?php echo $nama; ?></b> 👋</span>

<a href="logout.php" class="logout">Logout</a>

</div>

</nav>

<div class="container">

<h1>Selamat Datang di Dashboard</h1>

<p>Silakan pilih menu di bawah ini.</p>

<div class="grid">

<a href="buku/semua_buku.php" class="card">

<i class="fa-solid fa-book"></i>

<h2>Semua Buku</h2>

</a>

<a href="keranjang/keranjang.php" class="card">

<i class="fa-solid fa-cart-shopping"></i>

<h2>Keranjang</h2>

</a>

<a href="pesanan/riwayat.php" class="card">

<i class="fa-solid fa-box"></i>

<h2>Pesanan Saya</h2>

</a>

<a href="profil/profil.php" class="card">

<i class="fa-solid fa-user"></i>

<h2>Profil</h2>

</a>

</div>

</div>

</body>
</html>