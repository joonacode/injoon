<?php
session_start();
require  '../config.php';

$id  = $_GET['id'];
$hapus_user = "DELETE FROM tb_detail_order WHERE dorder_id = '$id'";
$query = mysqli_query($conn, $hapus_user);
if ($query > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Berhasil!</b> Pesanan berhasil dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../menu.php');
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Pesanan gagal dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../menu.php');
}
