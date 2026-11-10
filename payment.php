<?php

session_start();

$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$telepon=$_POST['telepon'];
$total=$_POST['total'];
$payment=$_POST['payment'];


?>


<!DOCTYPE html>
<html>

<head>

<title>Pembayaran</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<section>


<div class="contact-form">


<h2>Pembayaran</h2>


<p><b>Nama :</b> <?= $nama; ?></p>

<p><b>Alamat :</b> <?= $alamat; ?></p>

<p><b>No Telepon :</b> <?= $telepon; ?></p>

<p><b>Metode :</b> <?= $payment; ?></p>

<h3>Total : Rp<?= number_format($total,0,",","."); ?></h3>


<?php if($payment=="Transfer Bank"){ ?>


<h3>
Transfer ke:
</h3>

<p>
Bank MANDIRI
<br>
No Rekening:
<br>
60014544757
</p>


<?php } ?>


<?php if($payment=="E-Wallet"){ ?>


<?php } ?>

<form action="pesanan/simpan.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="nama" value="<?php echo $nama;?>">
<input type="hidden" name="alamat" value="<?php echo $alamat;?>">
<input type="hidden" name="telepon" value="<?php echo $telepon;?>">
<input type="hidden" name="total" value="<?php echo $total;?>">
<input type="hidden" name="payment" value="<?php echo $payment;?>">

<?php if($payment=="Transfer Bank" || $payment=="E-Wallet"){ ?>

<h3>Upload Bukti Pembayaran</h3>

<p>Silakan upload bukti transfer atau pembayaran E-Wallet kamu.</p>

<input type="file" name="bukti_pembayaran" accept="image/*" required>

<?php } ?>

<br>

<button type="submit" class="detail-btn">
Konfirmasi Pembayaran
</button>

</form>

</div>


</section>


</body>

</html>