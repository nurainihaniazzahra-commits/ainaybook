
<?php
include "../koneksi.php";

// Pencarian dan filter
$keyword = trim($_GET['cari'] ?? '');
$kategori_id = trim($_GET['kategori'] ?? '');

// Ambil kategori
$daftar_kategori = mysqli_query($conn, "
    SELECT id, nama_kategori
    FROM kategori
    ORDER BY nama_kategori ASC
");

// Query buku
$sql = "SELECT buku.*, kategori.nama_kategori
        FROM buku
        LEFT JOIN kategori
        ON buku.kategori_id = kategori.id
        WHERE 1=1";

if ($keyword !== '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $sql .= " AND buku.judul LIKE '%$keyword_aman%'";
}

if ($kategori_id !== '' && ctype_digit($kategori_id)) {
    $sql .= " AND buku.kategori_id = " . (int)$kategori_id;
}

$sql .= " ORDER BY buku.id DESC";

$data = mysqli_query($conn, $sql);

if (!$data) {
    die("Gagal mengambil data buku: " . mysqli_error($conn));
}

$total_buku = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Semua Buku - AiniBookStore</title>

<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Poppins, sans-serif;
    background: #f8f3ec;
    margin: 0;
    color: #3f3025;
}

.container {
    width: 90%;
    max-width: 1500px;
    margin: auto;
    padding: 35px 0 40px;
}

/* JUDUL */
.page-heading {
    text-align: center;
    margin-bottom: 50px;
}

h1 {
    color: #5d3c23;
    margin: 0;
    font-size: 42px;
    font-weight: 700;
}

/* PENCARIAN */
.filter-box {
    max-width: 950px;
    margin: 0 auto 38px;
    background: white;
    padding: 20px;
    border: 1px solid #e8d2b8;
    border-radius: 18px;
    box-shadow: 0 5px 18px rgba(0,0,0,.06);
}

.filter-form {
    display: grid;
    grid-template-columns: minmax(180px,1fr) 230px auto auto;
    gap: 12px;
    align-items: center;
}

.search-wrap {
    position: relative;
}

.search-wrap i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9c652f;
}

.filter-form input,
.filter-form select {
    width: 100%;
    height: 48px;
    padding: 0 14px;
    border: 1px solid #ddc6aa;
    border-radius: 10px;
    background: white;
    font: inherit;
    color: #4a3828;
    outline: none;
}

.filter-form input {
    padding-left: 42px;
}

.filter-form input:focus,
.filter-form select:focus {
    border-color: #9c652f;
    box-shadow: 0 0 0 3px rgba(156,101,47,.12);
}

/* TOMBOL FILTER */
.filter-btn,
.reset-btn {
    height: 48px;
    padding: 0 20px;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font: 600 14px Poppins, sans-serif;
    cursor: pointer;
    white-space: nowrap;
    transition: .3s;
}

.filter-btn {
    background: #9c652f;
    color: white;
}

.filter-btn:hover {
    background: #7b4f24;
}

.reset-btn {
    background: #f0e7dc;
    color: #6a482b;
}

.reset-btn:hover {
    background: #e7d8c6;
}

/* INFO HASIL */
.result-info {
    max-width: 950px;
    margin: -20px auto 28px;
    color: #766657;
    font-size: 14px;
}

/* GRID BUKU */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

/* KARTU */
.card {
    background: white;
    border: 1px solid #ead7c1;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
    transition: .3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,.12);
}

.card img {
    width: 100%;
    height: 320px;
    object-fit: contain;
    padding: 18px 18px 0;
}

.isi {
    padding: 20px;
    text-align: center;
}

.isi h3 {
    margin: 10px 0;
    color: #5d3c23;
    font-size: 19px;
}

.isi p {
    margin: 6px 0;
    color: #666;
}

.kategori-label {
    display: inline-block;
    background: #f4eadc;
    color: #80552f;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    margin: 4px 0 8px;
}

.harga {
    color: #9c652f !important;
    font-size: 22px;
    font-weight: bold;
}

.stok {
    color: #43834d !important;
    font-weight: 600;
}

/* TOMBOL BUKU */
.btn {
    display: block;
    margin-top: 12px;
    background: #9c652f;
    color: white;
    text-decoration: none;
    padding: 12px;
    border-radius: 10px;
    transition: .3s;
}

.btn:hover {
    background: #7b4f24;
}

/* BUKU KOSONG */
.empty {
    grid-column: 1/-1;
    text-align: center;
    background: white;
    border: 1px dashed #d7b995;
    border-radius: 18px;
    padding: 45px 20px;
    color: #786553;
}

.empty i {
    font-size: 38px;
    color: #b58a5b;
    margin-bottom: 12px;
}

.empty h3 {
    color: #5d3c23;
    margin: 8px 0;
}

/* KEMBALI KE DASHBOARD */
.bottom-back {
    display: flex;
    justify-content: center;
    margin-top: 50px;
    padding-bottom: 20px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 13px 30px;
    border-radius: 10px;
    background: #6b4f3a;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: .3s;
}

.back-btn:hover {
    background: #4f3828;
    transform: translateY(-2px);
}

/* RESPONSIVE */
@media(max-width: 900px) {
    .filter-form {
        grid-template-columns: 1fr 1fr;
    }

    .search-wrap {
        grid-column: 1/-1;
    }
}

@media(max-width: 600px) {
    .container {
        width: 92%;
        padding-top: 25px;
    }

    .page-heading {
        margin-bottom: 30px;
    }

    h1 {
        font-size: 30px;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .search-wrap {
        grid-column: auto;
    }

    .filter-btn,
    .reset-btn {
        width: 100%;
    }

    .grid {
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 15px;
    }

    .card img {
        height: 210px;
    }

    .isi {
        padding: 12px;
    }

    .isi h3 {
        font-size: 15px;
    }

    .harga {
        font-size: 17px;
    }

    .btn {
        font-size: 12px;
        padding: 10px 5px;
    }
}

@media(max-width: 360px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body>

<div class="container">

    <!-- JUDUL -->
    <div class="page-heading">
        <h1>Semua Buku</h1>
    </div>

    <!-- PENCARIAN DAN KATEGORI -->
    <div class="filter-box">

        <form method="GET" action="" class="filter-form">

            <div class="search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="search"
                    name="cari"
                    placeholder="Cari berdasarkan judul buku..."
                    value="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>"
                >
            </div>

            <select name="kategori">
                <option value="">Semua Kategori</option>

                <?php while($kat = mysqli_fetch_assoc($daftar_kategori)){ ?>
                    <option
                        value="<?= (int)$kat['id']; ?>"
                        <?= ($kategori_id !== '' && (int)$kategori_id === (int)$kat['id']) ? 'selected' : ''; ?>
                    >
                        <?= htmlspecialchars($kat['nama_kategori'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" class="filter-btn">
                <i class="fa-solid fa-filter"></i>
                Cari
            </button>

            <a href="semua_buku.php" class="reset-btn">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
            </a>

        </form>
    </div>

    <!-- JUMLAH BUKU -->
    <div class="result-info">

        Menampilkan <?= $total_buku; ?> buku

        <?php if($keyword !== ''){ ?>
            untuk judul
            "<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>"
        <?php } ?>

        <?php if($kategori_id !== '' && ctype_digit($kategori_id)){ ?>
            dalam kategori yang dipilih
        <?php } ?>.

    </div>

    <!-- DAFTAR BUKU -->
    <div class="grid">

        <?php if($total_buku > 0){ ?>

            <?php while($d = mysqli_fetch_assoc($data)){ ?>

                <div class="card">

                    <img
                        src="../gambar/<?= htmlspecialchars($d['gambar'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Sampul <?= htmlspecialchars($d['judul'], ENT_QUOTES, 'UTF-8'); ?>"
                    >

                    <div class="isi">

                        <span class="kategori-label">
                            <?= htmlspecialchars($d['nama_kategori'] ?? 'Tanpa kategori', ENT_QUOTES, 'UTF-8'); ?>
                        </span>

                        <h3>
                            <a
                                href="detail_buku.php?id=<?= (int)$d['id']; ?>"
                                style="text-decoration:none;color:#5d3c23;"
                            >
                                <?= htmlspecialchars($d['judul'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h3>

                        <p>
                            <?= htmlspecialchars($d['penulis'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                        <p class="harga">
                            Rp <?= number_format((int)$d['harga'], 0, ',', '.'); ?>
                        </p>

                        <p class="stok">
                            Stok : <?= (int)$d['stok']; ?>
                        </p>

                        <a
                            class="btn"
                            href="detail_buku.php?id=<?= (int)$d['id']; ?>"
                        >
                            <i class="fa-solid fa-book-open"></i>
                            Lihat Detail
                        </a>

                        <a
                            class="btn"
                            href="../keranjang/tambah.php?id=<?= (int)$d['id']; ?>"
                        >
                            <i class="fa-solid fa-cart-shopping"></i>
                            Tambah Keranjang
                        </a>

                    </div>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="empty">

                <i class="fa-solid fa-book-open"></i>

                <h3>Buku tidak ditemukan</h3>

                <p>Coba kata kunci atau kategori lainnya.</p>

                <a
                    href="semua_buku.php"
                    class="btn"
                    style="max-width:180px;margin:18px auto 0;"
                >
                    Lihat Semua Buku
                </a>

            </div>

        <?php } ?>

    </div>

    <!-- TOMBOL KEMBALI KE DASHBOARD -->
    <div class="bottom-back">

        <a href="../dashboard.php" class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali ke Dashboard

        </a>

    </div>

</div>

</body>
</html>
