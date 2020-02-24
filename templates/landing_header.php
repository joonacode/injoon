<?php
session_start();
require 'backend/config.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="frontend/images/favicon.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="frontend/libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/libraries/aos/aos.css">
    <link rel="stylesheet" href="frontend/libraries/owlcarousel/assets/owl.theme.default.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="frontend/styles/main.css">

    <title>InJoon</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-cus">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="frontend/images/logo.png" alt="">
            </a>
            <button class="navbar-toggler text-small navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-4 mr-3">
                    <li class="nav-item mx-md-2">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="menu.php" class="nav-link">Menu</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#preview-game" class="nav-link">Tentang Kami</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#preview-game" class="nav-link">Kontak</a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['login'])) : ?>
                    <div class="ml-auto">
                        <a href="dashboard.php" class="btn btn-sm text-white bg-secondary btn-sm"><i class="fas fa-home"></i></a>
                        <button type="button" data-toggle="modal" data-target="#modalKeranjang" class="btn btn-sm text-white bg-cus-dark btn-sm"><i class="fas fa-shopping-bag"></i></button>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </nav>
    <div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="modalKeranjangLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size:16px;" id="modalKeranjangLabel">Keranjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                $query_order = mysqli_query($conn, "SELECT count(order_id) as no_order FROM tb_order");
                $order = mysqli_fetch_assoc($query_order);
                $no_order = $order['no_order'] + 1;
                $no_meja = mysqli_query($conn, "SELECT * FROM tb_meja WHERE status != 1");
                $list_pesanan = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id = 'ORD000$no_order'");
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Order No</label>
                                <input type="text" class="form-control" readonly value="ORD000<?= $no_order ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No Meja</label>
                                <select name="" class="form-control text-small" id="">
                                    <option selected disabled>-- Pilih no meja --</option>
                                    <?php foreach ($no_meja as $r_nmeja) : ?>
                                        <option value="<?= $r_nmeja['meja_id'] ?>"><?= $r_nmeja['meja_id'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control text-small"></textarea>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p>List Pesanan</p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($list_pesanan as $list_row) :
                                            $masakan = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$list_row[masakan_id]'");
                                            $q_masakan = mysqli_fetch_assoc($masakan);
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $q_masakan['masakan_nama'] ?></td>
                                                <td><?= $list_row['dorder_jumlah'] ?></td>
                                                <td><a href="backend/order/hapus_pesan.php?id=<?= $list_row['dorder_id'] ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-sm btn-danger text-small"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-small">Simpan</button>
                </div>
            </div>
        </div>
    </div>