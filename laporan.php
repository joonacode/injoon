<?php

include 'templates/header.php';
$transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY transaksi_id DESC");


?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
            </ol>
        </nav>
        <h1>Laporan</h1>
    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($_SESSION['pesan'])) : ?>
                                    <?= $_SESSION['pesan'] ?>
                                <?php
                                    unset($_SESSION['pesan']);
                                endif;
                                ?>
                                <a href="semua_laporan.php" target="_blank" class="btn btn-sm btn-primary py-2 px-3 text-small">
                                    Cetak Semua Laporan <i class="fas fa-print"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>No Meja</th>
                                                <th>Member</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Total Bayar</th>
                                                <th>Diskon</th>
                                                <th>Total Bayar (Diskon)</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($transaksi as $orow) :
                                                $user_query =  mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$orow[user_id]'");
                                                $usr = mysqli_fetch_assoc($user_query);
                                                $order_query =  mysqli_query($conn, "SELECT * FROM tb_order WHERE order_id = '$orow[order_id]'");
                                                $oq = mysqli_fetch_assoc($order_query);

                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td><?= $orow['order_id'] ?></td>
                                                    <td><?= $oq['order_meja'] ?></td>
                                                    <td><?= $usr['user_nama'] ?></td>
                                                    <td><?= date('d-m-Y H:i', $orow['transaksi_tanggal']) ?></td>
                                                    <td>Rp. <?= $orow['transaksi_hartot'] ?></td>
                                                    <td><?= $orow['transaksi_diskon'] ?>%</td>
                                                    <td>Rp. <?= $orow['transaksi_totbar'] ?></td>
                                                    <td>
                                                        <a href="print_struk.php?order_id=<?= $orow['order_id'] ?>" target="_blank" class="btn btn-primary text-white btn-sm text-small"><i class="fas fa-print"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/DataTables/datatables.min.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<script>
    // AOS.init();
    $(document).ready(function() {
        $('.datatables').DataTable();
    })
</script>
</body>

</html>