<?php

session_start();

include "../koneksi.php";

$id = $_SESSION['id'];

$data = mysqli_query($conn, "
    SELECT *
    FROM pesanan
    WHERE id_user='$id'
    ORDER BY id_pesanan DESC
");

if(!$data){
    die("Query Error : " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pesanan Saya - AiniBookStore</title>

<link rel="stylesheet" href="../style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f5f5;
    font-family:Arial, sans-serif;
}

.pesanan-container{
    width:90%;
    max-width:1000px;
    margin:40px auto;
}

.judul-halaman{
    font-size:28px;
    color:#4b3621;
    margin-bottom:25px;
}

/* CARD */

.pesanan-card{
    background:white;
    border-radius:12px;
    margin-bottom:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
    overflow:hidden;
}

/* HEADER */

.pesanan-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 20px;
    border-bottom:1px solid #eee;
}

.nomor-pesanan{
    font-weight:bold;
    color:#444;
}

.tanggal{
    color:#888;
    font-size:14px;
}

/* CONTENT */

.pesanan-content{
    padding:20px;
    display:flex;
    justify-content:space-between;
    gap:20px;
}

.buku-info{
    display:flex;
    gap:15px;
    align-items:center;
}

.buku-info img{
    width:90px;
    height:120px;
    object-fit:cover;
    border-radius:8px;
    border:1px solid #ddd;
}

.judul-buku{
    font-size:18px;
    font-weight:bold;
    color:#333;
    margin-bottom:8px;
}

.harga-buku{
    color:#777;
    margin-bottom:5px;
}

.jumlah{
    color:#888;
}

/* INFO KANAN */

.pesanan-kanan{
    text-align:right;
    min-width:220px;
}

.status{
    display:inline-block;
    padding:6px 14px;
    border-radius:20px;
    background:#fff3cd;
    color:#856404;
    font-size:14px;
    margin-bottom:12px;
}

.total-text{
    color:#777;
    font-size:14px;
}

.total{
    font-size:20px;
    font-weight:bold;
    color:#8b5e34;
    margin-top:3px;
}

.metode{
    color:#666;
    font-size:14px;
    margin-top:8px;
}

/* BUKTI PEMBAYARAN */

.bukti-pembayaran{
    margin-top:12px;
}

.bukti-pembayaran img{
    width:100px;
    height:75px;
    object-fit:cover;
    border-radius:8px;
    border:1px solid #ddd;
    display:block;
    margin-left:auto;
    margin-bottom:6px;
}

.btn-bukti{
    display:inline-block;
    padding:6px 10px;
    background:#4b3621;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:12px;
}

.btn-bukti:hover{
    background:#2f2115;
    color:white;
}

/* PESANAN KOSONG */

.kosong{
    background:white;
    padding:50px;
    text-align:center;
    border-radius:12px;
    color:#777;
}

/* RESPONSIVE */

@media(max-width:700px){

    .pesanan-container{
        width:94%;
    }

    .pesanan-content{
        flex-direction:column;
    }

    .pesanan-kanan{
        text-align:left;
        min-width:0;
    }

    .bukti-pembayaran img{
        margin-left:0;
    }

    .pesanan-top{
        flex-direction:column;
        align-items:flex-start;
        gap:5px;
    }

}

.tombol-kembali {
    width: 90%;
    max-width: 1000px;
    margin: 0 auto 40px;
}

.tombol-kembali a {
    display: inline-block;
    padding: 12px 22px;
    background: #8b5e34;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
}

.tombol-kembali a:hover {
    background: #4b3621;
}

/* TOMBOL FOTO BUKTI */
.btn-bukti-modal{
    display:inline-flex;
    flex-direction:column;
    align-items:flex-end;
    padding:0;
    border:0;
    background:transparent;
    cursor:pointer;
}

/* POP-UP BUKTI */
#buktiModal .modal-content{
    border:0;
    border-radius:14px;
    overflow:hidden;
}
#buktiModal .modal-header{
    background:#4b3621;
    color:#fff;
}
#buktiModal .modal-title{font-weight:bold;}
#buktiModal .btn-close{filter:brightness(0) invert(1);}
#gambarBukti{
    max-width:100%;
    max-height:75vh;
    object-fit:contain;
    border-radius:8px;
}
.btn-pdf-bukti{
    background:#4b3621;
    color:#fff;
    border:0;
    border-radius:7px;
    padding:9px 14px;
}
.btn-pdf-bukti:hover{background:#2f2115;color:#fff;}
</style>

</head>

<body>

<div class="pesanan-container">

<h1 class="judul-halaman">
    Pesanan Saya
</h1>


<?php if(mysqli_num_rows($data) == 0){ ?>

<div class="kosong">

    <h2>📦</h2>

    <h3>Belum ada pesanan</h3>

    <p>Pesanan kamu akan muncul di sini.</p>

</div>

<?php } ?>


<?php while($d = mysqli_fetch_assoc($data)){ ?>

<div class="pesanan-card">

    <!-- HEADER PESANAN -->

    <div class="pesanan-top">

        <div class="nomor-pesanan">

            📦 Pesanan #<?= $d['id_pesanan']; ?>

        </div>

        <div class="tanggal">

            <?= date("d M Y", strtotime($d['tanggal'])); ?>

        </div>

    </div>


    <!-- ISI PESANAN -->

    <div class="pesanan-content">


        <div class="buku-info">

        <?php

        $id_pesanan = $d['id_pesanan'];

        $detail = mysqli_query($conn, "

            SELECT
                pesanan_detail.*,
                buku.judul,
                buku.gambar

            FROM pesanan_detail

            JOIN buku

            ON pesanan_detail.id_buku = buku.id

            WHERE pesanan_detail.id_pesanan='$id_pesanan'

        ");

        ?>


        <?php if(mysqli_num_rows($detail) > 0){ ?>

        <?php

        $pertama = true;

        while($b = mysqli_fetch_assoc($detail)){

        ?>

            <?php if($pertama){ ?>

            <img
                src="../gambar/<?= htmlspecialchars($b['gambar']); ?>"
                alt="<?= htmlspecialchars($b['judul']); ?>"
            >

            <div>

                <div class="judul-buku">

                    <?= htmlspecialchars($b['judul']); ?>

                </div>

                <div class="harga-buku">

                    Rp<?= number_format($b['harga'],0,",","."); ?>

                </div>

                <div class="jumlah">

                    <?= $b['jumlah']; ?> buku

                </div>

            </div>

            <?php

            $pertama = false;

            }else{

            ?>

            <div>

                <div class="jumlah">

                    + <?= htmlspecialchars($b['judul']); ?>

                    × <?= $b['jumlah']; ?>

                </div>

            </div>

            <?php } ?>


        <?php } ?>


        <?php }else{ ?>

            <div>

                <div class="judul-buku">

                    Detail buku tidak tersedia

                </div>

                <div class="jumlah">

                    Pesanan lama

                </div>

            </div>

        <?php } ?>

        </div>


        <!-- BAGIAN KANAN -->

        <div class="pesanan-kanan">

            <div class="status">

                <?= htmlspecialchars($d['status']); ?>

            </div>

            <div class="total-text">

                Total Pesanan

            </div>

            <div class="total">

                Rp<?= number_format($d['total'],0,",","."); ?>

            </div>

            <div class="metode">

                💳 <?= htmlspecialchars($d['metode_pembayaran']); ?>

            </div>


            <!-- BUKTI PEMBAYARAN -->

            <?php if(!empty($d['bukti_pembayaran'])){ ?>

            <?php

            $nama_bukti = basename($d['bukti_pembayaran']);

            ?>

            <div class="bukti-pembayaran">

                <button
                    type="button"
                    class="btn-bukti-modal"
                    data-bs-toggle="modal"
                    data-bs-target="#buktiModal"
                    data-image="../uploads/<?= htmlspecialchars($nama_bukti, ENT_QUOTES); ?>"
                    aria-label="Lihat bukti pembayaran"
                >
                    <img
                        src="../uploads/<?= htmlspecialchars($nama_bukti); ?>"
                        alt="Bukti Pembayaran"
                    >
                    <span class="btn-bukti">Lihat Bukti</span>
                </button>

            </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php } ?>

</div>

<div class="tombol-kembali">
    <a href="/ainibookstore/dashboard.php">
        ← Kembali ke Dashboard
    </a>
</div>

<!-- POP-UP BUKTI PEMBAYARAN -->
<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="gambarBukti" src="" alt="Bukti Pembayaran">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn-pdf-bukti" onclick="simpanBuktiPDF()">Simpan sebagai PDF</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const buktiModal = document.getElementById('buktiModal');
const gambarBukti = document.getElementById('gambarBukti');

buktiModal.addEventListener('show.bs.modal', function(event) {
    const tombol = event.relatedTarget;
    gambarBukti.src = tombol.getAttribute('data-image');
});

buktiModal.addEventListener('hidden.bs.modal', function() {
    gambarBukti.src = '';
});

function simpanBuktiPDF() {
    if (!gambarBukti.src) {
        alert('Bukti pembayaran belum tersedia.');
        return;
    }

    const jendela = window.open('', '_blank');
    if (!jendela) {
        alert('Pop-up diblokir browser. Izinkan pop-up lalu coba lagi.');
        return;
    }

    const sumberGambar = gambarBukti.src;
    jendela.document.write(`<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Bukti Pembayaran AiniBook</title><style>body{margin:0;padding:24px;font-family:Arial,sans-serif;text-align:center;color:#493629}h2{margin-bottom:18px}img{display:block;max-width:100%;max-height:90vh;margin:0 auto;object-fit:contain}@page{margin:12mm}</style></head><body><h2>Bukti Pembayaran AiniBook</h2><img src="${sumberGambar}" alt="Bukti Pembayaran"><script>window.onload=function(){window.focus();window.print();};<\/script></body></html>`);
    jendela.document.close();
}
</script>

</body>

</html>