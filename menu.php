<?php

require 'templates/landing_header.php';

$masakan = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC");

?>
<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
        <h1>List Semua Menu</h1>
    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_SESSION['pesan'])) : ?>
                            <?= $_SESSION['pesan'] ?>
                        <?php
                            unset($_SESSION['pesan']);
                        endif;
                        ?>
                    </div>
                    <div class="col-9">
                        <?php if (isset($_GET['kategori'])) : ?>
                            <a href="menu.php" class="btn btn-sm my-1 btn-kategori">Semua</a>
                        <?php else : ?>
                            <a href="menu.php" class="btn btn-sm my-1 btn-kategori-active">Semua</a>
                        <?php endif; ?>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                        foreach ($kategori as $r_kat) :
                        ?>
                            <?php if (isset($_GET['kategori'])) : ?>
                                <a href="menu.php?kategori=<?= $r_kat['kategori_id'] ?>" class="btn btn-sm my-1 btn-kategori<?= $r_kat['kategori_id'] == $_GET['kategori'] ? '-active' : '' ?>"><?= $r_kat['kategori_nama'] ?></a>
                            <?php else : ?>
                                <a href="menu.php?kategori=<?= $r_kat['kategori_id'] ?>" class="btn btn-sm my-1 btn-kategori"><?= $r_kat['kategori_nama'] ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group my-1">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="isi-menu">
    <div class="container">
        <div class="row">
            <?php if (isset($_GET['kategori'])) :
                $masakan_kategori = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE kategori_id = '$_GET[kategori]' ORDER BY masakan_id DESC");
            ?>

                <?php foreach ($masakan_kategori as $row) : ?>
                    <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-duration="500">
                        <div class="card">
                            <img src="frontend/images/masakan/<?= $row['masakan_gambar'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="menu-title mb-1">
                                    <?= $row['masakan_nama'] ?>
                                </a>
                                <p class="menu-harga mt-1">
                                    Rp. <?= $row['masakan_harga'] ?>
                                </p>
                                <a href="#" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($masakan as $row) : ?>
                    <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-duration="500">
                        <div class="card">
                            <img src="frontend/images/masakan/<?= $row['masakan_gambar'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="menu-title mb-1">
                                    <?= $row['masakan_nama'] ?>
                                </a>
                                <p class="menu-harga mt-1">
                                    Rp. <?= $row['masakan_harga'] ?>
                                </p>
                                <button type="button" data-toggle="modal" data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Modal -->
<?php foreach ($masakan as $d_masakan) : ?>
    <div class="modal fade" id="dMasakan_<?= $d_masakan['masakan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle" style="font-size:16px;" id="exampleModalLabel"><?= $d_masakan['masakan_nama'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="backend/order/tambah_pesan.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="masakan_id" value="<?= $d_masakan['masakan_id'] ?>">
                        <div class="form-group">
                            <label for="">Menu</label>
                            <input type="text" readonly class="form-control" value="<?= $d_masakan['masakan_nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" readonly class="form-control" value="<?= $d_masakan['masakan_harga'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Pesanan</label>
                            <input type="number" name="jumlah" min="1" max="20" value="1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" class="form-control text-small"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary text-small">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<script>
    AOS.init();
</script>
</body>

</html>