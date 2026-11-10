<?php
session_start();
include "../koneksi.php";

$id_user = $_SESSION['id'];

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
$total = $_POST['total'];
$payment = mysqli_real_escape_string($conn, $_POST['payment']);

// Upload bukti pembayaran
$bukti_pembayaran = "";

if(isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0){

    $folder = "../uploads/";

    if(!is_dir($folder)){
        mkdir($folder, 0777, true);
    }

    $nama_file = $_FILES['bukti_pembayaran']['name'];
    $tmp_file = $_FILES['bukti_pembayaran']['tmp_name'];

    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    $nama_baru = "bukti_" . time() . "_" . uniqid() . "." . $ext;

    $bukti_pembayaran = $nama_baru;

    move_uploaded_file($tmp_file, $folder . $nama_baru);
}

/* =========================
   SIMPAN PESANAN
========================= */

$sql = "INSERT INTO pesanan
(id_user,nama,alamat,telepon,metode_pembayaran,total,status,bukti_pembayaran)
VALUES
('$id_user','$nama','$alamat','$telepon','$payment','$total','Menunggu','$bukti_pembayaran')";


if(mysqli_query($conn,$sql)){

    // Ambil ID pesanan yang baru dibuat
    $id_pesanan = mysqli_insert_id($conn);


    /* =========================
       SIMPAN DETAIL BUKU
    ========================= */

    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

        foreach($_SESSION['cart'] as $id_buku => $jumlah){

            $id_buku = (int)$id_buku;
            $jumlah = (int)$jumlah;


            // Ambil harga buku
            $query_buku = mysqli_query($conn,"
                SELECT harga
                FROM buku
                WHERE id='$id_buku'
            ");


            if(mysqli_num_rows($query_buku) > 0){

                $buku = mysqli_fetch_assoc($query_buku);

                $harga = $buku['harga'];


                // Simpan ke pesanan_detail
                mysqli_query($conn,"
                    INSERT INTO pesanan_detail
                    (id_pesanan,id_buku,jumlah,harga)
                    VALUES
                    ('$id_pesanan','$id_buku','$jumlah','$harga')
                ");

            }

        }

    }


    /* =========================
       KOSONGKAN CART
    ========================= */

    unset($_SESSION['cart']);

 /* =========================
       ARAHKAN KE STRUK
    ========================= */

  header("Location: ../struk.php?id=" . $id_pesanan);
    exit;

} else {

    die("Gagal menyimpan pesanan: " . mysqli_error($conn));

}

?>