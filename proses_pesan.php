<?php

session_start();

include "koneksi.php";

$nama  = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;


$stmt = mysqli_prepare($conn, "
    INSERT INTO pesan
    (id_user, nama, email, pesan)
    VALUES (?, ?, ?, ?)
");


if (!$stmt) {
    die("Prepare gagal: " . mysqli_error($conn));
}


mysqli_stmt_bind_param(
    $stmt,
    "isss",
    $id_user,
    $nama,
    $email,
    $pesan
);


if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    echo "<script>
        alert('Pesan berhasil dikirim!');
        window.location.href='kontak.php';
    </script>";

} else {

    die("Pesan gagal disimpan: " . mysqli_stmt_error($stmt));

}

?>