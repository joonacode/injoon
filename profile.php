<?php

include 'templates/header.php';



?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <h1>Profile</h1>
    </div>
</section>

<section class="list-menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-md-12 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php if (isset($_SESSION['pesan'])) : ?>
                            <?= $_SESSION['pesan'] ?>
                        <?php
                            unset($_SESSION['pesan']);
                        endif;
                        ?>
                        <div class="text-center">
                            <img src="frontend/images/profile/<?= $user['user_foto'] ?>" class="img-thumbnail rounded-circle" width="150" alt="">
                            <h3 class="mt-3"><?= $user['user_nama'] ?></h3>
                        </div>
                        <table class="table table-borderless mx-auto" style="width: 300px;">
                            <thead>
                                <tr>
                                    <th width="10"></th>
                                    <th width="10"></th>
                                    <th width="10"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td><?= $get_role['role_nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?= $user['user_username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telp</td>
                                    <td>:</td>
                                    <td><?= $user['user_telp'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?= $user['user_email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $user['user_alamat'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="kumpulan-btn text-center mt-3">
                            <button type="button" class="btn btn btn-primary text-small shadow" data-toggle="modal" data-target="#ubahProfile">Ubah Profile <i class="fas fa-user ml-1"></i></button>
                            <button type="button" class="btn btn btn-danger text-small shadow" data-toggle="modal" data-target="#ubahPassword">Ubah Password <i class="fas fa-key ml-1"></i></button>
                            <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')" class="btn btn btn-dark text-small shadow">Logout <i class="fas fa-sign-out-alt ml-1"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="ubahProfile" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Ubah Profile</p>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/user/ubah_user.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                    <input type="hidden" name="itsProfile" value="y">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" value="<?= $user['user_nama'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="number" name="telp" value="<?= $user['user_telp'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="<?= $user['user_email'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" value="<?= $user['user_username'] ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="role" value="<?= $user['role_id'] ?>">
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="from-group">
                                <label>Gambar Lama</label><br>
                                <img src="frontend/images/profile/<?= $user['user_foto'] ?>" class="img-thumbnail" width="100" alt="">
                                <input type="hidden" name="gambar_lama" value="<?= $user['user_foto'] ?>">
                                <br>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control text-small"><?= $user['user_alamat'] ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block text-small">Simpan Perubahan <i class="fas fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahPassword" tabindex="1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">
                    Ubah Password
                </p>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/user/ubahPassword_user.php" method="POST">
                    <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                    <div class="form-group">
                        <label for="">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control text-small" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control text-small">
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password Baru</label>
                        <input type="password" name="vpassword_baru" class="form-control text-small">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block text-small">Simpan Perubahan <i class="fas fa-save"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>

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