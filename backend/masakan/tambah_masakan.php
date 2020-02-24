<?php
session_start();
require '../config.php';

$nama = htmlspecialchars($_POST['nama']);
$harga = htmlspecialchars($_POST['harga']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$kategori = htmlspecialchars($_POST['kategori']);
$foto = $_FILES['foto'];
$ukuran_foto = $_FILES['foto']['size'];
$place_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$enkripsi_nama_foto = time() . '_InJoon_' . $nama_foto;
if (move_uploaded_file($place_foto, '../../frontend/images/masakan/' . $enkripsi_nama_foto)) {
    $queryTambah = "INSERT INTO tb_masakan VALUES('', '$nama', '$harga',  '$deskripsi', '$kategori', '$enkripsi_nama_foto')";
    $query = mysqli_query($conn, $queryTambah);
    if ($query > 0) {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Data berhasil ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../masakan.php');
    } else {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Data gagal ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../masakan.php');
    }
} else {
    $queryTambah = "INSERT INTO tb_masakan VALUES('', '$nama', '$harga',  '$deskripsi', '$kategori', 'default.png')";
    $query = mysqli_query($conn, $queryTambah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../masakan.php');
    } else {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../masakan.php');
    }
}
