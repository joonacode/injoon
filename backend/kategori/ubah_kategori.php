<?php
session_start();
require '../config.php';
$nama = htmlspecialchars($_POST['nama']);
$id = htmlspecialchars($_POST['id']);

$queryUbah = "UPDATE tb_kategori SET kategori_nama = '$nama' WHERE kategori_id = '$id'";
$query = mysqli_query($conn, $queryUbah);

if ($query > 0) {
    $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Kategori berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
    header('Location:../../kategori.php');
} else {
    $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Kategori gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
    header('Location:../../kategori.php');
}
