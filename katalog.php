<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<header>

<div class="logo">
<i class="fa-solid fa-book-open"></i>
<h2>Ainibookstore</h2>
</div>

<nav>
<a href="index.php">Beranda</a>
<a href="katalog.php">Katalog</a>
<a href="kategori.php">Kategori</a>
<a href="tentang.php">Tentang</a>
<a href="kontak.php">Kontak</a>
</nav>

</header>

<section class="best">

<h2>Katalog Buku</h2>


<div class="produk">

<div class="book">


<img src="gambar/book Atomic.jpg">

<h3>Atomic Habits</h3>

<p>James Clear</p>

<h4>Rp98.000</h4>

<a href="detail.php?id=1">
    <button>Lihat Detail</button>
</a>

</div>

<div class="book">

<img src="gambar/book laut.jpg">

<h3>Laut Bercerita</h3>

<p>Leila S. Chudori</p>

<h4>Rp89.000</h4>

<a href="detail.php?id=2">
    <button>Lihat Detail</button>
</a>

</div>

<div class="book">

<img src="gambar/book bumi.jpg">

<h3>Bumi</h3>

<p>Tere Liye</p>

<h4>Rp92.000</h4>

<a href="detail.php?id=3">
    <button>Lihat Detail</button>
</a>

</div>

<div class="book">

<img src="gambar/book filosofi.jpg">

<h3>Filosofi Teras</h3>

<p>Henry Manampiring</p>

<h4>Rp95.000</h4>

<a href="detail.php?id=4">
    <button>Lihat Detail</button>
</a>

</div>

</div>

</section>

<script>
function cariBuku() {
    let input = document.getElementById("search").value.toLowerCase();

    let buku = document.querySelectorAll(".book");

    buku.forEach(function(item) {

        let judul = item.querySelector("h3").textContent.toLowerCase();

        if (judul.includes(input)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }

    });
}
</script>
</body>
</html>