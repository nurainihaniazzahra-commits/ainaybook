<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =========================
   UPDATE STATUS PESANAN
========================= */

if(isset($_POST['update_status'])){

    $id_pesanan = $_POST['id_pesanan'];
    $status = $_POST['status'];

    // Status yang diperbolehkan
    $status_valid = ['Menunggu', 'Dikirim', 'Selesai'];

    if(in_array($status, $status_valid)){

        $stmt = mysqli_prepare($conn, 
            "UPDATE pesanan SET status = ? WHERE id_pesanan = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $id_pesanan
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    header("Location: pesanan.php");
    exit;
}


/* =========================
   AMBIL DATA PESANAN
========================= */

$query = mysqli_query($conn, "

    SELECT pesanan.*, users.nama AS nama_user

    FROM pesanan

    LEFT JOIN users

    ON pesanan.id_user = users.id

    ORDER BY pesanan.tanggal DESC

");

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Pesanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<style>

body{
    background:#f4f6f9;
}

.sidebar{
    width:240px;
    height:100vh;
    background:#212529;
    position:fixed;
}

.sidebar h3{
    color:white;
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px 25px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#0d6efd;
}

.content{
    margin-left:240px;
    padding:30px;
}

.card{
    border:none;
    border-radius:15px;
}

.status-form{
    display:flex;
    gap:8px;
    align-items:center;
}

.status-form select{
    min-width:120px;
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

    <a href="logout.php">
        <i class="fa fa-right-from-bracket"></i> Logout
    </a>

</div>


<!-- CONTENT -->

<div class="content">

    <h2 class="mb-4">
        Daftar Pesanan User
    </h2>


    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
<th>ID</th>
<th>Nama User</th>
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

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>

    <!-- ID -->
    <td>
        <?= $row['id_pesanan']; ?>
    </td>

    <!-- NAMA USER -->
    <td>
        <?= htmlspecialchars($row['nama_user'] ?? '-'); ?>
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
        Rp<?= number_format($row['total'], 0, ",", "."); ?>
    </td>

    <!-- PEMBAYARAN -->
    <td>
        <?= htmlspecialchars($row['metode_pembayaran'] ?? '-'); ?>
    </td>

    <!-- BUKTI PEMBAYARAN -->
    <td class="text-center">

        <?php if(!empty($row['bukti_pembayaran'])){ ?>

           <a
    href="../uploads/<?= htmlspecialchars($row['bukti_pembayaran']); ?>"
    target="_blank"
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
            cursor:pointer;
        "
    >

            <br>

            <small class="text-muted">
                Klik foto untuk melihat
            </small>

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
                value="<?= $row['id_pesanan']; ?>"
            >

            <select
                name="status"
                class="form-select form-select-sm"
            >

                <option
                    value="Menunggu"
                    <?= ($row['status'] == 'Menunggu') ? 'selected' : ''; ?>
                >
                    Menunggu
                </option>

                <option
                    value="Dikirim"
                    <?= ($row['status'] == 'Dikirim') ? 'selected' : ''; ?>
                >
                    Dikirim
                </option>

                <option
                    value="Selesai"
                    <?= ($row['status'] == 'Selesai') ? 'selected' : ''; ?>
                >
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


</body>

</html>