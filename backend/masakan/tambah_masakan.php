<?php
session_start();
require '../config.php';
$nama = htmlspecialchars($_POST['nama']);

$diskon_status = htmlspecialchars($_POST['diskon_status']);

if ($diskon_status == 1) {
    $harga_sebelum_diskon = htmlspecialchars($_POST['harga_sebelum_diskon']);
    $diskonnya = htmlspecialchars($_POST['diskonnya']);
    $harga_setelah_diskon = htmlspecialchars($_POST['harga_setelah_diskon']);
    $harganya = $harga_setelah_diskon;
} else {
    $harga = htmlspecialchars($_POST['harga']);
    $harga_sebelum_diskon = $harga;
    $diskonnya = 0;
    $harga_setelah_diskon = $harga;
    $harganya = $harga;
}

$deskripsi = htmlspecialchars($_POST['deskripsi']);
$kategori = htmlspecialchars($_POST['kategori']);
$foto = $_FILES['foto'];
$ukuran_foto = $_FILES['foto']['size'];
$place_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$enkripsi_nama_foto = time() . '_InJoon_' . $nama_foto;
if (move_uploaded_file($place_foto, '../../frontend/images/masakan/' . $enkripsi_nama_foto)) {
    $queryTambah = "INSERT INTO tb_masakan VALUES(NULL, '$nama', '$diskon_status', '$harga_sebelum_diskon', '$diskonnya', '$harganya',  '$deskripsi', '$kategori', '$enkripsi_nama_foto')";
    $query = mysqli_query($conn, $queryTambah);
    $q_lastId = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC LIMIT 1");
    $lastId = mysqli_fetch_assoc($q_lastId);
    mysqli_query($conn, "INSERT INTO tb_best_seller VALUES(NULL, '$lastId[masakan_id]', 0)");
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
    $queryTambah = "INSERT INTO tb_masakan VALUES('', '$nama', '$diskon_status', '$harga_sebelum_diskon', '$diskonnya', '$harganya', '$deskripsi', '$kategori', 'default.png')";
    $query = mysqli_query($conn, $queryTambah);
    $q_lastId = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC LIMIT 1");
    $lastId = mysqli_fetch_assoc($q_lastId);
    mysqli_query($conn, "INSERT INTO tb_best_seller VALUES('', '$lastId[masakan_id]', 0)");
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
