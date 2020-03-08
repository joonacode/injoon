<?php

require 'templates/landing_header2.php';

if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $masakan = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE masakan_nama LIKE '%$q%' ORDER BY masakan_id DESC");
    $cek_ada = mysqli_num_rows($masakan);
} else {
    $halaman = (isset($_GET['h']) ? $_GET['h'] : 1);
    $limit = 12;
    $mulai = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;
    $masakan = mysqli_query($conn, "SELECT * FROM tb_masakan ORDER BY masakan_id DESC LIMIT $mulai, $limit");
    $cek_ada = mysqli_num_rows($masakan);
}

?>
<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="menu.php" class="text-decoration-none">Menu</a></li>
                <?php if (isset($_GET['kategori'])) :
                    $q_kat = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '$_GET[kategori]'");
                    $kat = mysqli_fetch_assoc($q_kat);
                ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $kat['kategori_nama'] ?> <?= isset($_POST['q']) ? ' : ' . $_POST['q'] : '' ?></li>
                <?php else : ?>
                    <li class="breadcrumb-item active" aria-current="page">Semua menu <?= isset($_POST['q']) ? ' : ' . $_POST['q'] : '' ?></li>
                <?php endif; ?>
            </ol>
        </nav>
        <?php if (isset($_GET['kategori'])) :
            $q_kat = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '$_GET[kategori]'");
            $kat = mysqli_fetch_assoc($q_kat);
        ?>
            <h1><?= $kat['kategori_nama'] ?></h1>
        <?php else : ?>
            <h1>List Semua Menu</h1>
        <?php endif; ?>
    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm border-0">
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
                    <div class="col-md-9">
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
                        <form method="POST">
                            <div class="input-group my-1">
                                <input type="text" name="q" class="form-control" placeholder="Cari menu...">
                                <button class="input-group-append btn btn-sm btn-primary text-small"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="isi-menu">
    <div class="container">
        <div class="row mb-3">
            <?php if (isset($_GET['kategori'])) :
                if (isset($_POST['q'])) {
                    $qn = $_POST['q'];
                    $masakan_kategori = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE kategori_id = '$_GET[kategori]' AND masakan_nama LIKE '%$qn%' ORDER BY masakan_id DESC");
                    $cek_available = mysqli_num_rows($masakan_kategori);
                } else {
                    $halaman = (isset($_GET['h']) ? $_GET['h'] : 1);
                    $limit = 12;
                    $mulai = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;
                    $masakan_kategori = mysqli_query($conn, "SELECT * FROM tb_masakan WHERE kategori_id = '$_GET[kategori]' ORDER BY masakan_id DESC LIMIT $mulai, $limit");
                    $cek_available = mysqli_num_rows($masakan_kategori);
                }
            ?>
                <?php if ($cek_available == null) : ?>
                    <div class="col-md-6 mx-auto mt-5">

                        <h5 class="text-center">OPPS MENU YANG ANDA CARI TIDAK ADA</h5>
                        <img src="frontend/images/empty.png" class="img-fluid" alt="">
                        <a href="menu.php?kategori=<?= $_GET['kategori'] ?>" class="btn btn-sm btn-outline-primary btn-block text-center">Kembali <i class="fas fa-undo"></i></a>
                    </div>
                <?php endif; ?>
                <?php foreach ($masakan_kategori as $row) : ?>
                    <div class="col-md-4 col-lg-3 col-sm-6 mb-4 col-me" data-aos="fade-up" data-aos-duration="500">
                        <div class="card shadow-sm border-0">
                            <div class="card-header-menu">
                                <img src="frontend/images/masakan/<?= $row['masakan_gambar'] ?>" class="card-img-top gambar-menu" alt="...">
                            </div>
                            <div class="card-body">
                                <a href="#" class="menu-title mb-1">
                                    <?= $row['masakan_nama'] ?>
                                </a>
                                <p class="menu-harga mt-1">
                                    <?php if ($row['masakan_ds'] == 1) : ?>

                                        <span class="text-danger harga-diskon-br">Rp. <?= rupiah($row['masakan_harga']) ?></span>
                                        <span style="font-size:10px;"><s>Rp. <?= rupiah($row['masakan_hsd']) ?></s></span>
                                        <span class="badge badge-success float-right">- <?= $row['masakan_diskon'] ?>%</span>
                                    <?php else : ?>
                                        Rp. <?= rupiah($row['masakan_harga']) ?>
                                    <?php endif; ?> </p>
                                <?php if (isset($_SESSION['login'])) : ?>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) : ?>
                                        <button type="button" data-toggle="modal" data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php else : ?>
                                        <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <?php if ($cek_ada == null) : ?>
                    <div class="col-md-6 mx-auto mt-5">

                        <h5 class="text-center">OPPS MENU YANG ANDA CARI TIDAK ADA</h5>
                        <img src="frontend/images/empty.png" class="img-fluid" alt="">
                        <a href="menu.php" class="btn btn-sm btn-outline-primary btn-block text-center">Kembali <i class="fas fa-undo"></i></a>
                    </div>
                <?php endif; ?>
                <?php foreach ($masakan as $row) : ?>
                    <div class="col-md-4 col-lg-3 col-sm-6 mb-4 col-me" data-aos="fade-up" data-aos-duration="500">
                        <div class="card shadow-sm border-0">
                            <div class="card-header-menu">
                                <img src="frontend/images/masakan/<?= $row['masakan_gambar'] ?>" class="card-img-top gambar-menu" alt="...">
                            </div>
                            <div class="card-body">
                                <a href="#" class="menu-title mb-1">
                                    <?= $row['masakan_nama'] ?>
                                </a>
                                <p class="menu-harga mt-1">
                                    <?php if ($row['masakan_ds'] == 1) : ?>

                                        <span class="text-danger harga-diskon-br">Rp. <?= rupiah($row['masakan_harga']) ?></span>
                                        <span style="font-size:10px;"><s>Rp. <?= rupiah($row['masakan_hsd']) ?></s></span>
                                        <span class="badge badge-success float-right">- <?= $row['masakan_diskon'] ?>%</span>
                                    <?php else : ?>
                                        Rp. <?= rupiah($row['masakan_harga']) ?>
                                    <?php endif; ?>
                                </p>
                                <?php if (isset($_SESSION['login'])) : ?>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) : ?>
                                        <button type="button" data-toggle="modal" data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php else : ?>
                                        <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <button type="button" data-toggle="modal" disabled data-target="#dMasakan_<?= $row['masakan_id'] ?>" class="btn btn-sm my-1 btn-kategori-active bg-primary text-white btn-block">Pesan <i class="fas fa-shopping-basket"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if (isset($_GET['kategori'])) : ?>
                    <?php if (isset($_POST['q'])) : ?>

                    <?php else : ?>
                        <?php
                        $jumlah_masakan = mysqli_query($conn, "SELECT COUNT(masakan_id) as jumlah_menu FROM tb_masakan WHERE kategori_id = '$_GET[kategori]'");
                        $get_jumlah = mysqli_fetch_assoc($jumlah_masakan);
                        $jumlah_halaman = ceil($get_jumlah['jumlah_menu'] / $limit);
                        $jumlah_number = 10;
                        for ($i = 1; $i <= $jumlah_halaman; $i++) :
                            $link_active = ($halaman == $i) ? 'active' : '';
                        ?>
                            <li class="page-item <?= $halaman == $i ? 'active' : '' ?>"><a class="page-link text-small" href="menu.php?kategori=<?= $_GET['kategori'] ?>&h=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>

                <?php else : ?>
                    <?php if (isset($_POST['q'])) : ?>

                    <?php else : ?>
                        <?php
                        $jumlah_masakan = mysqli_query($conn, "SELECT COUNT(masakan_id) as jumlah_menu FROM tb_masakan");
                        $get_jumlah = mysqli_fetch_assoc($jumlah_masakan);
                        $jumlah_halaman = ceil($get_jumlah['jumlah_menu'] / $limit);
                        $jumlah_number = 10;
                        for ($i = 1; $i <= $jumlah_halaman; $i++) :
                            $link_active = ($halaman == $i) ? 'active' : '';
                        ?>
                            <li class="page-item <?= $halaman == $i ? 'active' : '' ?>"><a class="page-link text-small" href="menu.php?h=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>
        </nav>
    </div>
</section>

<!-- Modal -->
<?php foreach ($masakan as $d_masakan) : ?>
    <div class="modal fade" id="dMasakan_<?= $d_masakan['masakan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle" style="font-size:16px;" id="exampleModalLabel"><?= $d_masakan['masakan_nama'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="backend/order/tambah_pesan.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="frontend/images/masakan/<?= $d_masakan['masakan_gambar'] ?>" class="card-img-top" alt="...">

                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="masakan_id" value="<?= $d_masakan['masakan_id'] ?>">
                                <div class="form-group">
                                    <label for="">Menu</label>
                                    <input type="text" readonly class="form-control" value="<?= $d_masakan['masakan_nama'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" readonly class="form-control" value="Rp. <?= rupiah($d_masakan['masakan_harga']) ?>">
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
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Tutup <i class="fas fa-times"></i></button>
                        <button type="submit" class="btn btn-primary text-small">Simpan <i class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php require 'templates/footer.php' ?>