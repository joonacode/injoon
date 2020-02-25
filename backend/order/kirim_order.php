<?php
session_start();
require '../config.php';

$id = $_GET['id'];
$q_update = mysqli_query($conn, "UPDATE tb_order set order_status = 1 WHERE order_id = '$id'");

$query = mysqli_query($conn, $q_update);

if ($query > 0) {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Pesanan dikirim ke pelanggan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../data_order.php');
} else {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Pesanan gagal dikirim ke pelanggan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../../data_order.php');
}
