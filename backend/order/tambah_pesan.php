<?php
session_start();
require '../config.php';

$masakan_id = htmlspecialchars($_POST['masakan_id']);
$jumlah = htmlspecialchars($_POST['jumlah']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$user_id = $_SESSION['id'];

$query_order = mysqli_query($conn, "SELECT count(order_id) as no_order FROM tb_order");
$order = mysqli_fetch_assoc($query_order);
$no_order = $order['no_order'] + 1;
$a_no = 'ORD000' . $no_order;
// var_dump($a_no);
// die;

$validasi_dupllikat_menu = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE masakan_id = '$masakan_id' AND check_available = '$no_order'");
$q_validasi = mysqli_fetch_assoc($validasi_dupllikat_menu);


if ($q_validasi > 0) {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Menu sudah ada dikeranjang
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
    header('Location:../../menu.php');
    return false;
} else {
    $queryTambah = "INSERT INTO tb_detail_order VALUES('', '$no_order', '$a_no', '$masakan_id',  '$keterangan', '$jumlah', '$user_id', 0)";
    $query = mysqli_query($conn, $queryTambah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Menu disimpan dikeranjang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../menu.php');
    } else {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Menu gagal disimpan dikeranjang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../menu.php');
    }
}
