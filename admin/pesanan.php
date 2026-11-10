
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// UPDATE STATUS PESANAN
if (isset($_POST['update_status'])) {

    $id_pesanan = (int) $_POST['id_pesanan'];
    $status = $_POST['status'];

    $status_valid = ['Menunggu', 'Dikirim', 'Selesai'];

    if (in_array($status, $status_valid, true)) {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE pesanan SET status = ? WHERE id_pesanan = ?"
        );

        mysqli_stmt_bind_param($stmt, "si", $status, $id_pesanan);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: pesanan.php");
    exit;
}

// AMBIL DATA PESANAN
$query = mysqli_query($conn, "
    SELECT pesanan.*, users.nama AS nama_user
    FROM pesanan
    LEFT JOIN users ON pesanan.id_user = users.id
    ORDER BY pesanan.tanggal DESC
");

if (!$query) {
    die("Gagal mengambil data pesanan: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Pesanan - AiniBookStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #212529;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h3 {
            color: white;
            text-align: center;
            padding: 20px 10px;
            font-size: 21px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px 25px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #0d6efd;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .status-form {
            display: flex;
            gap: 8px;
            align-items: center;
            min-width: 180px;
        }

        .status-form select {
            min-width: 110px;
        }

        .buku-item {
            border-bottom: 1px solid #eee;
            padding: 8px 0;
        }

        .buku-item:last-child {
            border-bottom: none;
        }

        .nama-buku {
            font-weight: 600;
            color: #243b53;
        }

        .detail-buku {
            font-size: 12px;
            color: #777;
            margin-top: 4px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }

            .content {
                margin-left: 180px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h3>
        <i class="fa fa-book"></i> AiniBookStore
    </h3>

    <a href="dashboard.php">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="kategori.php">
        <i class="fa fa-list"></i> Kategori
    </a>

    <a href="buku.php">
        <i class="fa fa-book"></i> Buku
    </a>

    <a href="user.php">
        <i class="fa fa-users"></i> User
    </a>

    <a href="pesanan.php">
        <i class="fa fa-cart-shopping"></i> Pesanan
    </a>

    <a href="pesan.php">
        <i class="fa fa-envelope"></i> Pesan Masuk
    </a>

    <a href="logout.php">
        <i class="fa fa-right-from-bracket"></i> Logout
    </a>

</div>

<!-- CONTENT -->
<div class="content">

    <h2 class="mb-4">
        <i class="fa fa-shopping-bag"></i>
        Daftar Pesanan User
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama User</th>
                            <th>Buku yang Dibeli</th>
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

                        <?php
                        $id_pesanan = (int) $row['id_pesanan'];

                        // AMBIL BUKU YANG DIBELI USER
                        $query_buku = mysqli_query($conn, "
                            SELECT
                                buku.judul,
                                pesanan_detail.jumlah
                            FROM pesanan_detail
                            INNER JOIN buku
                                ON pesanan_detail.id_buku = buku.id
                            WHERE pesanan_detail.id_pesanan = $id_pesanan
                        ");
                        ?>

                        <tr>

                            <!-- ID -->
                            <td>
                                <?= $id_pesanan; ?>
                            </td>

                            <!-- NAMA USER -->
                            <td>
                                <?= htmlspecialchars($row['nama_user'] ?? '-'); ?>
                            </td>

                            <!-- BUKU YANG DIBELI -->
                            <td style="min-width: 200px;">

                                <?php if (mysqli_num_rows($query_buku) > 0) { ?>

                                    <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>

                                        <div class="buku-item">

                                            <div class="nama-buku">
                                                <i class="fa fa-book text-primary"></i>
                                                <?= htmlspecialchars($buku['judul']); ?>
                                            </div>

                                            <div class="detail-buku">
                                                Jumlah:
                                                <?= (int) $buku['jumlah']; ?> buku
                                            </div>

                                        </div>

                                    <?php } ?>

                                <?php } else { ?>

                                    <span class="text-muted">
                                        Belum ada detail buku
                                    </span>

                                <?php } ?>

                            </td>

                            <!-- ALAMAT -->
                            <td>
                                <?= htmlspecialchars($row['alamat'] ?? '-'); ?>
                            </td>

                            <!-- TELEPON -->
                            <td>
                                <?= htmlspecialchars($row['telepon'] ?? '-'); ?>
                            </td>

                            <!-- TOTAL -->
                            <td>
                                Rp<?= number_format($row['total'], 0, ',', '.'); ?>
                            </td>

                            <!-- PEMBAYARAN -->
                            <td>
                                <?= htmlspecialchars($row['metode_pembayaran'] ?? '-'); ?>
                            </td>

                            <!-- BUKTI PEMBAYARAN -->
                            <td class="text-center">

                                <?php if (!empty($row['bukti_pembayaran'])) { ?>

                                    <button
                                        type="button"
                                        class="btn p-0 border-0 bg-transparent"
                                        data-bs-toggle="modal"
                                        data-bs-target="#buktiModal"
                                        data-image="../uploads/<?= htmlspecialchars($row['bukti_pembayaran'], ENT_QUOTES); ?>"
                                    >

                                        <img
                                            src="../uploads/<?= htmlspecialchars($row['bukti_pembayaran']); ?>"
                                            alt="Bukti Pembayaran"
                                            style="
                                                width:100px;
                                                height:80px;
                                                object-fit:cover;
                                                border-radius:8px;
                                                border:1px solid #ddd;
                                            "
                                        >

                                        <br>

                                        <small class="text-muted">
                                            Lihat bukti
                                        </small>

                                    </button>

                                <?php } else { ?>

                                    <span class="badge bg-secondary">
                                        Belum ada
                                    </span>

                                <?php } ?>

                            </td>

                            <!-- STATUS -->
                            <td>

                                <form method="POST" class="status-form">

                                    <input
                                        type="hidden"
                                        name="id_pesanan"
                                        value="<?= $id_pesanan; ?>"
                                    >

                                    <select
                                        name="status"
                                        class="form-select form-select-sm"
                                    >

                                        <option value="Menunggu"
                                            <?= ($row['status'] == 'Menunggu') ? 'selected' : ''; ?>>
                                            Menunggu
                                        </option>

                                        <option value="Dikirim"
                                            <?= ($row['status'] == 'Dikirim') ? 'selected' : ''; ?>>
                                            Dikirim
                                        </option>

                                        <option value="Selesai"
                                            <?= ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>
                                            Selesai
                                        </option>

                                    </select>

                                    <button
                                        type="submit"
                                        name="update_status"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Simpan
                                    </button>

                                </form>

                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <?= htmlspecialchars($row['tanggal'] ?? '-'); ?>
                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- POPUP BUKTI PEMBAYARAN -->
<div class="modal fade" id="buktiModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Bukti Pembayaran
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body text-center">

                <img
                    id="gambarBukti"
                    src=""
                    alt="Bukti Pembayaran"
                    style="max-width:100%; max-height:75vh; object-fit:contain;"
                >

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="simpanBuktiPDF()"
                >
                    <i class="fa-solid fa-file-pdf"></i>
                    Simpan sebagai PDF
                </button>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

// MENAMPILKAN BUKTI PEMBAYARAN
document.getElementById('buktiModal').addEventListener('show.bs.modal', function(event) {

    const tombol = event.relatedTarget;
    const gambar = tombol.getAttribute('data-image');

    document.getElementById('gambarBukti').src = gambar;

});

// MENGHAPUS GAMBAR SAAT POPUP DITUTUP
document.getElementById('buktiModal').addEventListener('hidden.bs.modal', function() {

    document.getElementById('gambarBukti').src = '';

});

// SIMPAN BUKTI PEMBAYARAN SEBAGAI PDF
function simpanBuktiPDF() {

    const gambar = document.getElementById('gambarBukti');

    if (!gambar.src) {
        alert('Bukti pembayaran belum tersedia.');
        return;
    }

    const jendela = window.open('', '_blank');

    if (!jendela) {
        alert('Pop-up diblokir browser. Izinkan pop-up terlebih dahulu.');
        return;
    }

    jendela.document.write(`
        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <title>Bukti Pembayaran AiniBook</title>

            <style>
                body {
                    margin: 0;
                    padding: 24px;
                    font-family: Arial, sans-serif;
                    text-align: center;
                    color: #493629;
                }

                img {
                    display: block;
                    max-width: 100%;
                    max-height: 90vh;
                    margin: 0 auto;
                    object-fit: contain;
                }

                @page {
                    margin: 12mm;
                }
            </style>
        </head>

        <body>

            <h2>Bukti Pembayaran AiniBook</h2>

            <img src="${gambar.src}" alt="Bukti Pembayaran">

            <script>
                window.onload = function() {
                    window.focus();
                    window.print();
                };
            <\/script>

        </body>
        </html>
    `);

    jendela.document.close();
}

</script>

</body>
</html>
