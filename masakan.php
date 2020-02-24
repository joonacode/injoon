<?php

include 'templates/header.php';
$masakan = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC");

?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Master Masakan</li>
            </ol>
        </nav>
        <h1>Master Masakan</h1>
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
                                <button class="btn btn-sm btn-primary py-2 px-3 text-small" data-toggle="modal" data-target="#tambah-user">
                                    Tambah Data <iclass="fas fa-plus"></i>
                                </button>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover datatables">
                                        <thead>
                                            <tr>
                                                <th width="10">No</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($masakan as $mas) :
                                                $kat = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '$mas[kategori_id]'");
                                                $query_kat = mysqli_fetch_assoc($kat);
                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td>
                                                        <img src="frontend/images/masakan/<?= $mas['masakan_gambar'] ?>" class="img-fluid" width="120" alt="">
                                                    </td>
                                                    <td><?= $mas['masakan_nama'] ?></td>
                                                    <td><?= $mas['masakan_harga'] ?></td>
                                                    <td><?= $query_kat['kategori_nama'] ?></td>
                                                    <td><?= $mas['masakan_deskripsi'] ?></td>
                                                    <td>
                                                        <a href="backend/masakan/hapus_masakan.php?id=<?= $mas['masakan_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                                        <button type="button" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#ubahMasakan_<?= $mas['masakan_id'] ?>"><i class="fas fa-pen"></i></button>
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
                <b class="modal-title">Tambah Masakan</b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/masakan/tambah_masakan.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama Masakan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="kategori" class="form-control text-small" required>
                            <option selected disabled>-- Pilih Kategori --</option>
                            <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_nama ASC");
                            foreach ($kategori as $row_kategori) :
                            ?>
                                <option value="<?= $row_kategori['kategori_id'] ?>"><?= $row_kategori['kategori_nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control text-small" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary text-small">Tambah</button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah user -->
<?php foreach ($masakan as $u_masakan) : ?>
    <div class="modal fade" id="ubahMasakan_<?= $u_masakan['masakan_id'] ?>" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title">Tambah Masakan</b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/masakan/ubah_masakan.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $u_masakan['masakan_id'] ?>">
                        <div class="form-group">
                            <label for="">Nama Masakan</label>
                            <input type="text" value="<?= $u_masakan['masakan_nama'] ?>" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" name="harga" value="<?= $u_masakan['masakan_harga'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori" class="form-control text-small" required>
                                <option selected disabled>-- Pilih Kategori --</option>
                                <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_nama ASC");
                                foreach ($kategori as $row_kategori) :
                                ?>
                                    <option value="<?= $row_kategori['kategori_id'] ?>" <?= $row_kategori['kategori_id'] == $u_masakan['kategori_id'] ? 'selected' : '' ?>><?= $row_kategori['kategori_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control text-small" required><?= $u_masakan['masakan_deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Gambar</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="from-group">
                            <label>Gambar Lama</label><br>
                            <img src="frontend/images/masakan/<?= $u_masakan['masakan_gambar'] ?>" class="img-thumbnail" width="100" alt="">
                            <input type="hidden" name="gambar_lama" value="<?= $u_masakan['masakan_gambar'] ?>">
                            <br>
                            <br>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary text-small">Ubah</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


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