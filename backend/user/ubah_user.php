<?php
session_start();
require '../config.php';

$id = htmlspecialchars($_POST['id']);
$nama = htmlspecialchars($_POST['nama']);
$telp = htmlspecialchars($_POST['telp']);
$email = htmlspecialchars($_POST['email']);
$username = htmlspecialchars($_POST['username']);
$role = htmlspecialchars($_POST['role']);
$alamat = htmlspecialchars($_POST['alamat']);
$ini_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$id'");
$query_ini_user = mysqli_fetch_assoc($ini_user);
$validasi = "SELECT * FROM tb_user WHERE user_email != '$query_ini_user[user_email]' OR user_username != '$query_ini_user[user_username]'";
$query_validasinya = mysqli_query($conn, $validasi);
$query_validasi = mysqli_fetch_assoc($query_validasinya);

if ($password != $v_password) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Data gagal ditambah!</b> Verifikasi password tidak sesuai
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../user.php');
    // } elseif ($query_validasi) {
    //     $_SESSION['pesan'] = '
    //     <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    //     <b>Gagal!</b> Email / username sudah digunakan
    //     <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    //     </div>
    //     ';
    //     header('Location:../../user.php');
} else {
    $queryUbah = "UPDATE tb_user SET 
    user_nama='$nama',
    user_telp='$telp',
    user_username='$username',
    user_email='$email',
    user_alamat = '$alamat',
    role_id = '$role'
    WHERE user_id = '$id'
    ";
    $query = mysqli_query($conn, $queryUbah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Berhasil!</b> Data berhasil diubah
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../user.php');
    } else {
        $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Data gagal diubah
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../user.php');
    }
}
