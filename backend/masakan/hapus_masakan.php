<?php
session_start();
require  '../config.php';

$id  = $_GET['id'];
$query_masak = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$id'");
$query_masakan = mysqli_fetch_assoc($query_masak);
if ($query_masakan['masakan_gambar'] != 'default.png') {
    unlink('../../frontend/images/masakan/' . $query_masakan['masakan_gambar']);
}
$hapus_user = "DELETE FROM tb_masakan WHERE masakan_id = '$id'";
$query = mysqli_query($conn, $hapus_user);

if ($query > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Berhasil!</b> Data berhasil dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../masakan.php');
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Data gagal dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../masakan.php');
}
