<?php

include "../koneksi.php";

if(!isset($_GET['id'])){
    header("Location: semua_buku.php");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($conn, "
    SELECT buku.*, kategori.nama_kategori
    FROM buku
    LEFT JOIN kategori
        ON buku.kategori_id = kategori.id
    WHERE buku.id = $id
");

if(mysqli_num_rows($query) == 0){
    echo "Buku tidak ditemukan.";
    exit;
}

$buku = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($buku['judul']); ?> | AiniBookStore</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    font-family:Poppins,sans-serif;
    background:#f8f3ec;
    margin:0;
    color:#5d3c23;
}

.container{
    width:90%;
    max-width:1100px;
    margin:auto;
    padding:50px 0;
}


/* DETAIL */

.detail{
    background:white;
    border-radius:25px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);

    display:grid;
    grid-template-columns:380px 1fr;
    gap:50px;
}


/* GAMBAR */

.gambar{
    text-align:center;
}

.gambar img{
    width:100%;
    max-width:350px;
    height:480px;
    object-fit:cover;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}


/* INFO */

.info h1{
    font-size:38px;
    margin:0 0 10px;
    color:#5d3c23;
}

.penulis{
    font-size:18px;
    color:#777;
    margin-bottom:25px;
}

.harga{
    font-size:30px;
    font-weight:bold;
    color:#9c652f;
    margin:20px 0;
}

.info-item{
    display:grid;
    grid-template-columns:130px 1fr;
    margin:10px 0;
    font-size:16px;
}

.info-item strong{
    color:#5d3c23;
}

.stok{
    color:green;
    font-weight:600;
}


/* SINOPSIS */

.sinopsis{
    margin-top:35px;
}

.sinopsis h2{
    color:#5d3c23;
    margin-bottom:10px;
}

.sinopsis p{
    color:#666;
    line-height:1.8;
}


/* BUTTON */

.tombol{
    display:flex;
    gap:15px;
    margin-top:30px;
}

.btn{
    display:inline-block;
    background:#9c652f;
    color:white;
    text-decoration:none;
    padding:14px 25px;
    border-radius:12px;
    transition:.3s;
    font-weight:600;
}

.btn:hover{
    background:#7b4f24;
    transform:translateY(-2px);
}

.btn-kembali{
    background:#ddd;
    color:#5d3c23;
}

.btn-kembali:hover{
    background:#ccc;
}


/* RESPONSIVE */

@media(max-width:800px){

    .detail{
        grid-template-columns:1fr;
        padding:25px;
    }

    .gambar img{
        height:400px;
    }

    .info h1{
        font-size:30px;
    }

}

</style>

</head>


<body>


<div class="container">

    <div class="detail">


        <!-- GAMBAR BUKU -->

        <div class="gambar">

            <img
                src="../gambar/<?= htmlspecialchars($buku['gambar']); ?>"
                alt="<?= htmlspecialchars($buku['judul']); ?>"
            >

        </div>


        <!-- INFORMASI BUKU -->

        <div class="info">

            <h1>
                <?= htmlspecialchars($buku['judul']); ?>
            </h1>


            <p class="penulis">
                <i class="fa-solid fa-user"></i>
                <?= htmlspecialchars($buku['penulis']); ?>
            </p>


            <div class="harga">

                Rp <?= number_format($buku['harga'],0,",","."); ?>

            </div>


            <div class="info-item">

    <strong>Kategori</strong>

    <span>
        <?= htmlspecialchars($buku['nama_kategori']); ?>
    </span>

</div>


            <div class="info-item">

                <strong>Penerbit</strong>

                <span>
                    <?= htmlspecialchars($buku['penerbit']); ?>
                </span>

            </div>


            <div class="info-item">

                <strong>Stok</strong>

                <span class="stok">
                    <?= $buku['stok']; ?>
                </span>

            </div>


            <div class="sinopsis">

                <h2>
                    Sinopsis
                </h2>

                <p>
                    <?= nl2br(htmlspecialchars($buku['deskripsi'])); ?>
                </p>

            </div>


            <div class="tombol">

                <a
                    href="../keranjang/tambah.php?id=<?= $buku['id']; ?>"
                    class="btn"
                >
                    <i class="fa-solid fa-cart-shopping"></i>
                    Tambah Keranjang
                </a>


                <a
                    href="semua_buku.php"
                    class="btn btn-kembali"
                >
                    ← Kembali
                </a>

            </div>


        </div>

    </div>

</div>


</body>

</html>