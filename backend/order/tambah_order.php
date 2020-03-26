<?php
session_start();
require '../config.php';
$meja = htmlspecialchars($_POST['meja']);
$order_id = htmlspecialchars($_POST['order_id']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$user_id = $_SESSION['id'];
$tanggal = time();
$tanggal2 = date('d-m-Y');

$validasi_pesanan_kosong = mysqli_query($conn, "SELECT COUNT(order_id) as j_ord FROM tb_detail_order WHERE order_id = '$order_id'");
$q_validasi = mysqli_fetch_assoc($validasi_pesanan_kosong);
if ($q_validasi['j_ord'] == 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Keranjang masih kosong
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../menu.php');
    return false;
} elseif ($meja < 1) {
    $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Meja belum dipilih
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../menu.php');
    return false;
} else {
    mysqli_query($conn, "UPDATE tb_detail_order set dorder_status = 1 WHERE order_id = '$order_id'");

    mysqli_query($conn, "UPDATE tb_meja set status = 1 WHERE meja_id = '$meja'");

    $queryTambah = "INSERT INTO tb_order VALUES('$order_id', '$meja', '$tanggal', '$tanggal2', '$user_id', '$keterangan', 0)";
    $query = mysqli_query($conn, $queryTambah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Pesanan sedang di proses mohon tunggu sampai masakan matang
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
}
