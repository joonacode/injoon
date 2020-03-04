<?php

require 'templates/landing_header.php';

?>

<!-- Header -->
<header class="header-text ">
    <div class="container">

        <h1 class="">
            Injoon Restaurant
        </h1>
        <p class="mt-3 ">Restaurant kelas atas dengan harga <br>
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
                <div class="col-lg-4 col-md-12">
                    <img src="frontend/images/tentang_kami.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 col-md-12 ml-auto">
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
        <div class="its-hr"></div>
    </section>
    <div class="bg-best-seller"></div>
    <section class="section-best-seller" id="best-seller">
        <div class="container">
            <h1 class="text-center text-white">Best Seller</h1>
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
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
                <div class="col-md-3 col-sm-6 mb-3">
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
                <div class="col-md-3 col-sm-6 mb-3">
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
                <div class="col-md-3 col-sm-6 mb-3">
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
                                    <div class="stars text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p class="mt-3 testimoni-desk" style="font-weight:300">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta impedit dicta iure natus beatae laboriosam, nam culpa! Corrupti, nisi architecto.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="section-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="card c-form">
                        <div class="card-body">
                            <h1 class="text-center">Kontak Kami</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-small" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-small" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control text-small" placeholder="Pesan" style="height: 120px"></textarea>
                                    </div>
                                    <button type="submit" class="btn text-small btn-primary">Kirim <i class="fas fa-envelope"></i></button>
                                    <div class="sosial mt-4">
                                        <a href="#" class="badge badge-primary rounded p-2">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#" class="badge badge-success rounded p-2">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="#" class="badge badge-danger rounded p-2">
                                            <i class="fab fa-facebook-f"></i>
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
    <section class="section-footer border-top py-5 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-3 mx-auto">
                            <h4>Services</h4>
                            <p class="text-small">Bandung Selatan</p>
                            <p class="text-small">0898-9987-3234</p>
                            <p class="text-small">injoon@gmail.com</p>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <h4>Navigasi</h4>
                            <p class="text-small">Home</p>
                            <p class="text-small">About</p>
                            <p class="text-small">Menu</p>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <h4>Social Media</h4>
                            <p class="text-small">Instagram</p>
                            <p class="text-small">Facebook</p>
                            <p class="text-small">Twitter</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-3">
        <div class="container text-center">
            <p class="mb-0">Copyright injoon &copy; 2020</p>
        </div>
    </footer>
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