<?php

include 'templates/header.php';
$masakan = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC");

if ($_SESSION['role'] != 2) {
    header('Location:hayuu.php');
}

?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Masakan</li>
            </ol>
        </nav>
        <h1>Data Masakan</h1>
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
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Harga Diskon</th>
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
                                                    <td>Rp. <?= rupiah($mas['masakan_hsd']) ?></td>
                                                    <td><span class="btn btn-<?= $mas['masakan_ds'] == 1 ? 'success' : 'danger' ?> text-small btn-sm"><?= $mas['masakan_diskon'] ?>%</span></td>
                                                    <td>Rp. <?= rupiah($mas['masakan_harga']) ?></td>
                                                    <td><?= $query_kat['kategori_nama'] ?></td>
                                                    <td><?= $mas['masakan_deskripsi'] ?></td>
                                                    <td>
                                                        <a href="backend/masakan/hapus_masakan.php?id=<?= $mas['masakan_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                                        <button type="button" class="btn btn-sm btn-secondary text-small text-white modalUbahMasakan" data-toggle="modal" data-idmasak='<?= $mas['masakan_id'] ?>' data-target="#ubahMasakan_<?= $mas['masakan_id'] ?>"><i class="fas fa-pen"></i></button>
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
                        <label for="">Diskon</label>
                        <select name="diskon_status" class="form-control text-small cekDiskon">
                            <option value="0">Tidak ada diskon</option>
                            <option value="1">Ada diskon</option>
                        </select>
                    </div>
                    <div class="row diskon-hidden" style="display: none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" name="harga_sebelum_diskon" class="form-control h-d">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input type="text" name="diskonnya" class="form-control text-small d-s">
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Harga Setelah Diskon</label>
                                <input type="number" name="harga_setelah_diskon" readonly class="form-control h-akhir">
                            </div>
                        </div>
                    </div>

                    <div class="form-group harga-show">
                        <label for="">Harga</label>
                        <input type="number" name="harga" class="form-control">
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
                        <label for="">Gambar <sup>*Max size 2mb</sup></label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary text-small">Tambah <i class="fas fa-plus"></i></button>

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
                            <label for="">Diskon <sup>*Pilih untuk mengubah status</sup></label>
                            <select name="diskon_status" class="form-control text-small cekDiskon-u" data-idM="<?= $u_masakan['masakan_id'] ?>">
                                <option value="0" <?= $u_masakan['masakan_ds'] ==  0 ? 'selected' : '' ?>>Tidak ada diskon</option>
                                <option value="1" <?= $u_masakan['masakan_ds'] ==  1 ? 'selected' : '' ?>>Ada diskon</option>
                            </select>
                        </div>
                        <div class="row diskon-hidden-u" style="display: <?= $u_masakan['masakan_ds'] ==  1 ? 'flex' : 'none' ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga</label>

                                    <input type="number" value="<?= $u_masakan['masakan_ds'] == 1 ? $u_masakan['masakan_hsd'] : $u_masakan['masakan_harga'] ?>" name="harga_sebelum_diskon" class="form-control h-d-<?= $u_masakan['masakan_id'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Diskon</label>
                                    <input type="text" name="diskonnya" value="<?= $u_masakan['masakan_diskon'] ?>" class="form-control text-small d-s-<?= $u_masakan['masakan_id'] ?>">
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Harga Setelah Diskon</label>
                                    <input type="number" name="harga_setelah_diskon" value="<?= $u_masakan['masakan_harga'] ?>" readonly class="form-control h-akhir-<?= $u_masakan['masakan_id'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group harga-show-u" style="display: <?= $u_masakan['masakan_ds'] ==  1 ? 'none' : 'block' ?>">
                            <label for="">Harga</label>
                            <input type=" number" name="harga" value="<?= $u_masakan['masakan_harga'] ?>" class="form-control" required>
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
                            <label for="">Gambar <sup>*Max size 2mb</sup></label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="from-group">
                            <label>Gambar Lama</label><br>
                            <img src="frontend/images/masakan/<?= $u_masakan['masakan_gambar'] ?>" class="img-thumbnail" width="100" alt="">
                            <input type="hidden" name="gambar_lama" value="<?= $u_masakan['masakan_gambar'] ?>">
                            <br>
                            <br>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary text-small">Simpan Perubahan <i class="fas fa-save"></i></button>

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
        $('.cekDiskon').on('change', function() {
            let diskon = $('.cekDiskon').val();
            console.log(diskon);
            if (diskon == 1) {
                $('.diskon-hidden').show();
                $('.harga-show').hide();
                $('.d-s').on('keyup', function() {
                    let harga = $('.h-d').val();
                    let diskonInp = $('.d-s').val();
                    let diskonAkhir = harga * diskonInp / 100;
                    let hAkhir = harga - diskonAkhir;
                    $('.h-akhir').val(hAkhir);
                })
                $('.h-d').on('keyup', function() {
                    let harga = $('.h-d').val();
                    let diskonInp = $('.d-s').val();
                    let diskonAkhir = harga * diskonInp / 100;
                    let hAkhir = harga - diskonAkhir;
                    $('.h-akhir').val(hAkhir);
                })
            } else {
                $('.diskon-hidden').hide();
                $('.harga-show').show();
            }
        })



        $('.modalUbahMasakan').on('click', function() {

            let id = $(this).data('idmasak');
            console.log(id);
            $('.d-s-' + id).on('keyup', function() {
                let hargaU = $('.h-d-' + id).val();
                let diskonInpU = $('.d-s-' + id).val();
                let diskonAkhirU = hargaU * diskonInpU / 100;
                let hAkhirU = hargaU - diskonAkhirU;
                $('.h-akhir-' + id).val(hAkhirU);
                console.log(hargaU);
                console.log(diskonInpU);
            })
            $('.h-d-' + id).on('keyup', function() {
                let hargaU = $('.h-d-' + id).val();
                let diskonInpU = $('.d-s-' + id).val();
                let diskonAkhirU = hargaU * diskonInpU / 100;
                let hAkhirU = hargaU - diskonAkhirU;
                $('.h-akhir-' + id).val(hAkhirU);
                console.log(hargaU);
                console.log(diskonInpU);
            })

            $('.cekDiskon-u').on('change', function() {
                let diskonU = $(this).val();
                if (diskonU == 1) {
                    $('.diskon-hidden-u').show();
                    $('.harga-show-u').hide();
                    $('.d-s-' + id).on('keyup', function() {
                        let hargaU = $('.h-d-' + id).val();
                        let diskonInpU = $('.d-s-' + id).val();
                        let diskonAkhirU = hargaU * diskonInpU / 100;
                        let hAkhirU = hargaU - diskonAkhirU;
                        $('.h-akhir-' + id).val(hAkhirU);
                        console.log(hargaU);
                        console.log(diskonInpU);
                    })
                    $('.h-d-' + id).on('keyup', function() {
                        let hargaU = $('.h-d-' + id).val();
                        let diskonInpU = $('.d-s-' + id).val();
                        let diskonAkhirU = hargaU * diskonInpU / 100;
                        let hAkhirU = hargaU - diskonAkhirU;
                        $('.h-akhir-' + id).val(hAkhirU);
                        console.log(hargaU);
                        console.log(diskonInpU);
                    })
                } else {
                    $('.diskon-hidden-u').hide();
                    $('.harga-show-u').show();
                }
            })

        })

    })
</script>
</body>

</html>