<?php

session_start();
include "../koneksi.php";

$id_user = $_SESSION['id'];

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$total = $_POST['total'];
$payment = $_POST['payment'];

mysqli_query($conn,"
INSERT INTO pesanan
(id_user,nama,alamat,telepon,metode_pembayaran,total,status)
VALUES
('$id_user','$nama','$alamat','$telepon','$payment','$total','Menunggu')
");

unset($_SESSION['cart']);

header("Location: riwayat.php");
exit;

?>