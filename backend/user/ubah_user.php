<?php
session_start();
require '../config.php';

$id = htmlspecialchars($_POST['id']);
$nama = htmlspecialchars($_POST['nama']);
$telp = htmlspecialchars($_POST['telp']);
$email = htmlspecialchars($_POST['email']);
$itsProfile = htmlspecialchars($_POST['itsProfile']);
$username = htmlspecialchars($_POST['username']);
$role = htmlspecialchars($_POST['role']);
$alamat = htmlspecialchars($_POST['alamat']);
$cekUsername = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_username = '$username' AND user_id != '$id'");
$cekUsernameR = mysqli_num_rows($cekUsername);
$cekEmail = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_email = '$email' AND user_id != '$id'");
$cekEmailR = mysqli_num_rows($cekEmail);
$gambar_lama = $_POST['gambar_lama'];
$foto = $_FILES['foto'];
$ukuran_foto = $_FILES['foto']['size'];
$place_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$enkripsi_nama_foto = time() . '_InJoon_' . $nama_foto;

if ($itsProfile == 'n') {
    $redirek = header('Location:../../user.php');
} else {
    $redirek = header('Location:../../profile.php');
}

if ($cekUsernameR > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Username sudah digunakan
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    $redirek;
} elseif ($cekEmailR > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Email sudah digunakan
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    $redirek;
} else {
    if (move_uploaded_file($place_foto, '../../frontend/images/profile/' . $enkripsi_nama_foto)) {
        if ($gambar_lama != 'default.png') {
            unlink('../../frontend/images/profile/' . $gambar_lama);
        }
        $queryUbah = "UPDATE tb_user SET 
            user_nama='$nama',
            user_telp='$telp',
            user_username='$username',
            user_email='$email',
            user_alamat = '$alamat',
            user_foto = '$enkripsi_nama_foto',
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
            $redirek;
        } else {
            $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
            $redirek;
        }
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
            $redirek;
        } else {
            $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
            $redirek;
        }
    }
}
