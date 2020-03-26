<?php

require 'templates/header.php';
$q_pengaturan = mysqli_query($conn, "SELECT * FROM tb_pengaturan WHERE pengaturan_id = 1");
$pengaturan = mysqli_fetch_assoc($q_pengaturan);

if ($_SESSION['role'] != 1 && $_SESSION['role'] != 2) {
    header('Location:login.php');
}

?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
            </ol>
        </nav>

        <h1>Pengaturan</h1>

    </div>
</section>

<section class="list-menu mb-5">
    <div class="container">
        <div class="card shadow-sm">
            <form action="backend/pengaturan/ubah_pengaturan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (isset($_SESSION['pesan'])) : ?>
                        <?= $_SESSION['pesan'] ?>
                    <?php
                        unset($_SESSION['pesan']);
                    endif;
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Header Website</label>
                                <input type="text" name="header" value="<?= $pengaturan['pengaturan_headerWebsite'] ?>" class="form-control text-small">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi Website</label>
                                <textarea class="form-control text-small" name="deskripsi" style="height: 150px"><?= $pengaturan['pengaturan_deskripsiWebsite'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tentang Kami</label>
                                <textarea class="form-control text-small" name="tentang" style="height: 150px"><?= $pengaturan['pengaturan_tentang'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Footer</label>
                                <input type="text" name="footer" value="<?= $pengaturan['pengaturan_footer'] ?>" class="form-control text-small">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="logo" class="form-control text-small">
                                <input type="hidden" name="logo_lama" value="<?= $pengaturan['pengaturan_logo'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Logo Lama</label><br>
                                <img src="frontend/images/<?= $pengaturan['pengaturan_logo'] ?>" class="img-thumbnail" width="100" alt="">
                            </div>
                            <div class="form-group">
                                <label for="">Favicon</label>
                                <input type="file" name="favicon" class="form-control text-small">
                                <input type="hidden" name="favicon_lama" value="<?= $pengaturan['pengaturan_favicon'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Favicon Lama</label><br>
                                <img src="frontend/images/<?= $pengaturan['pengaturan_favicon'] ?>" class="img-thumbnail" width="100" alt="">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary text-small">Simpan Perubahan <i class="fas fa-save"></i></button>
                </div>
            </form>

        </div>
    </div>
</section>

<?php require 'templates/footer_text.php' ?>



<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<!-- <script>
        AOS.init();
    </script> -->
</body>

</html>