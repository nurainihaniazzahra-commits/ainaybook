<?php

session_start();

include "../koneksi.php";

/* =========================
   CEK LOGIN USER
========================= */

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id'];

/* =========================
   AMBIL DATA PESANAN USER
========================= */

$query = mysqli_query($conn, "
    SELECT *
    FROM pesanan
    WHERE id_user = '$id_user'
    ORDER BY tanggal DESC
");

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pesanan Saya - AiniBookStore</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5efe6;
            font-family: Arial, sans-serif;
        }

        .container-pesanan {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .judul {
            text-align: center;
            margin-bottom: 30px;
            color: #4b3621;
        }

        .card-pesanan {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .table th {
            background: #4b3621;
            color: white;
        }

        .bukti-img {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .dikirim {
            background: #cfe2ff;
            color: #084298;
        }

        .selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .kosong {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 20px;
            background: #4b3621;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
        }

        .btn-kembali:hover {
            background: #2f2115;
            color: white;
        }

    </style>

</head>

<body>

<div class="container-pesanan">

    <a href="../index.php" class="btn-kembali">
        ← Kembali
    </a>

    <h2 class="judul">
        Pesanan Saya
    </h2>

    <div class="card-pesanan">

        <?php if (mysqli_num_rows($query) > 0) { ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Nama</th>

                            <th>Alamat</th>

                            <th>Telepon</th>

                            <th>Total</th>

                            <th>Pembayaran</th>

                            <th>Bukti Pembayaran</th>

                            <th>Status</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>

                        <tr>

                            <!-- ID -->
                            <td>
                                <?= htmlspecialchars($row['id_pesanan']); ?>
                            </td>

                            <!-- NAMA -->
                            <td>
                                <?= htmlspecialchars($row['nama']); ?>
                            </td>

                            <!-- ALAMAT -->
                            <td>
                                <?= htmlspecialchars($row['alamat']); ?>
                            </td>

                            <!-- TELEPON -->
                            <td>
                                <?= htmlspecialchars($row['telepon']); ?>
                            </td>

                            <!-- TOTAL -->
                            <td>
                                <strong>
                                    Rp<?= number_format(
                                        $row['total'],
                                        0,
                                        ",",
                                        "."
                                    ); ?>
                                </strong>
                            </td>

                            <!-- PEMBAYARAN -->
                            <td>
                                <?= htmlspecialchars(
                                    $row['metode_pembayaran']
                                ); ?>
                            </td>

                            <!-- BUKTI PEMBAYARAN -->
<td class="text-center">
    <?php if (!empty($row['bukti_pembayaran'])): ?>

    <a
        href="../uploads/bukti_pembayaran/<?= htmlspecialchars($row['bukti_pembayaran']); ?>"
        target="_blank"
        class="btn btn-sm btn-primary"
    >
        Lihat Bukti
    </a>

<?php else: ?>

    <span class="text-muted">Belum ada</span>

<?php endif; ?>
</td>

                            <!-- STATUS -->
                            <td>

                                <?php

                                $status = $row['status'];

                                if ($status == "Menunggu") {

                                    echo '<span class="status menunggu">
                                            Menunggu
                                          </span>';

                                } elseif ($status == "Dikirim") {

                                    echo '<span class="status dikirim">
                                            Dikirim
                                          </span>';

                                } elseif ($status == "Selesai") {

                                    echo '<span class="status selesai">
                                            Selesai
                                          </span>';

                                } else {

                                    echo '<span class="status menunggu">'
                                        . htmlspecialchars($status) .
                                        '</span>';

                                }

                                ?>

                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <?= htmlspecialchars($row['tanggal']); ?>
                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        <?php } else { ?>

            <div class="kosong">

                <h4>
                    Belum Ada Pesanan
                </h4>

                <p>
                    Kamu belum memiliki pesanan.
                </p>

                <a href="../katalog.php" class="btn btn-dark">
                    Lihat Buku
                </a>

            </div>

        <?php } ?>

    </div>

</div>

</body>

</html>