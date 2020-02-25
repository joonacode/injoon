<?php
session_start();
require '../config.php';

$order_id = htmlspecialchars($_POST['order_id']);
$meja = htmlspecialchars($_POST['meja']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$user_id = $_SESSION['id'];
$tanggal = time();

mysqli_query($conn, "UPDATE tb_detail_order set dorder_status = 1 WHERE order_id = '$order_id'");

mysqli_query($conn, "UPDATE tb_meja set status = 1 WHERE meja_id = '$meja'");

$queryTambah = "INSERT INTO tb_order VALUES('$order_id', '$meja', '$tanggal', '$user_id', '$keterangan', 0)";
$query = mysqli_query($conn, $queryTambah);

if ($query > 0) {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Pesanan sedang di proses
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../menu.php');
} else {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Pesanan gagal di proses
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../menu.php');
}
