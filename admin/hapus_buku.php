<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: buku.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data buku
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>
    alert('Data buku tidak ditemukan!');
    window.location='buku.php';
    </script>";
    exit;
}

$buku = mysqli_fetch_assoc($query);

// Hapus file gambar jika ada
if (!empty($buku['gambar'])) {

    $file = "../gambar/" . $buku['gambar'];

    if (file_exists($file)) {
        unlink($file);
    }
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");

echo "<script>
alert('Buku berhasil dihapus!');
window.location='buku.php';
</script>";
?>