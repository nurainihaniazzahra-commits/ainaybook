<?php

session_start();
include "koneksi.php";

$total = 0;
$stok_habis = false;
$pesan_stok = "";

if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $id => $jumlah) {

        $id = (int)$id;
        $jumlah = (int)$jumlah;

        $ambil = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
        $buku = mysqli_fetch_assoc($ambil);

        if (!$buku) {
            $stok_habis = true;
            $pesan_stok .= "Buku tidak ditemukan.<br>";
            continue;
        }

        if ($buku['stok'] <= 0) {

            $stok_habis = true;
            $pesan_stok .= $buku['judul'] . " - Stok telah habis.<br>";

        } elseif ($jumlah > $buku['stok']) {

            $stok_habis = true;
            $pesan_stok .= $buku['judul'] . " - Stok tidak mencukupi.<br>";

        } else {

            $total += $buku['harga'] * $jumlah;

        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .qris-container {
            display: none;
            background: #f5f8fc;
            border: 1px solid #dce5ef;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .qris-container h3 {
            color: #183b5b;
            margin-bottom: 10px;
        }

        .qris-image {
            width: 220px;
            height: 220px;
            object-fit: contain;
            background: white;
            padding: 10px;
            border-radius: 10px;
            margin: 15px auto;
        }

        .qris-total {
            font-size: 22px;
            font-weight: bold;
            color: #183b5b;
            margin: 12px 0;
        }

        .qris-keterangan {
            font-size: 13px;
            color: #555;
        }

    </style>

</head>

<body>

<header>

    <div class="logo">
        <h2>Ainibookstore</h2>
    </div>

</header>

<section>

    <div class="contact-form">

        <h2>Checkout Pesanan</h2>

        <?php if ($stok_habis): ?>

            <div style="background:#ffe5e5; color:#c0392b; padding:15px; border-radius:8px; margin-bottom:20px;">

                <strong>Stok telah habis</strong><br>

                <?= $pesan_stok ?>

            </div>

        <?php else: ?>

            <form action="payment.php" method="POST">

                <label>Nama Lengkap</label>

                <input type="text" name="nama" required>

                <label>Alamat</label>

                <textarea name="alamat" required></textarea>

                <label>No Telepon</label>

                <input type="number" name="telepon" required>

                <h3>
                    Total Pembayaran :
                    Rp<?= number_format($total, 0, ',', '.') ?>
                </h3>

                <input type="hidden" name="total" value="<?= $total ?>">

                <h3>Metode Pembayaran</h3>

                <div class="metode-pembayaran">

                    <label for="cod">

                        <span>COD (Bayar di Tempat)</span>

                        <input
                            type="radio"
                            id="cod"
                            name="payment"
                            value="COD"
                            required
                        >

                    </label>

                    <label for="transfer">

                        <span>Transfer Bank</span>

                        <input
                            type="radio"
                            id="transfer"
                            name="payment"
                            value="Transfer Bank"
                        >

                    </label>

                    <label for="ewallet">

                        <span>E-Wallet</span>

                        <input
                            type="radio"
                            id="ewallet"
                            name="payment"
                            value="E-Wallet"
                        >

                    </label>

                </div>

                <!-- QRIS E-WALLET -->

                <div class="qris-container" id="qrisContainer">

                    <h3>Pembayaran QRIS</h3>

                    <p>Scan QRIS menggunakan aplikasi E-Wallet kamu.</p>

                    <img
    class="qris-image"
    src="gambar/qris.jpg"
    alt="QRIS AiniBookStore"
>

                    <p>Total Pembayaran:</p>

                    <div class="qris-total">

                        Rp<?= number_format($total, 0, ',', '.') ?>

                    </div>

                    <p class="qris-keterangan">
                        QRIS ini hanya contoh tampilan dan belum dapat digunakan untuk transaksi sungguhan.
                    </p>

                </div>

                <br><br>

                <button type="submit" class="detail-btn">
                    Pesan Sekarang
                </button>

            </form>

        <?php endif; ?>

    </div>

</section>

<script>

    const cod = document.getElementById("cod");
    const transfer = document.getElementById("transfer");
    const ewallet = document.getElementById("ewallet");

    const qris = document.getElementById("qrisContainer");

    ewallet.addEventListener("change", function() {
        qris.style.display = "block";
    });

    cod.addEventListener("change", function() {
        qris.style.display = "none";
    });

    transfer.addEventListener("change", function() {
        qris.style.display = "none";
    });

</script>

</body>

</html>
