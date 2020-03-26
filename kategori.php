<?php

include 'templates/header.php';
$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC");

if ($_SESSION['role'] != 2) {
    header('Location:login.php');
}


?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>
        <h1>Kategori</h1>
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
                                <button class="btn btn-sm btn-primary py-2 px-3 text-small" data-toggle="modal" data-target="#tambah-user">
                                    Tambah Data <i class="fas fa-plus"></i>
                                </button>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover datatables">
                                        <thead>
                                            <tr>
                                                <th width="10">No</th>
                                                <th>Nama Kategori</th>
                                                <th width="100">Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($kategori as $kat) :

                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td><?= $kat['kategori_nama'] ?></td>
                                                    <td>
                                                        <a href="backend/kategori/hapus_kategori.php?id=<?= $kat['kategori_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                                        <button type="button" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#ubahUser_<?= $kat['kategori_id'] ?>"><i class="fas fa-pen"></i></button>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title">Tambah Kategori</b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/kategori/tambah_kategori.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary text-small">Tambah <i class="fas fa-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal ubah user -->
<?php foreach ($kategori as $ubahRow) : ?>
    <div class="modal fade" id="ubahUser_<?= $ubahRow['kategori_id'] ?>" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title">Ubah User</b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/kategori/ubah_kategori.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="hidden" name="id" value="<?= $ubahRow['kategori_id'] ?>">
                            <input type="text" name="nama" value="<?= $ubahRow['kategori_nama'] ?>" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary text-small">Simpan Perubah <i class="fas fa-save"></i></button>
                    </form>
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