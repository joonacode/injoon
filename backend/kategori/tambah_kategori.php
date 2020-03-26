<?php
session_start();
require '../config.php';
$nama = htmlspecialchars($_POST['nama']);

$queryTambah = "INSERT INTO tb_kategori VALUES(NULL, '$nama')";
$query = mysqli_query($conn, $queryTambah);

if ($query > 0) {
    $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Kategori berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
    header('Location:../../kategori.php');
} else {
    $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Kategori gagal ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
    header('Location:../../kategori.php');
}
