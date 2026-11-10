<?php

session_start();
include "../koneksi.php";

$id = $_SESSION['id'];

$data = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profil Saya</title>

<link rel="stylesheet" href="../style.css">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<header>

<div class="logo">
    <i class="fa-solid fa-book-open"></i>
    <h2>Ainibookstore</h2>
</div>

<nav>
    <a href="../index.php">Beranda</a>
    <a href="../katalog.php">Katalog</a>
    <a href="../cart.php">Keranjang</a>
</nav>

</header>

<section>

<div class="profile-card">

<h1>
<i class="fa-solid fa-user"></i>
Profil Saya
</h1>

<p><strong>Nama :</strong> <?= $user['nama']; ?></p>

<p><strong>Email :</strong> <?= $user['email']; ?></p>

<p><strong>Role :</strong> <?= ucfirst($user['role']); ?></p>

<a href="../index.php">
<button class="detail-btn">
Kembali ke Beranda
</button>
</a>

</div>

</section>

</body>

</html>