<?php
session_start();

$id = $_GET['id'];

$buku = [

1=>[
"gambar"=>"gambar/book Atomic.jpg",
"judul"=>"Atomic Habits",
"penulis"=>"James Clear",
"harga"=>"Rp98.000",
"kategori"=>"Pengembangan Diri",
"halaman"=>"352",
"tahun"=>"2019",
"stok"=>"20",
"sinopsis"=>"Atomic Habits menjelaskan bagaimana perubahan kecil yang dilakukan secara konsisten mampu menghasilkan perubahan besar dalam hidup."
],

2=>[
"gambar"=>"gambar/book laut.jpg",
"judul"=>"Laut Bercerita",
"penulis"=>"Leila S. Chudori",
"harga"=>"Rp89.000",
"kategori"=>"Novel",
"halaman"=>"400",
"tahun"=>"2017",
"stok"=>"18",
"sinopsis"=>"Novel yang menceritakan perjuangan para aktivis pada masa Orde Baru."
],

3=>[
"gambar"=>"gambar/book bumi.jpg",
"judul"=>"Bumi",
"penulis"=>"Tere Liye",
"harga"=>"Rp92.000",
"kategori"=>"Fantasi",
"halaman"=>"440",
"tahun"=>"2014",
"stok"=>"15",
"sinopsis"=>"Petualangan Raib bersama teman-temannya menjelajahi dunia paralel."
],

4=>[
"gambar"=>"gambar/book filosofi.jpg",
"judul"=>"Filosofi Teras",
"penulis"=>"Henry Manampiring",
"harga"=>"Rp95.000",
"kategori"=>"Psikologi",
"halaman"=>"320",
"tahun"=>"2018",
"stok"=>"12",
"sinopsis"=>"Belajar menghadapi masalah hidup dengan prinsip filsafat Stoik."
]

];

$data = $buku[$id];

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title><?php echo $data['judul']; ?></title>

<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
.btn-detail{
    display:flex !important;
    gap:20px !important;
    margin-top:30px !important;
}

.btn-detail .btn-kembali{
    display:inline-block !important;
    padding:14px 40px !important;
    background:#ddd !important;
    color:#222 !important;
    text-decoration:none !important;
    border-radius:15px !important;
    font-size:18px !important;
    border:none !important;
    transition:0.3s !important;
}

.btn-detail .btn-kembali:hover{
    background:#c8c8c8 !important;
    color:#222 !important;
}
</style>

</head>

<body>

<header>

<div class="left-header">

<div class="logo">
<i class="fa-solid fa-book-open"></i>
<h2>Ainibookstore</h2>
</div>


<nav>
<a href="index.php">Beranda</a>
<a href="katalog.php">Katalog</a>
<a href="kategori.php">Kategori</a>
</nav>


<?php ?>

</div>

</header>

<section class="detail">

<div class="detail-card">

    <div class="detail-img">
        <img src="<?php echo $data['gambar']; ?>">
    </div>

    <div class="detail-info">

        <h1><?php echo $data['judul']; ?></h1>

        <h3><?php echo $data['penulis']; ?></h3>

        <h2><?php echo $data['harga']; ?></h2>

        <div class="detail-data">

            <p><b>Kategori :</b> <?php echo $data['kategori']; ?></p>

            <p><b>Jumlah Halaman :</b> <?php echo $data['halaman']; ?></p>

            <p><b>Tahun Terbit :</b> <?php echo $data['tahun']; ?></p>

            <p><b>Stok :</b> <?php echo $data['stok']; ?></p>

        </div>

        <h3>Sinopsis</h3>

        <p class="sinopsis">
            <?php echo $data['sinopsis']; ?>
        </p>

        <div class="btn-detail">

    <a href="katalog.php" class="btn-kembali">
        Kembali
    </a>

</div>
</button>
</a>
        </div>

    </div>

</div>

</section>

</body>
</html>