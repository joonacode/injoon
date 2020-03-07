<?php

session_start();
require '../config.php';

$id = htmlspecialchars($_POST['id']);
$password_lama = htmlspecialchars($_POST['password_lama']);
$password_baru = htmlspecialchars($_POST['password_baru']);
$vpassword_baru = htmlspecialchars($_POST['vpassword_baru']);
strlen($password_baru);

$q_user = mysqli_query($conn,  "SELECT * FROM tb_user WHERE user_id = '$id'");
$user = mysqli_fetch_array($q_user);

if (password_verify($password_lama, $user['user_password'])) {
    if (strlen($password_baru) >= 3) {

        if ($password_baru == $vpassword_baru) {
            if ($password_baru != $password_lama) {
                $enkrip = password_hash($password_baru, PASSWORD_DEFAULT);
                $q_ubah = mysqli_query($conn, "UPDATE tb_user SET user_password = '$enkrip', user_password_show='$password_baru' WHERE user_id = '$id'");
                if ($q_ubah) {
                    $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Password berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                    header('Location:../../profile.php');
                } else {
                    $_SESSION['pesan'] = '
                <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Password gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                    header('Location:../../profile.php');
                }
            } else {
                $_SESSION['pesan'] = '
                <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Password baru harus beda dengan password lama
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                header('Location:../../profile.php');
            }
        } else {
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Verifikasi password baru tidak sesuai
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
            header('Location:../../profile.php');
        }
    } else {
        $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Password baru terlalu pendek. Minimal 3 karakter
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../profile.php');
    }
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Password lama tidak sesuai
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../profile.php');
}
