<?php

include 'templates/header.php';
if (isset($_GET['meja'])) {
    $q_order = mysqli_query($conn, "SELECT * FROM tb_order WHERE order_meja = '$_GET[meja]' ORDER BY order_id DESC");
    $order = mysqli_fetch_assoc($q_order);
    $detail_order = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id = '$order[order_id]'");
}

$member = mysqli_query($conn, "SELECT * FROM tb_user WHERE role_id = 5");
$ses = $_SESSION['role'];

if ($ses == 1 || $ses == 3 || $ses == 5) {
    header('Location:hayuu.php');
}


?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Entri Transaksi</li>
            </ol>
        </nav>
        <h1>Entri Transaksi</h1>
    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm">
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
                                <?php if (isset($_GET['meja'])) : ?>
                                    <span class="text-small mr-3">No Order : <?= $order['order_id'] ?></span>
                                    <span class="text-small mr-3">No Meja : <?= $order['order_meja'] ?></span><br>
                                    <span class="text-small mr-3">Tanggal Pesan : <?= date('d-m-Y', $order['order_tanggal']) ?></span><br>
                                    <span class="text-small mr-3">Keterangan : <?= $order['order_keterangan'] ?></span>
                                <?php endif; ?>
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-hover datatables">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Masakan</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Harga Total</th>
                                                    </tr>

                                                </thead>
                                                <?php if (isset($_GET['meja'])) : ?>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        foreach ($detail_order as $orow) :
                                                            $q_masakan = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$orow[masakan_id]'");
                                                            $masakan = mysqli_fetch_assoc($q_masakan);
                                                        ?>
                                                            <tr class="text-small">
                                                                <td><?= $i; ?></td>
                                                                <td><?= $masakan['masakan_nama'] ?></td>
                                                                <td><?= $orow['dorder_jumlah'] ?></td>
                                                                <td>Rp. <?= rupiah($masakan['masakan_harga']) ?></td>
                                                                <td>Rp. <?= rupiah($masakan['masakan_harga'] * $orow['dorder_jumlah']) ?></td>
                                                            </tr>

                                                        <?php $i++;
                                                        endforeach; ?>

                                                    </tbody>
                                                <?php else : ?>
                                                    <tbody></tbody>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="backend/transaksi/proses_transaksi.php" method="POST">
                                            <?php
                                            $its_kursi = mysqli_query($conn, "SELECT * FROM tb_meja WHERE status != 0");

                                            ?>

                                            <div class="form-group">
                                                <label for="">No Meja</label>
                                                <select class="form-control text-small" onchange='location=this.value' required>
                                                    <option selected disabled>-- Nomor Meja --</option>
                                                    <?php if (isset($_GET['meja'])) : ?>

                                                        <?php foreach ($its_kursi as $it_rk) : ?>
                                                            <option value="entri_transaksi.php?meja=<?= $it_rk['meja_id'] ?>" <?= $it_rk['meja_id'] == $_GET['meja'] ? 'selected' : '' ?>><?= $it_rk['meja_id'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <?php foreach ($its_kursi as $it_rk) : ?>
                                                            <option value="entri_transaksi.php?meja=<?= $it_rk['meja_id'] ?>"><?= $it_rk['meja_id'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Member</label>
                                                <select name="member" class="form-control text-small">
                                                    <option selected value=""></option>
                                                    <?php foreach ($member as $m) : ?>
                                                        <option value="<?= $m['user_id'] ?>"><?= $m['user_nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Harga</label>
                                                <?php
                                                if (isset($_GET['meja'])) {
                                                    $q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$order[order_id]'");
                                                    $hartot = mysqli_fetch_assoc($q_hartot);
                                                    $toto = $hartot['hartot'];
                                                    $order_id = $order['order_id'];
                                                    $meja_url = $_GET['meja'];
                                                } else {
                                                    $meja_url = '';
                                                    $toto = '';
                                                    $order_id = '';
                                                }
                                                ?>
                                                <input type="hidden" name="meja" value="<?= $meja_url ?>">
                                                <input type="hidden" name="order_id" value="<?= $order_id ?>">

                                                <input type="text" name="total_harga" readonly required value="<?= $toto ?>" class="form-control hartot" placeholder="Total Harga">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Diskon</label>
                                                <input type="number" class="form-control diskon" min="0" max="100" name="diskon" value="0" placeholder="Diskon">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Bayar</label>

                                                <input type="number" readonly class="form-control totbayar" required value="<?= $toto ?>" name="total_bayar" placeholder="Total Bayar">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" min="1" class="form-control uang" required name="uang" placeholder="Uang">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" readonly class="form-control kembalian" required name="kembalian" placeholder="Kembalian">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-block btn-btn-sm btn-primary text-small">Bayar <i class="fas fa-money-bill"></i></button>

                                        </form>
                                    </div>
                                </div>


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
<script src="frontend/libraries/DataTables/datatables.min.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<script>
    // AOS.init();
    $(document).ready(function() {
        $('.datatables').DataTable();

        $('.diskon').on('keyup', function() {
            let hartot = $('.hartot').val();
            let diskon = $('.diskon').val();
            let diskonAkhir = hartot * diskon / 100;
            let anjay = hartot - diskonAkhir;
            $('.totbayar').val(anjay);
        })
        $('.uang').on('keyup', function() {
            let totbar = $('.totbayar').val();
            let uang = $('.uang').val();
            let kembalian = uang - totbar;
            $('.kembalian').val(kembalian);
            if (uang == 0) {
                $('.kembalian').val('');
            }
        })
    })
</script>
</body>

</html>