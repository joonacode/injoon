<?php

session_start();
require '../config.php';

$ue = htmlspecialchars($_POST['ue']);
$password = htmlspecialchars($_POST['password']);

$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_username = '$ue' OR user_email = '$ue'");
$query_user = mysqli_fetch_assoc($user);

if ($query_user > 0) {
    if (password_verify($password, $query_user['user_password'])) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $query_user['user_id'];
        $_SESSION['nama'] = $query_user['user_nama'];
        $_SESSION['username'] = $query_user['user_username'];
        $_SESSION['email'] = $query_user['user_email'];
        $_SESSION['role'] = $query_user['role_id'];
        $_SESSION['profile'] = $query_user['user_foto'];
        header('Location:../../dashboard.php');
    } else {
        $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
        <b>Login gagal!</b> Password salah
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../hayuu.php');
    }
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Login gagal!</b> Username / email tidak ditemukan
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../hayuu.php');
}
