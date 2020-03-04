<?php
session_start();
require 'backend/config.php';
// $id = $_GET['order_id'];
$q_struk = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY transaksi_id DESC");
// $struk = mysqli_fetch_assoc($q_struk);
// $detail_order = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id  = '$id'");
// $q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$id'");
// $hartot = mysqli_fetch_assoc($q_hartot);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Semua Laporan</title>
    <link rel="stylesheet" href="frontend/libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/styles/main.css">

</head>

<body style="color: #000;">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mt-2 mb-4">Laporan Semua Transaksi Penjualan</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Order</th>
                                        <th>Member</th>
                                        <th>Tanggal thansaksi</th>
                                        <th>Total Bayar</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar (diskon)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1;
                                    foreach ($q_struk as $row) :
                                        $user_query =  mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$row[user_id]'");
                                        $usr = mysqli_fetch_assoc($user_query);
                                        $order_query =  mysqli_query($conn, "SELECT * FROM tb_order WHERE order_id = '$row[order_id]'");
                                        $oq = mysqli_fetch_assoc($order_query);
                                    ?>
                                        <tr>
                                            <td><?= $row['order_id'] ?></td>
                                            <td><?= $oq['order_meja'] ?></td>
                                            <td><?= $usr['user_nama'] ?></td>
                                            <td><?= date('d-m-Y h:i', $row['transaksi_tanggal']) ?></td>
                                            <td>Rp. <?= $row['transaksi_hartot'] ?></td>
                                            <td><?= $row['transaksi_diskon'] ?>%</td>
                                            <td>Rp. <?= $row['transaksi_totbar'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // window.print();
    </script>
</body>

</html>