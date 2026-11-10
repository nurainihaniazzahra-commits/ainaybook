<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    $cek = mysqli_query($conn,"SELECT * FROM kategori WHERE nama_kategori='$nama'");

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
        alert('Kategori sudah ada!');
        </script>";

    }else{

        mysqli_query($conn,"
        INSERT INTO kategori(nama_kategori)
        VALUES('$nama')
        ");

        echo "<script>
        alert('Kategori berhasil ditambahkan!');
        window.location='kategori.php';
        </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Kategori</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.container{
    max-width:600px;
    margin-top:50px;
}

.card{
    border:none;
    border-radius:15px;
}

</style>

</head>

<body>

<div class="container">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>
<i class="fa fa-plus"></i>
Tambah Kategori
</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Nama Kategori</label>

<input
type="text"
name="nama_kategori"
class="form-control"
placeholder="Masukkan nama kategori"
required>

</div>

<button
type="submit"
name="simpan"
class="btn btn-success">

<i class="fa fa-save"></i>

Simpan

</button>

<a href="kategori.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>