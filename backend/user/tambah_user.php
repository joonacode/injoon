<?php
session_start();
require '../config.php';

$nama = htmlspecialchars($_POST['nama']);
$telp = htmlspecialchars($_POST['telp']);
$email = htmlspecialchars($_POST['email']);
$username = htmlspecialchars($_POST['username']);
$role = htmlspecialchars($_POST['role']);
$alamat = htmlspecialchars($_POST['alamat']);
$password = htmlspecialchars($_POST['password']);
$v_password = htmlspecialchars($_POST['v_password']);
$hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$time = time();
$validasi = "SELECT * FROM tb_user WHERE user_email = '$email' OR user_username='$username'";
$query_validasinya = mysqli_query($conn, $validasi);
$query_validasi = mysqli_fetch_assoc($query_validasinya);

$foto = $_FILES['foto'];
$ukuran_foto = $_FILES['foto']['size'];
$place_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$enkripsi_nama_foto = time() . '_InJoon_' . $nama_foto;

$cekEuy = mysqli_query($conn, "SELECT * FROM tb_user");
$cekEuyR = mysqli_fetch_assoc($cekEuy);

if ($cekEuyR['user_username'] == $username) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Username sudah digunakan
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../user.php');
} elseif ($cekEuyR['user_email'] == $email) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Email sudah digunakan
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../user.php');
} else {
    if (move_uploaded_file($place_foto, '../../frontend/images/profile/' . $enkripsi_nama_foto)) {

        if ($password != $v_password) {
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Data gagal ditambah!</b> Verifikasi password tidak sesuai
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
            header('Location:../../user.php');
        } elseif ($query_validasi) {
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Email / username sudah digunakan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
            header('Location:../../user.php');
        } else {
            $queryTambah = "INSERT INTO tb_user VALUES(NULL, '$nama', '$telp',  '$username', '$email', '$alamat', '$hash_password', '$password', '$time', '$enkripsi_nama_foto', '$role')";
            $query = mysqli_query($conn, $queryTambah);

            if ($query > 0) {
                $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                header('Location:../../user.php');
            } else {
                $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                header('Location:../../user.php');
            }
        }
    } else {
        if ($password != $v_password) {
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Data gagal ditambah!</b> Verifikasi password tidak sesuai
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
            header('Location:../../user.php');
        } elseif ($query_validasi) {
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Email / username sudah digunakan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
            header('Location:../../user.php');
        } else {
            $queryTambah = "INSERT INTO tb_user VALUES(NULL, '$nama', '$telp',  '$username', '$email', '$alamat', '$hash_password', '$password', '$time', 'default.png', '$role')";
            $query = mysqli_query($conn, $queryTambah);

            if ($query > 0) {
                $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                header('Location:../../user.php');
            } else {
                $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
                header('Location:../../user.php');
            }
        }
    }
}
