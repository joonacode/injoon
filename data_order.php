<?php

include 'templates/header.php';
$order = mysqli_query($conn, "SELECT * FROM tb_order WHERE order_status = 0 ORDER BY order_id DESC");
$ses = $_SESSION['role'];
if ($ses == 1 || $ses == 4 || $ses == 5) {
    header('Location:login.php');
}
?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Order</li>
            </ol>
        </nav>
        <h1>Data Order</h1>
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
                                <a href="menu.php" target="_blank" class="btn btn-sm btn-primary py-2 px-3 text-small">
                                    Entri Order <i class="fas fa-plus"></i>
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
                                                <th>Tanggal Order</th>
                                                <th>Total Bayar</th>
                                                <th>Keterangan</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($order as $orow) :
                                                $user_query =  mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$orow[user_id]'");
                                                $usr = mysqli_fetch_assoc($user_query);
                                                $q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$orow[order_id]'");
                                                $hartot = mysqli_fetch_assoc($q_hartot);
                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td><?= $orow['order_id'] ?></td>
                                                    <td><?= $orow['order_meja'] ?></td>
                                                    <td><?= date('d-m-Y H:i', $orow['order_tanggal']) ?></td>
                                                    <td>Rp. <?= rupiah($hartot['hartot']) ?></td>
                                                    <td><?= $orow['order_keterangan'] ?></td>

                                                    <td>
                                                        <a href="backend/order/hapus_order.php?id=<?= $orow['order_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                                        <button type="button" title="Detail Order" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailOrder_<?= $orow['order_id'] ?>"><i class="fas fa-eye"></i></button>
                                                        <?php if ($orow['order_status'] == 1) : ?>
                                                            <a href="print_struk.php?order_id=<?= $orow['order_id'] ?>" target="_blank" class="btn btn-warning text-white btn-sm text-small"><i class="fas fa-print"></i></a>
                                                        <?php endif; ?>
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

<!-- Modal tambah user -->
<div class="modal fade" id="tambah-user" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title">Tambah User</b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/user/tambah_user.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="number" name="telp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" class="form-control text-small">
                                    <option value="2">Admin</option>
                                    <option value="3">Waiter</option>
                                    <option value="4">Kasir</option>
                                    <option value="5">Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control text-small"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Verifikasi Password</label>
                                <input type="password" name="v_password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary text-small">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah user -->
<?php foreach ($order as $detRow) : ?>
    <div class="modal fade" id="detailOrder_<?= $detRow['order_id'] ?>" tabindex="1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title">List Pesanan</b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $detail_order = mysqli_query($conn, "SELECT * FROM tb_detail_order WHERE order_id = '$detRow[order_id]'");
                    $q_hartot = mysqli_query($conn, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE order_id = '$detRow[order_id]'");
                    $hartot = mysqli_fetch_assoc($q_hartot);
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="height:400px;overflow-y:scroll;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10">No</th>
                                            <th>Nama</th>
                                            <th width="200">Deskripsi</th>
                                            <th>Harga</th>
                                            <th width="10">Jumlah</th>
                                            <th>Harga Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($detail_order as $list_row) :
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
            </div>
        </div>
    </div>
<?php endforeach; ?>
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
    })
</script>
</body>

</html>