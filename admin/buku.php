<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$query = mysqli_query($conn,"
SELECT buku.*, kategori.nama_kategori
FROM buku
LEFT JOIN kategori
ON buku.kategori_id = kategori.id
ORDER BY buku.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    width:240px;
    height:100vh;
    background:#212529;
    position:fixed;
    top:0;
    left:0;
}

.sidebar h3{
    color:#fff;
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:#fff;
    padding:15px 25px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#0d6efd;
}

.content{
    margin-left:240px;
    padding:30px;
}

.card{
    border:none;
    border-radius:15px;
}

table th{
    background:#0d6efd;
    color:white;
    text-align:center;
}

table td{
    vertical-align:middle;
}

img{
    border-radius:8px;
}

</style>

</head>
<body>

<div class="sidebar">

<h3><i class="fa fa-book"></i> AiniBookStore</h3>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="kategori.php"><i class="fa fa-list"></i> Kategori</a>
<a href="buku.php"><i class="fa fa-book"></i> Buku</a>
<a href="user.php"><i class="fa fa-users"></i> User</a>
<a href="pesanan.php"><i class="fa fa-cart-shopping"></i> Pesanan</a>
<a href="pesan.php"><i class="fa fa-envelope"></i> Pesan Masuk</a>
<a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>

</div>

<div class="content">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Data Buku</h2>

<a href="tambah_buku.php" class="btn btn-success">
<i class="fa fa-plus"></i>
Tambah Buku
</a>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th width="50">No</th>
<th>Gambar</th>
<th>Judul</th>
<th>Penulis</th>
<th>Kategori</th>
<th>Harga</th>
<th>Stok</th>
<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($buku=mysqli_fetch_assoc($query)){

?>

<tr>

<td class="text-center"><?= $no++; ?></td>

<td align="center">

<?php if($buku['gambar']!=""){ ?>

<img src="../gambar/<?= $buku['gambar']; ?>" width="70" height="100">

<?php }else{ ?>

<img src="../gambar/no-image.png" width="70">

<?php } ?>

</td>

<td><?= $buku['judul']; ?></td>

<td><?= $buku['penulis']; ?></td>

<td><?= $buku['nama_kategori']; ?></td>

<td>
Rp<?= number_format($buku['harga'],0,",","."); ?>
</td>

<td class="text-center">
<?= $buku['stok']; ?>
</td>

<td class="text-center">

<a href="edit_buku.php?id=<?= $buku['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

Edit

</a>

<a href="hapus_buku.php?id=<?= $buku['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus buku ini?')">

<i class="fa fa-trash"></i>

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>