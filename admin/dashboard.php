<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// Hitung data
$totalBuku = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku"));
$totalKategori = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori"));
$totalUser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$totalPesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesanan"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#f4f6f9;
    font-family:'Poppins',sans-serif;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#212529;
    position:fixed;
    left:0;
    top:0;
    padding-top:20px;
}

.sidebar h3{
    color:white;
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px 25px;
    text-decoration:none;
    transition:.3s;
}

.sidebar a:hover{
    background:#0d6efd;
}

.main{
    margin-left:250px;
    padding:30px;
}

.card-box{
    border:none;
    border-radius:15px;
    color:white;
    padding:20px;
}

.icon{
    font-size:40px;
    float:right;
    opacity:.4;
}

</style>

</head>
<body>

<div class="sidebar">

<h3>
<i class="fa-solid fa-book"></i>
AiniBookStore
</h3>

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="kategori.php">
<i class="fa fa-list"></i>
Kategori
</a>

<a href="buku.php">
<i class="fa fa-book"></i>
Buku
</a>

<a href="user.php">
<i class="fa fa-users"></i>
User
</a>

<a href="pesanan.php">
    <i class="fa fa-cart-shopping"></i> Pesanan
</a>

<a href="pesan.php">
    <i class="fa fa-envelope"></i> Pesan Masuk
</a>

<a href="logout.php">
    <i class="fa fa-right-from-bracket"></i> Logout
</a>
onclick="return confirm('Apakah Anda yakin ingin logout?')">

<i class="fa-solid fa-right-from-bracket"></i>
Logout

</a>

</div>

<div class="main">

<h2 class="mb-4">
Dashboard Admin
</h2>

<div class="row">

<div class="col-md-3">

<div class="card card-box bg-primary">

<h5>Total Buku</h5>

<h2><?= $totalBuku ?></h2>

<div class="icon">
<i class="fa fa-book"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg-success">

<h5>Kategori</h5>

<h2><?= $totalKategori ?></h2>

<div class="icon">
<i class="fa fa-list"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg-warning">

<h5>User</h5>

<h2><?= $totalUser ?></h2>

<div class="icon">
<i class="fa fa-users"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg-danger">

<h5>Pesanan</h5>

<h2><?= $totalPesanan ?></h2>

<div class="icon">
<i class="fa fa-cart-shopping"></i>
</div>

</div>

</div>

</div>

<hr class="my-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

Pesanan Terbaru

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>Nama</th>
<th>Total</th>
<th>Status</th>
<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php

$data=mysqli_query($conn,"
SELECT pesanan.*,users.nama
FROM pesanan
JOIN users
ON pesanan.id_user=users.id
ORDER BY tanggal DESC
LIMIT 5
");

while($d=mysqli_fetch_array($data)){

?>

<tr>

<td><?= $d['id_pesanan']; ?></td>

<td><?= $d['nama']; ?></td>

<td>Rp<?= number_format($d['total'],0,",","."); ?></td>

<td>

<?php

$status=$d['status'];

if($status=="Menunggu"){

echo "<span class='badge bg-warning'>Menunggu</span>";

}elseif($status=="Diproses"){

echo "<span class='badge bg-primary'>Diproses</span>";

}elseif($status=="Selesai"){

echo "<span class='badge bg-success'>Selesai</span>";

}else{

echo "<span class='badge bg-danger'>$status</span>";

}

?>

</td>

<td><?= $d['tanggal']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>