<?php

require 'templates/landing_header.php';

?>

<!-- Header -->
<header class="header-text">
    <div class="container">

        <h1>
            Injoon Restaurant
        </h1>
        <p class="mt-3">Restaurant kelas atas dengan harga <br>
            kelas bawah. Menyediakan berbagai<br>
            hidangan local lezat dan menarik.
        </p>
        <a href="menu.php" class="btn btn-get-started main mr-3 mt-3">
            Jelajahi Menu
        </a>
        <a href="#about-game" class="btn btn-get-started mt-3">
            Kontak Kami
        </a>
    </div>

</header>
<main>
    <section class="section-about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="frontend/images/tentang_kami.png" alt="">
                </div>
                <div class="col-md-7 ml-auto">
                    <h1>Tentang Kami</h1>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis consequatur ex,
                        veritatis odit aliquam ad, illum quis omnis quas, placeat natus soluta assumenda. Ullam
                        incidunt maiores labore. Eum aliquam pariatur fugiat, facilis ratione voluptas labore
                        impedit culpa recusandae deserunt architecto fuga quos ipsa iure rem quasi nobis ab aut.

                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-best-seller" id="best-seller">
        <div class="container">
            <h1 class="text-center">Best Seller</h1>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <img src="frontend/images/bg_menu.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#" class="menu-title mb-1">
                                Gehu Pedas
                            </a>
                            <p class="menu-harga mt-1">
                                Rp. 10.000
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <img src="frontend/images/menu1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#" class="menu-title mb-1">
                                Gehu Pedas
                            </a>
                            <p class="menu-harga mt-1">
                                Rp. 10.000
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <img src="frontend/images/menu1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#" class="menu-title mb-1">
                                Gehu Pedas
                            </a>
                            <p class="menu-harga mt-1">
                                Rp. 10.000
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <img src="frontend/images/menu1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#" class="menu-title mb-1">
                                Gehu Pedas
                            </a>
                            <p class="menu-harga mt-1">
                                Rp. 10.000
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="menu.html" class="btn btn-all-menu mt-5">Lihat Semua Menu</a>
            </div>
        </div>
    </section>
    <section class="section-testimoni" id="testimoni">
        <div class="container">
            <h1>
                Testimoni Pengunjung
            </h1>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 profile-testimoni text-center">
                                    <img src="frontend/images/profile.png" class="rounded-circle" alt="">
                                    <p>James</p>
                                </div>
                                <div class="col">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>



<script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
<script src="frontend/libraries/aos/aos.js"></script>
<script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
<!-- <script>
        AOS.init();
    </script> -->
</body>

</html>