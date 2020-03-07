<?php
session_start();
require  '../config.php';

$id  = $_GET['id'];
$query_order = mysqli_query($conn, "SELECT * FROM tb_order WHERE order_id = '$id'");
$order = mysqli_fetch_assoc($query_order);
$hapus_order = "DELETE FROM tb_order WHERE order_id = '$id'";
mysqli_query($conn, "DELETE FROM tb_detail_order WHERE order_id = '$id'");
mysqli_query($conn, "UPDATE tb_meja SET status = 0 WHERE meja_id = '$order[order_meja]'");
$query = mysqli_query($conn, $hapus_order);
if ($query > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Berhasil!</b> Data order berhasil dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../data_order.php');
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Data order gagal dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../data_order.php');
}
