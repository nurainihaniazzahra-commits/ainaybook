<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$kategori = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    mysqli_query($conn,"
    UPDATE kategori
    SET nama_kategori='$nama'
    WHERE id='$id'
    ");

    echo "<script>
    alert('Kategori berhasil diubah!');
    window.location='kategori.php';
    </script>";

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Kategori</title>

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

<div class="card-header bg-warning text-dark">

<h4>
<i class="fa fa-edit"></i>
Edit Kategori
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
value="<?= $kategori['nama_kategori']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

<i class="fa fa-save"></i>

Simpan Perubahan

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