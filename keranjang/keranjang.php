<?php
session_start();
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Keranjang Saya</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    font-family:Poppins,sans-serif;
    background:#f8f3ec;
    margin:0;
}

.container{
    width:90%;
    margin:auto;
    padding:40px 0;
}

h1{
    text-align:center;
    color:#5d3c23;
    margin-bottom:40px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

th{
    background:#9c652f;
    color:white;
    padding:15px;
}

td{
    padding:15px;
    text-align:center;
}

img{
    width:70px;
    border-radius:8px;
}

.aksi a{
    text-decoration:none;
    padding:6px 12px;
    margin:0 5px;
    border-radius:6px;
    color:white;
}

.plus{
    background:green;
}

.minus{
    background:orange;
}

.hapus{
    background:red;
}

.checkout{
    display:inline-block;
    background:#9c652f;
    color:white;
    padding:15px 30px;
    text-decoration:none;
    border-radius:10px;
}

.button-container{
    display:flex;
    gap:15px;
    margin-top:30px;
}

.kembali{
    background:#9c652f;
    color:white;
    padding:15px 30px;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    font-family:Poppins,sans-serif;
}

.kembali:hover,
.checkout:hover{
    opacity:0.9;
}

.total{
    margin-top:20px;
    font-size:25px;
    font-weight:bold;
    color:#5d3c23;
    text-align:right;
}

</style>

</head>

<body>

<div class="container">

<h1>Keranjang Saya</h1>

<table>

<tr>
<th>Gambar</th>
<th>Judul</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Subtotal</th>
<th>Aksi</th>
</tr>

<?php

$total = 0;
$stok_habis = false;

if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){

foreach($_SESSION['cart'] as $id=>$jumlah){

$data=mysqli_query($conn,"SELECT * FROM buku WHERE id='$id'");
$buku=mysqli_fetch_assoc($data);

// Cek stok
if($buku['stok'] <= 0){
    $stok_habis = true;
}

$subtotal=$buku['harga']*$jumlah;
$total += $subtotal;

?>

<tr>

<td>
<img src="../gambar/<?php echo $buku['gambar']; ?>">
</td>

<td><?= $buku['judul']; ?></td>

<td>
Rp <?= number_format($buku['harga'],0,",","."); ?>
</td>

<td>

<a class="minus" href="kurang.php?id=<?= $id ?>">➖</a>

<?= $jumlah ?>

<a class="plus" href="tambah.php?id=<?= $id ?>">➕</a>

</td>

<td>

Rp <?= number_format($subtotal,0,",","."); ?>

</td>

<td class="aksi">

<a class="hapus"
href="hapus.php?id=<?= $id ?>"
onclick="return confirm('Hapus buku ini?')">

🗑 Hapus

</a>

</td>

</tr>

<?php
}

}else{

echo "<tr><td colspan='6'>Keranjang masih kosong.</td></tr>";

}

?>

</table>

<div class="total">

Total :
Rp <?= number_format($total,0,",","."); ?>

</div>

<?php if($stok_habis): ?>

    <div style="
        margin-top:30px;
        padding:15px;
        background:#ffe5e5;
        color:#c0392b;
        border-radius:10px;
        text-align:center;
        font-weight:bold;
    ">
        Stok telah habis
    </div>

<?php else: ?>

    <div class="button-container">
        <button class="kembali" onclick="history.back()">
            ← Kembali
        </button>

        <a class="checkout" href="../checkout.php">
            Checkout
        </a>
    </div>

<?php endif; ?>

</div>

</body>
</html>