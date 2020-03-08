<?php
session_start();
require 'backend/config.php';
$q_pengaturan = mysqli_query($conn, "SELECT * FROM tb_pengaturan WHERE pengaturan_id = 1");
$pengaturan = mysqli_fetch_assoc($q_pengaturan);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="frontend/images/<?= $pengaturan['pengaturan_favicon'] ?>" type="image/x-icon">
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
            <a href="index.php" class="navbar-brand">
                <img src="frontend/images/<?= $pengaturan['pengaturan_logo'] ?>" alt="">
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
                        <a href="#about" class="nav-link">Tentang Kami</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#testimoni" class="nav-link">Testimoni</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#kontak-kami" class="nav-link">Kontak</a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['login'])) : ?>

                    <div class="ml-auto">
                        <a href="dashboard.php" class="btn btn-sm text-white bg-secondary shadow btn-sm"><i class="fas fa-home"></i></a>
                        <?php
                        $ses = $_SESSION['role'];
                        if ($ses == 2 || $ses == 3) :

                        ?>
                            <button type="button" data-toggle="modal" data-target="#modalKeranjang" class="btn btn-sm shadow text-white bg-cus-dark btn-sm"><i class="fas fa-shopping-bag"></i></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            </div>

        </div>
    </nav>
    <?php if (isset($_SESSION['login'])) : ?>

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
                    $list_pesanan = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id = 'ORD000$no_order' AND user_id = '$_SESSION[id]'");
                    $nono = 'ORD000' . $no_order;
                    $q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$nono'");
                    $hartot = mysqli_fetch_assoc($q_hartot);
                    ?>
                    <form action="backend/order/tambah_order.php" method="POST">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Order No</label>
                                        <input type="text" class="form-control" name="order_id" readonly value="ORD000<?= $no_order ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No Meja</label>
                                        <select name="meja" class="form-control text-small" required>
                                            <option selected value="0">-- Pilih no meja --</option>
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
                                <div class="col-md-8">
                                    <p>List Pesanan</p>
                                    <div class="table-responsive" style="height:400px;overflow-y:scroll;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10">No</th>
                                                    <th>Nama</th>
                                                    <th width="170">Deskripsi</th>
                                                    <th width="100">Harga</th>
                                                    <th width="50">Jml</th>
                                                    <th width="130">Harga Akhir</th>
                                                    <th width="10">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($list_pesanan as $list_row) :
                                                    $masakan = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$list_row[masakan_id]' ");
                                                    $q_masakan = mysqli_fetch_assoc($masakan);
                                                ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $q_masakan['masakan_nama'] ?></td>
                                                        <td><?= $list_row['dorder_keterangan'] ?></td>
                                                        <td>Rp. <?= rupiah($q_masakan['masakan_harga']) ?></td>
                                                        <td><?= $list_row['dorder_jumlah'] ?></td>
                                                        <td>Rp. <?= rupiah($q_masakan['masakan_harga'] * $list_row['dorder_jumlah']) ?></td>
                                                        <td><a href="backend/order/hapus_pesan.php?id=<?= $list_row['dorder_id'] ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-sm btn-danger text-small"><i class="fas fa-trash"></i></a></td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                                <tr>
                                                    <td colspan="7">
                                                        Total Harga : Rp. <?= rupiah($hartot['hartot']) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Tutup <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary text-small">Proses <i class="fas fa-check"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php endif; ?>