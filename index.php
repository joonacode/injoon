<?php

require 'templates/landing_header.php';

$best_seller = mysqli_query($conn, "SELECT * FROM tb_best_seller ORDER BY jumlah_jual DESC LIMIT 4");

?>

<!-- Header -->
<header class="header-text ">
    <div class="container">

        <h1 data-aos="zoom-in" data-aos-duration="1000">
            <?= $pengaturan['pengaturan_headerWebsite'] ?>
        </h1>
        <p class="mt-3 " data-aos="zoom-in" data-aos-duration="1600">
            <?= nl2br($pengaturan['pengaturan_deskripsiWebsite']) ?>
        </p>
        <a href="#best-seller" class="btn btn-get-started main shadow-sm mr-3 mt-3" data-aos="zoom-in-up" data-aos-duration="600">
            Menu Populer
        </a>
        <a href="menu.php" class="btn btn-get-started shadow-sm mt-3" data-aos="zoom-in-up" data-aos-duration="600">
            Semua Menu
        </a>
    </div>

</header>
<main>
    <section class="section-about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <img src="frontend/images/tentang_kami.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 col-md-12 ml-auto">
                    <h1 data-aos="fade-right" data-aos-duration="500">Tentang Kami</h1>
                    <p data-aos="fade-right" data-aos-duration="600">
                        <?= nl2br($pengaturan['pengaturan_tentang']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="its-hr"></div>
    </section>
    <div class="bg-best-seller"></div>
    <section class="section-best-seller" id="best-seller">
        <div class="container">
            <h1 class="text-center text-white" data-aos="zoom-in-up" data-aos-duration="500">Menu Populer</h1>
            <div class="row">
                <?php
                $duration = [700, 900, 1100, 1300];
                ?>
                <?php foreach ($best_seller as $bs => $v) :
                    $q_masakBest = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_id = '$v[masakan_id]'");
                    $masakBest = mysqli_fetch_assoc($q_masakBest);
                ?>
                    <div class="col-md-4 col-lg-3 col-sm-6 mb-4 col-me" data-aos="fade-up" data-aos-duration="<?= $duration[$bs] ?>">
                        <div class="card shadow-sm border-0">
                            <div class="card-header-menu">
                                <img src="frontend/images/masakan/<?= $masakBest['masakan_gambar'] ?>" class="card-img-top gambar-menu" alt="...">
                            </div>
                            <div class="card-body">
                                <a href="#" class="menu-title mb-1">
                                    <?= $masakBest['masakan_nama'] ?>
                                </a>
                                <p class="menu-harga mt-1">
                                    <?php if ($masakBest['masakan_ds'] == 1) : ?>

                                        <span class="text-danger harga-diskon-br">Rp. <?= rupiah($masakBest['masakan_harga']) ?></span>
                                        <span style="font-size:10px;"><s>Rp. <?= rupiah($masakBest['masakan_hsd']) ?></s></span>
                                        <span class="badge badge-success float-right">- <?= $masakBest['masakan_diskon'] ?>%</span>
                                    <?php else : ?>
                                        Rp. <?= rupiah($masakBest['masakan_harga']) ?>
                                    <?php endif; ?>
                                </p>
                                <?php if (isset($_SESSION['login'])) : ?>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) : ?>
                                        <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $masakBest['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php else : ?>
                                        <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $masakBest['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $masakBest['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="text-center">
                <a href="menu.php" class="btn btn-all-menu mt-5 shadow" data-aos="zoom-in-up" data-aos-duration="600">Lihat Semua Menu</a>
            </div>
        </div>
    </section>
    <section class="section-testimoni" id="testimoni">
        <div class="container">
            <h1 data-aos="zoom-in-up" data-aos-duration="500">
                Testimoni Pengunjung
            </h1>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm border-0" data-aos="zoom-in-up" data-aos-duration="700">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-ms-12 profile-testimoni text-center">
                                    <img src="frontend/images/profile.png" class="rounded-circle" alt="">
                                    <p>James <br>
                                        <spam style="font-size: 10px">-- CEO JSTUDIO --</spam>
                                    </p>
                                </div>
                                <div class="col">
                                    <div class="stars text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p class="mt-3 testimoni-desk" style="font-weight:300">
                                        Restoran terbaik yang pernah saya kunjungi pelayanannya baik, tempatnya bersih, tersedia wifi gratis
                                        Menunya banyak, murah-murah, dan yang paling terbaik rasanya enak
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="section-contact" id="kontak-kami">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="card c-form" data-aos="zoom-in-right" data-aos-duration="600">
                        <div class="card-body">
                            <h1 class="text-center">Kontak Kami</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-small border-left-0 border-right-0 border-top-0" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-small border-left-0 border-right-0 border-top-0" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control text-small border-left-0 border-right-0 border-top-0" placeholder="Pesan" style="height: 120px"></textarea>
                                    </div>
                                    <button type="button" onclick="alert('Template Ini Dibuat Oleh JoonaCode')" class="btn text-small btn-primary shadow">Kirim <i class="fas fa-envelope"></i></button>
                                    <div class="sosial mt-4">
                                        <a href="#" class="badge badge-primary rounded shadow-sm p-2">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#" class="badge badge-success shadow-sm rounded p-2">
                                            <i class="fab fa-whatsapp"></i> 0821-2160-9346
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="section-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3 mx-auto">
                    <h4>INJOON</h4>
                    <p class="">Bandung Selatan</p>
                    <p class="">0898-9987-3234</p>
                    <p class="">injoon@gmail.com</p>
                </div>
                <div class="col-md-3 mb-3 mx-auto">
                    <h4>Navigasi</h4>
                    <a href="index.php" class="btn btn-sm text-small btn-secondary mb-1">Home</a>
                    <a href="menu.php" class="btn btn-sm text-small btn-secondary mb-1">Menu</a>
                    <a href="#about" class="btn btn-sm text-small btn-secondary mb-1">About</a>
                    <a href="#kontak-kami" class="btn btn-sm text-small btn-secondary mb-1">Kontak</a>
                    <a href="#testimoni" class="btn btn-sm text-small btn-secondary mb-1">Testimoni</a>
                    <a href="#best-seller" class="btn btn-sm text-small btn-secondary mb-1">Menu Populer</a>
                </div>
                <div class="col-md-3 mb-3 mx-auto">
                    <h4>Social Media</h4>
                    <p><a href="#" class="text-decoration-none text-dark">Instagram</a></p>
                    <p><a href="#" class="text-decoration-none text-dark">Facebook</a></p>
                    <p><a href="#" class="text-decoration-none text-dark">Twitter</a></p>
                </div>
                <div class="col-md-3 mb-3 mx-auto">
                    <h4>Jam Buka</h4>
                    <p class="">Senin-Jum'at 08:00 - 20.00</p>
                    <p class="">Sabtu-Minggu 08:00 - 24:00</p>
                    <p class="">Hari Nasional Libur</p>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-3">
        <div class="container text-center">
            <p class="mb-0" style="font-size: 16px;">
                <?= $pengaturan['pengaturan_footer'] ?>
            </p>
        </div>
    </footer>
</main>



<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<script>
    AOS.init();
</script>
</body>

</html>