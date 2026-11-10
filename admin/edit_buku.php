<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];

// Ambil data buku
$data = mysqli_query($conn,"SELECT * FROM buku WHERE id='$id'");
$buku = mysqli_fetch_assoc($data);

// Ambil kategori
$kategori = mysqli_query($conn,"SELECT * FROM kategori ORDER BY nama_kategori ASC");

if(isset($_POST['update'])){

    $kategori_id = $_POST['kategori_id'];
    $judul = mysqli_real_escape_string($conn,$_POST['judul']);
    $penulis = mysqli_real_escape_string($conn,$_POST['penulis']);
    $penerbit = mysqli_real_escape_string($conn,$_POST['penerbit']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = mysqli_real_escape_string($conn,$_POST['deskripsi']);

    $gambar = $buku['gambar'];

    if($_FILES['gambar']['name']!=""){

        $namaFile = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        $ext = strtolower(pathinfo($namaFile,PATHINFO_EXTENSION));

        $boleh = ['jpg','jpeg','png','webp'];

        if(in_array($ext,$boleh)){

            $gambarBaru = time()."_".$namaFile;

            move_uploaded_file($tmp,"../gambar/".$gambarBaru);

            if(file_exists("../gambar/".$gambar)){
                unlink("../gambar/".$gambar);
            }

            $gambar = $gambarBaru;

        }

    }

    mysqli_query($conn,"
    UPDATE buku SET

    kategori_id='$kategori_id',
    judul='$judul',
    penulis='$penulis',
    penerbit='$penerbit',
    harga='$harga',
    stok='$stok',
    gambar='$gambar',
    deskripsi='$deskripsi'

    WHERE id='$id'
    ");

    echo "<script>

    alert('Buku berhasil diupdate');

    window.location='buku.php';

    </script>";

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Edit Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.container{
max-width:850px;
margin-top:40px;
}

.card{
border:none;
border-radius:15px;
}

img{
border-radius:10px;
}

</style>

</head>

<body>

<div class="container">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Buku</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label>Kategori</label>

<select name="kategori_id" class="form-select">

<?php while($k=mysqli_fetch_assoc($kategori)){ ?>

<option
value="<?= $k['id']; ?>"
<?= $buku['kategori_id']==$k['id']?'selected':''; ?>>

<?= $k['nama_kategori']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Judul</label>

<input
type="text"
name="judul"
class="form-control"
value="<?= $buku['judul']; ?>">

</div>

<div class="mb-3">

<label>Penulis</label>

<input
type="text"
name="penulis"
class="form-control"
value="<?= $buku['penulis']; ?>">

</div>

<div class="mb-3">

<label>Penerbit</label>

<input
type="text"
name="penerbit"
class="form-control"
value="<?= $buku['penerbit']; ?>">

</div>

<div class="row">

<div class="col-md-6">

<label>Harga</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $buku['harga']; ?>">

</div>

<div class="col-md-6">

<label>Stok</label>

<input
type="number"
name="stok"
class="form-control"
value="<?= $buku['stok']; ?>">

</div>

</div>

<br>

<div class="mb-3">

<label>Gambar Saat Ini</label>

<br>

<img src="../gambar/<?= $buku['gambar']; ?>" width="120">

</div>

<div class="mb-3">

<label>Ganti Gambar</label>

<input
type="file"
name="gambar"
class="form-control">

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="5"><?= $buku['deskripsi']; ?></textarea>

</div>

<button
class="btn btn-success"
name="update">

Simpan Perubahan

</button>

<a href="buku.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>