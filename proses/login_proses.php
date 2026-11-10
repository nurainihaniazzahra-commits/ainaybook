<?php
session_start();
session_unset();
session_destroy();
session_start();
include "../koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

/* ==========================
   LOGIN ADMIN
========================== */

$admin = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");

if(mysqli_num_rows($admin)==1){

    $data = mysqli_fetch_assoc($admin);

    // Jika password admin masih MD5
    if(md5($password) == $data['password']){

        $_SESSION['admin'] = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username_admin'] = $data['username'];

        header("Location: ../admin/dashboard.php");
        exit;
    }

}

/* ==========================
   LOGIN USER
========================== */

$user = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($user)==1){

    $data = mysqli_fetch_assoc($user);

    if(password_verify($password,$data['password'])){

        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];

        header("Location: ../dashboard.php");
        exit;
    }

}

echo "<script>
alert('Email atau Password salah');
window.location='../login.php';
</script>";
?>