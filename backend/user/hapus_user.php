<?php
session_start();
require  '../config.php';

$id  = $_GET['id'];
$q_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$id'");
$query2 = mysqli_fetch_assoc($q_user);
if ($query2['user_foto'] != 'default.png') {
    unlink('../../frontend/images/profile/' . $query2['user_foto']);
}
$hapus_user = "DELETE FROM tb_user WHERE user_id = '$id'";
$query = mysqli_query($conn, $hapus_user);


if ($query > 0) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Berhasil!</b> Data berhasil dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../user.php');
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
    <b>Gagal!</b> Data gagal dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('Location:../../user.php');
}
