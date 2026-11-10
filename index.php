<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ainibookstore</title>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 8px 0;
            font-size: 13px;
            color: #777;
        }

        .rating .bintang {
            color: #f5a623;
            font-weight: 600;
        }

        .rating .terjual {
            color: #888;
        }

        html {
            scroll-behavior: smooth;
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
            <a href="katalog.php">katalog</a>
            <a href="kategori.php">Kategori</a>
            <a href="tentang.php">Tentang</a>
            <a href="kontak.php">Kontak</a>
        </nav>

    </div>

<div class="menu">

        <!-- LOVE MENUJU BEST SELLER -->
        <a href="#best-seller"
           title="Best Seller"
           style="color: inherit; text-decoration: none;">
            <i class="fa-solid fa-heart"></i>
        </a>

        <!-- KERANJANG MENUJU LOGIN -->
        <a href="login.php"
           title="Login untuk melihat keranjang"
           style="color: inherit; text-decoration: none;">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>

        <a href="login.php">
            <button>Login</button>
        </a>

    </div>

</header>


<!-- HERO -->

<section class="hero">

    <div class="left">

        <h1>
            Temukan Buku Favoritmu di
            <span>Ainibookstore</span>
        </h1>

        <p>
            Di BookStore ini, kami menghadirkan beragam koleksi bacaan yang siap menemani perjalananmu dalam belajar, berimajinasi, dan menemukan inspirasi baru. Mari jelajahi setiap halaman dan temukan buku favoritmu bersama kami.
        </p>

        <button class="btn1">
            <a href="login.php" style="color: #fff; text-decoration: none;">
                Belanja Sekarang
            </a>
        </button>

    </div>

    <div class="right">
        <img src="gambar/Buku no bg.png" alt="Banner">
    </div>

</section>


<!-- KATEGORI -->

<section class="kategori">

    <h2>Kategori Populer</h2>

    <div class="kategori-box">

    <div class="card">
            <i class="fa-solid fa-book"></i>
            <h3>Novel</h3>
            <p>15 Buku</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-graduation-cap"></i>
            <h3>Pendidikan</h3>
            <p>10 Buku</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-briefcase"></i>
            <h3>Bisnis</h3>
            <p>5 Buku</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-child"></i>
            <h3>Anak</h3>
            <p>20 Buku</p>
        </div>

    </div>

</section>


<!-- BEST SELLER -->

<section class="best" id="best-seller">

    <h2>Best Seller</h2>

    <div class="produk">

        <!-- ATOMIC HABITS -->
        <div class="book">

            <img src="gambar/book Atomic.jpg" alt="Atomic Habits">

            <h3>Atomic Habits</h3>

            <p>James Clear</p>

            <div class="rating">
                <span class="bintang">⭐ 4.8</span>
                <span class="terjual">350 terjual</span>
            </div>

            <h4>Rp98.000</h4>

        </div>


        <!-- LAUT BERCERITA -->
        <div class="book">

            <img src="gambar/book laut.jpg" alt="Laut Bercerita">

            <h3>Laut Bercerita</h3>

            <p>Leila S. Chudori</p>

            <div class="rating">
                <span class="bintang">⭐ 4.9</span>
                <span class="terjual">500 terjual</span>
            </div>

            <h4>Rp89.000</h4>

        </div>


        <!-- BUMI -->
        <div class="book">

            <img src="gambar/book bumi.jpg" alt="Bumi">

            <h3>Bumi</h3>

            <p>Tere Liye</p>

            <div class="rating">
                <span class="bintang">⭐ 4.9</span>
                <span class="terjual">475 terjual</span>
            </div>

            <h4>Rp92.000</h4>

        </div>


        <!-- FILOSOFI TERAS -->
        <div class="book">

            <img src="gambar/book filosofi.jpg" alt="Filosofi Teras">

            <h3>Filosofi Teras</h3>

            <p>Henry Manampiring</p>

            <div class="rating">
                <span class="bintang">⭐ 4.7</span>
                <span class="terjual">280 terjual</span>
            </div>

            <h4>Rp95.000</h4>

        </div>

    </div>

</section>


</body>
</html>
