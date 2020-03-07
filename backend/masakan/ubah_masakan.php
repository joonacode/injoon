<?php
session_start();
require '../config.php';

$id = htmlspecialchars($_POST['id']);
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
$gambar_lama = htmlspecialchars($_POST['gambar_lama']);
$foto = $_FILES['foto'];
$ukuran_foto = $_FILES['foto']['size'];
$place_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$enkripsi_nama_foto = time() . '_InJoon_' . $nama_foto;
if (move_uploaded_file($place_foto, '../../frontend/images/masakan/' . $enkripsi_nama_foto)) {
    unlink('../../frontend/images/masakan/' . $gambar_lama);

    $queryUbah = "UPDATE tb_masakan SET 
    masakan_nama='$nama',
    masakan_ds='$diskon_status',
    masakan_hsd='$harga_sebelum_diskon',
    masakan_diskon='$diskonnya',
    masakan_harga='$harganya',
    masakan_deskripsi='$deskripsi',
    kategori_id='$kategori',
    masakan_gambar = '$enkripsi_nama_foto'
    WHERE masakan_id = '$id'
    ";
    $query = mysqli_query($conn, $queryUbah);
    if ($query > 0) {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Data berhasil diubah
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
    $queryUbah = "UPDATE tb_masakan SET 
    masakan_nama='$nama',
    masakan_ds='$diskon_status',
    masakan_hsd='$harga_sebelum_diskon',
    masakan_diskon='$diskonnya',
    masakan_harga='$harganya',
    masakan_deskripsi='$deskripsi',
    kategori_id='$kategori'
    WHERE masakan_id = '$id'
    ";
    $query = mysqli_query($conn, $queryUbah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil diubah
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
