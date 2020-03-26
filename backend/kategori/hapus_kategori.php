<?php
session_start();
require  '../config.php';

$id  = $_GET['id'];


$q_user = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE kategori_id = '$id'");
$query2 = mysqli_fetch_assoc($q_user);

if ($query2) {
    $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal dihapus!</b> Kategori sudah digunakan oleh masakan
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
    header('Location:../../kategori.php');
} else {
    $hapus_user = "DELETE FROM tb_kategori WHERE kategori_id = '$id'";
    $query = mysqli_query($conn, $hapus_user);
    if ($query > 0) {
        $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Berhasil!</b> Data berhasil dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../kategori.php');
    } else {
        $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Data gagal dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('Location:../../kategori.php');
    }
}
