<?php

include "../koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($cek) > 0){

    echo "<script>
    alert('Email sudah digunakan!');
    window.location='../register.php';
    </script>";

    exit;
}

$sql = "INSERT INTO users(nama,email,password)
VALUES('$nama','$email','$password')";

if(mysqli_query($conn,$sql)){

    echo "<script>
    alert('Registrasi Berhasil!');
    window.location='../login.php';
    </script>";

}else{

    echo mysqli_error($conn);

}
?>