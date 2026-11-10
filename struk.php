<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];
$id_pesanan = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data pesanan
$query = mysqli_prepare($conn, "
    SELECT * FROM pesanan
    WHERE id_pesanan = ? AND id_user = ?
");

mysqli_stmt_bind_param($query, "ii", $id_pesanan, $id_user);
mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);
$pesanan = mysqli_fetch_assoc($result);

if (!$pesanan) {
    die("Pesanan tidak ditemukan!");
}

// Ambil detail buku
$detail = mysqli_prepare($conn, "
    SELECT
        buku.judul,
        pesanan_detail.harga,
        pesanan_detail.jumlah
    FROM pesanan_detail
    JOIN buku ON pesanan_detail.id_buku = buku.id
    WHERE pesanan_detail.id_pesanan = ?
");

mysqli_stmt_bind_param($detail, "i", $id_pesanan);
mysqli_stmt_execute($detail);

$result_detail = mysqli_stmt_get_result($detail);

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk AiniBook</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 30px;
    background: #f4f0eb;
    font-family: Arial, sans-serif;
    color: #493629;
}

.container {
    max-width: 650px;
    margin: auto;
}

.tombol {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.btn {
    padding: 11px 20px;
    border-radius: 7px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
}

.kembali {
    background: #e3d5c5;
    color: #493629;
}

.cetak {
    background: #79583f;
    color: white;
}

.struk {
    background: white;
    padding: 35px;
    border: 1px dashed #a58a70;
    border-radius: 8px;
}

.header {
    text-align: center;
    border-bottom: 1px dashed #a58a70;
    padding-bottom: 20px;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
    color: #79583f;
    font-size: 27px;
}

.header p {
    margin: 7px 0 0;
    font-size: 13px;
    color: #887766;
}

.info {
    display: flex;
    justify-content: space-between;
    margin: 9px 0;
    font-size: 13px;
    gap: 15px;
}

.info span:last-child {
    text-align: right;
    font-weight: bold;
}

.garis {
    border-top: 1px dashed #bba995;
    margin: 20px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

th {
    background: #f1e8de;
    padding: 12px 8px;
    text-align: left;
}

td {
    padding: 12px 8px;
    border-bottom: 1px solid #eee5dc;
}

.kanan {
    text-align: right;
}

.total {
    display: flex;
    justify-content: space-between;
    font-size: 17px;
    font-weight: bold;
    margin-top: 20px;
    color: #79583f;
}

.footer {
    text-align: center;
    margin-top: 35px;
    border-top: 1px dashed #a58a70;
    padding-top: 20px;
    font-size: 13px;
    color: #887766;
}

@media print {
    body {
        background: white;
        padding: 0;
    }

    .container {
        max-width: 100%;
    }

    .tombol {
        display: none;
    }

    .struk {
        border: none;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="tombol">
        <a href="pesanan/riwayat.php" class="btn kembali">
            ← Kembali
        </a>

        <button onclick="window.print()" class="btn cetak">
            Cetak Struk
        </button>
    </div>

    <div class="struk">

        <div class="header">
            <h2>📚 AiniBook</h2>
            <p>Struk / Bukti Pesanan</p>
        </div>

        <div class="info">
            <span>No. Pesanan</span>
            <span>#<?= str_pad($pesanan['id_pesanan'], 5, '0', STR_PAD_LEFT) ?></span>
        </div>

        <div class="info">
            <span>Tanggal</span>
            <span><?= date('d F Y H:i', strtotime($pesanan['tanggal'])) ?></span>
        </div>

        <div class="info">
            <span>Nama Pemesan</span>
            <span><?= htmlspecialchars($pesanan['nama']) ?></span>
        </div>

        <div class="info">
            <span>Metode Bayar</span>
            <span><?= htmlspecialchars($pesanan['metode_pembayaran']) ?></span>
        </div>

        <div class="info">
            <span>Alamat</span>
            <span><?= htmlspecialchars($pesanan['alamat']) ?></span>
        </div>

        <div class="garis"></div>

        <h4>Detail Pesanan</h4>

        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th class="kanan">Qty</th>
                    <th class="kanan">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($buku = mysqli_fetch_assoc($result_detail)) : ?>

                <tr>
                    <td>
                        <?= htmlspecialchars($buku['judul']) ?>
                        <br>
                        <small><?= rupiah($buku['harga']) ?></small>
                    </td>

                    <td class="kanan">
                        <?= $buku['jumlah'] ?>
                    </td>

                    <td class="kanan">
                        <?= rupiah($buku['harga'] * $buku['jumlah']) ?>
                    </td>
                </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="garis"></div>

        <div class="total">
            <span>Total Pembayaran</span>
            <span><?= rupiah($pesanan['total']) ?></span>
        </div>

        <div class="footer">
            <strong>Terima kasih telah berbelanja di AiniBook!</strong>
            <p>Selamat membaca dan semoga harimu menyenangkan 📖</p>
        </div>

    </div>

</div>

</body>
</html>
