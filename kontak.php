<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kontak | Ainibookstore</title>

<link rel="stylesheet" href="style.css">

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
<a href="index.php">Beranda</a>
<a href="katalog.php">Katalog</a>
<a href="kategori.php">Kategori</a>
<a href="tentang.php">Tentang</a>
<a href="kontak.php">Kontak</a>
</nav>

</header>

<section class="contact">

<div class="contact-info">

<h1>Hubungi Kami</h1>

<p>
Kami siap membantu jika Anda memiliki pertanyaan, kritik, maupun saran.
Silakan hubungi kami melalui informasi berikut atau kirimkan pesan menggunakan formulir.
</p>

<div class="info-item">
<i class="fa-solid fa-location-dot"></i>
<div>
<h3>Alamat</h3>
<p>Jl. kenangan No.123, Jakarta, Indonesia</p>
</div>
</div>

<div class="info-item">
<i class="fa-solid fa-phone"></i>
<div>
<h3>Telepon</h3>
<p>+62 813-8415-9384</p>
</div>
</div>

<div class="info-item">
<i class="fa-solid fa-envelope"></i>
<div>
<h3>Email</h3>
<p>ainibookstore@gmail.com</p>
</div>
</div>

</div>

<div class="contact-form">

    <h2>Kirim Pesan</h2>

    <form action="proses_pesan.php" method="POST">

        <input
            type="text"
            name="nama"
            placeholder="Nama Lengkap"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <textarea
            name="pesan"
            rows="6"
            placeholder="Tulis pesan Anda..."
            required
        ></textarea>

        <button type="submit">
            <i class="fa-solid fa-paper-plane"></i>
            Kirim Pesan
        </button>

    </form>

</div>

</form>

</div>

</section>

<footer>

<p>© 2026 Ainibookstore | Semua Hak Dilindungi</p>

</footer>

</body>
</html>