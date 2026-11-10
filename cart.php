<?php
session_start();
include "koneksi.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT keranjang.*, buku.*
FROM keranjang
JOIN buku ON keranjang.id_buku=buku.id
WHERE keranjang.id_user='$id_user'
");

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Keranjang</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{
background:#f8f3ec;
}

header{
background:#f3e7d3;
padding:25px 60px;
font-size:28px;
font-weight:bold;
color:#5d3c23;
}

.container{
width:90%;
margin:40px auto;
}

h1{
text-align:center;
color:#5d3c23;
margin-bottom:40px;
font-size:48px;
}

.card{

display:flex;
align-items:center;
gap:30px;

background:#fff;

padding:25px;

border-radius:25px;

box-shadow:0 10px 20px rgba(0,0,0,.08);

margin-bottom:25px;

}

.card img{

width:150px;

height:210px;

object-fit:cover;

border-radius:10px;

}

.info{

flex:1;

}

.info h2{

color:#4b2f1d;

margin-bottom:10px;

}

.info p{

font-size:24px;

margin:8px 0;

}

.hapus{

display:inline-block;

margin-top:15px;

background:#d63c3c;

color:white;

padding:10px 22px;

border-radius:12px;

text-decoration:none;

}

.total{

text-align:center;

font-size:55px;

font-weight:bold;

color:#4b2f1d;

margin:40px;

}

.checkout{

display:block;

width:280px;

margin:30px auto;

padding:18px;

background:#9c652f;

color:white;

text-decoration:none;

text-align:center;

border-radius:15px;

font-size:22px;

}

.checkout:hover{

background:#7c4f26;

}

</style>

</head>

<body>

<header>

📚 Ainibookstore

</header>

<div class="container">

<h1>Keranjang Belanja</h1>

<?php while($d=mysqli_fetch_array($query)){ ?>

<?php

$subtotal = $d['harga']*$d['jumlah'];

$total += $subtotal;

?>

<div class="card">

<img src="gambar/<?php echo $d['gambar']; ?>">

<div class="info">

<h2><?= $d['judul']; ?></h2>

<p>Harga : Rp<?= number_format($d['harga'],0,",","."); ?></p>

<p>Jumlah : <?= $d['jumlah']; ?></p>

<p>Subtotal : Rp<?= number_format($subtotal,0,",","."); ?></p>

<a class="hapus" href="hapus_cart.php?id=<?= $d['id']; ?>">

Hapus

</a>

</div>

</div>

<?php } ?>

<div class="total">

Total : Rp<?= number_format($total,0,",","."); ?>

</div>

<a class="checkout" href="checkout.php">

Checkout

</a>

</div>

</body>

</html>