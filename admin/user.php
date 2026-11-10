<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data User</title>

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
    color:white;
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
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

.table th{
    background:#0d6efd;
    color:white;
    text-align:center;
}

.table td{
    vertical-align:middle;
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

<a href="logout.php"
onclick="return confirm('Yakin ingin logout?')">

<i class="fa fa-right-from-bracket"></i>

Logout

</a>

</div>

<div class="content">

<h2 class="mb-4">
<i class="fa fa-users"></i>
Data User
</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th width="60">No</th>

<th>Nama</th>

<th>Email</th>


</tr>

</thead>

<tbody>

<?php

$no=1;

while($user=mysqli_fetch_assoc($query)){

?>

<tr>

<td class="text-center"><?= $no++; ?></td>

<td><?= $user['nama']; ?></td>

<td><?= $user['email']; ?></td>


</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>