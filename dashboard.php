<?php

require 'templates/header.php';
$q_totalMenu = mysqli_query($conn, "SELECT COUNT(*) as total_menu FROM tb_masakan");
$totalMenu = mysqli_fetch_assoc($q_totalMenu);
$q_totalWaiter = mysqli_query($conn, "SELECT COUNT(*) as total_waiter FROM tb_user WHERE role_id = 3");
$totalWaiter = mysqli_fetch_assoc($q_totalWaiter);
$q_totalKasir = mysqli_query($conn, "SELECT COUNT(*) as total_kasir FROM tb_user WHERE role_id = 4");
$totalKasir = mysqli_fetch_assoc($q_totalKasir);
$q_totalPelanggan = mysqli_query($conn, "SELECT COUNT(*) as total_pelanggan FROM tb_user WHERE role_id = 5");
$totalPelanggan = mysqli_fetch_assoc($q_totalPelanggan);
$d =  date('d-m-Y');
$q_orderBayar = mysqli_query($conn, "SELECT COUNT(*) as sudah_bayar FROM  tb_order WHERE order_nganTanggal = '$d' AND order_status = 1");
$orderBayar = mysqli_fetch_assoc($q_orderBayar);
$q_orderBelumBayar = mysqli_query($conn, "SELECT COUNT(*) as belum_bayar FROM  tb_order WHERE order_nganTanggal = '$d' AND order_status = 0");
$orderBelumBayar = mysqli_fetch_assoc($q_orderBelumBayar);
$q_pendapatan = mysqli_query($conn, "SELECT SUM(transaksi_totbar) as totbar FROM  tb_transaksi WHERE transaksi_nganTanggal = '$d'");
$pendapatan = mysqli_fetch_assoc($q_pendapatan);

?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <h1>Dashboard</h1>

    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="frontend/images/profile/default.png" class="img-thumbnail float-left mr-2" width="50" alt="">
                                <b>Hallo <?= $_SESSION['nama'] ?></b><br>
                                <span class="mb-0 text-small">Login sebagai <?= $get_role['role_nama'] ?> | <a href="profile.php">Profile</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <b>Total Penjualan Hari : <?= $d ?></b><br>

                                <span class="mr-1 btn-sm text-small btn-success"><?= $orderBayar['sudah_bayar'] ?> Sudah Bayar <i class="fas fa-check text-small"></i> </span>
                                <span class="border-right border-left"></span>
                                <span class="mr-1 btn-sm text-small btn-danger"><?= $orderBelumBayar['belum_bayar'] ?> Belum Bayar <i class="fas fa-times text-small"></i> </span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <b>Total Pendapatan Hari Ini</b>
                                <p class="mb-0">Rp. <?= $pendapatan['totbar'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <b>Total Menu</b>
                                <p class="mb-0"><?= $totalMenu['total_menu'] ?> Menu</p>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) : ?>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <b>Total Pegawai</b><br>
                                    <span class="mr-1 btn-sm text-small btn-primary"><?= $totalWaiter['total_waiter'] ?> Waiter <i class="fas fa-user text-small"></i> </span>
                                    <span class="border-right border-left"></span>
                                    <span class="ml-1 btn-sm text-small btn-secondary"> <?= $totalKasir['total_kasir'] ?> Kasir <i class="fas fa-user text-small"></i> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <b>Total Pelanggan</b><br>
                                    <span class="mr-1 btn-sm text-small btn-warning text-white"><?= $totalPelanggan['total_pelanggan'] ?> Pelanggan <i class="fas fa-user text-small"></i> </span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <b>Laporan</b><br>
                                <a href="laporan.php" class="btn btn-primary btn-sm text-small btn-block"> Lihat Laporan <i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
</section>

<?php require 'templates/footer_text.php' ?>

<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
</body>

</html>