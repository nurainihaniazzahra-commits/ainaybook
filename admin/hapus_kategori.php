<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kategori WHERE id='$id'");

echo "<script>
alert('Kategori berhasil dihapus!');
window.location='kategori.php';
</script>";
?>