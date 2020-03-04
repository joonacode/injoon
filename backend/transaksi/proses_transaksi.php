<?php
session_start();
require '../config.php';

$order_id = htmlspecialchars($_POST['order_id']);
$meja = htmlspecialchars($_POST['meja']);
$member = htmlspecialchars($_POST['member']);
$total_harga = htmlspecialchars($_POST['total_harga']);
$diskon = htmlspecialchars($_POST['diskon']);
$total_bayar = htmlspecialchars($_POST['total_bayar']);
$uang = htmlspecialchars($_POST['uang']);
$kembalian = htmlspecialchars($_POST['kembalian']);
$tanggal = time();



if ($kembalian < 0 || $uang == 0) {
    $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Pembayaran gagal!</b> Uang kurang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../entri_transaksi.php?meja=' . $meja);
} else {
    mysqli_query($conn, "UPDATE tb_order set order_status = 1 WHERE order_id = '$order_id'");

    mysqli_query($conn, "UPDATE tb_meja set status = 0 WHERE meja_id = '$meja'");

    $queryTambah = "INSERT INTO tb_transaksi VALUES('', '$member', '$order_id', '$tanggal', '$total_harga', '$diskon', '$total_bayar', '$uang', '$kembalian')";
    $query = mysqli_query($conn, $queryTambah);
    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Pembayaran berhasil <a href="print_struk.php?order_id=' . $order_id . '" target="_blank" class="btn ml-2 btn-sm text-small btn-outline-primary text-small">Print Struk <i class="fas fa-print"></i></a>
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../entri_transaksi.php');
    } else {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Pembayaran gagal
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../entri_transaksi.php');
    }
}
