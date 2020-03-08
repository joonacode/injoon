<?php
session_start();
require 'backend/config.php';
$id = $_GET['order_id'];
$q_struk = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE order_id = '$id'");
$struk = mysqli_fetch_assoc($q_struk);
$q_mem = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$struk[user_id]'");
$mem = mysqli_fetch_assoc($q_mem);
$detail_order = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id  = '$id'");
$q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$id'");
$hartot = mysqli_fetch_assoc($q_hartot);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk</title>
    <link rel="stylesheet" href="frontend/libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/styles/main.css">

</head>

<body style="color: #000;">
    <div class="container-fluid text-pure-dark">


        <div class="row p-5">
            <div class="col-md-5 " style="border: 1px solid #000;">
                <div class="row">


                    <div class="col-md-12 mt-4 mb-1">
                        <div class="text-center">
                            <h5>INJOON RESTAURANT</h5>
                        </div>
                    </div>

                    <div class="col-md-12 py-2" style="border-top:solid 1px #000;border-bottom:solid 1px #000">
                        <p class="mb-1">
                            <span>Member : <?= $struk['user_id'] == 0 ? 'Tidak' : $mem['user_username'] ?></span><br>
                            <span><?= $struk['order_id'] ?></span>
                            <span class="float-right">
                                <span><?= date('d-m-Y h:i', $struk['transaksi_tanggal']) ?></span>
                            </span>
                        </p>

                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th width="100"></th>
                                    <th width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_order as $do) :
                                    $q_masakan = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$do[masakan_id]'");
                                    $masakan = mysqli_fetch_assoc($q_masakan);
                                ?>
                                    <tr>
                                        <td><?= $masakan['masakan_nama'] ?></td>
                                        <td><?= $do['dorder_jumlah'] ?></td>
                                        <td>Rp. <?= rupiah($masakan['masakan_harga']) ?></td>
                                        <td>Rp. <?= rupiah($do['dorder_hartot']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr style="border-top:solid 1px #000;border-bottom:solid 1px #000">
                                    <td colspan="3" align="right">Harga Jual :</td>
                                    <td><?= rupiah($struk['transaksi_hartot']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Diskon :</td>
                                    <td><?= $struk['transaksi_diskon'] ?>%</td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Total :</td>
                                    <td><?= rupiah($struk['transaksi_totbar']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Tunai :</td>
                                    <td><?= rupiah($struk['transaksi_uang']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Kembalian :</td>
                                    <td><?= rupiah($struk['transaksi_kembalian']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <span class="text-uppercase">Terimakasih Telah makan</span><br>
                        <span class="text-uppercase">di</span><br>
                        <span class="text-uppercase">=== INJOON RESTAURANT ===</span><br>
                        <span class="text-uppercase">WA 0821 2160 9346 Call 0811</span><br>
                        <span class="text-uppercase">Email : injoon@gmail.com</span><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>