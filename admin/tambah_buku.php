<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// Ambil kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

if(isset($_POST['simpan'])){

    $kategori_id = $_POST['kategori_id'];
    $judul       = mysqli_real_escape_string($conn,$_POST['judul']);
    $penulis     = mysqli_real_escape_string($conn,$_POST['penulis']);
    $penerbit    = mysqli_real_escape_string($conn,$_POST['penerbit']);
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $deskripsi   = mysqli_real_escape_string($conn,$_POST['deskripsi']);

    // Upload gambar
    $namaFile = $_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];

    if($namaFile != ""){

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        $boleh = ['jpg','jpeg','png','webp'];

        if(!in_array($ext,$boleh)){
            echo "<script>alert('Format gambar harus JPG, JPEG, PNG, atau WEBP!');</script>";
        }else{

            $namaBaru = time()."_".$namaFile;

            move_uploaded_file($tmp,"../gambar/".$namaBaru);

            mysqli_query($conn,"
            INSERT INTO buku
            (kategori_id,judul,penulis,penerbit,harga,stok,gambar,deskripsi)
            VALUES
            ('$kategori_id','$judul','$penulis','$penerbit','$harga','$stok','$namaBaru','$deskripsi')
            ");

            echo "<script>
            alert('Buku berhasil ditambahkan');
            window.location='buku.php';
            </script>";
            exit;
        }

    }else{

        echo "<script>alert('Silakan pilih gambar buku!');</script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.container{
    max-width:800px;
    margin-top:40px;
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
<i class="fa fa-book"></i>
Tambah Buku
</h4>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Kategori</label>

<select name="kategori_id" class="form-select" required>

<option value="">-- Pilih Kategori --</option>

<?php while($k=mysqli_fetch_assoc($kategori)){ ?>

<option value="<?= $k['id']; ?>">
<?= $k['nama_kategori']; ?>
</option>

<?php } ?>

</select>
</div>

<div class="mb-3">
<label>Judul Buku</label>
<input type="text" name="judul" class="form-control" required>
</div>

<div class="mb-3">
<label>Penulis</label>
<input type="text" name="penulis" class="form-control" required>
</div>

<div class="mb-3">
<label>Penerbit</label>
<input type="text" name="penerbit" class="form-control" required>
</div>

<div class="row">

<div class="col-md-6">

<label>Harga</label>

<input type="number" name="harga" class="form-control" required>

</div>

<div class="col-md-6">

<label>Stok</label>

<input type="number" name="stok" class="form-control" required>

</div>

</div>

<br>

<div class="mb-3">

<label>Gambar Buku</label>

<input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="5"
required></textarea>

</div>

<button class="btn btn-success" name="simpan">
<i class="fa fa-save"></i>
Simpan
</button>

<a href="buku.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</div>

</body>
</html>