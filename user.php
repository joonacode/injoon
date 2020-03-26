<?php

include 'templates/header.php';
if ($_SESSION['role'] != 2) {
    $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id != '$_SESSION[id]' AND role_id = '5' ORDER BY user_id DESC");
} else {
    $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id != '$_SESSION[id]' ORDER BY user_id DESC");
}

if ($_SESSION['role'] != 2 && $_SESSION['role'] != 3 && $_SESSION['role'] != 4) {
    header('Location:login.php');
}


?>

<!-- Header -->
<section class="header-page">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>
        <h1>Data User</h1>
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
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Profile</th>
                                                <th>Telp</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($user as $urRow) :
                                                $role_query =  mysqli_query($conn, "SELECT * FROM tb_role WHERE role_id = '$urRow[role_id]'");
                                                $role = mysqli_fetch_assoc($role_query);
                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td>
                                                        <img src="frontend/images/profile/<?= $urRow['user_foto'] ?>" width="50" class="img-thumbnail" alt="">
                                                    </td>
                                                    <td><?= $urRow['user_nama'] ?></td>
                                                    <td><?= $urRow['user_telp'] ?></td>
                                                    <td><?= $urRow['user_email'] ?></td>
                                                    <td><?= $urRow['user_username'] ?></td>
                                                    <td><?= $role['role_nama'] ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['role'] == 2) : ?>
                                                            <a href="backend/user/hapus_user.php?id=<?= $urRow['user_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                                                            <button type="button" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#ubahUser_<?= $urRow['user_id'] ?>"><i class="fas fa-pen"></i></button>
                                                        <?php endif; ?>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title">Tambah User</b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/user/tambah_user.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="number" name="telp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" class="form-control text-small">
                                    <?php if ($_SESSION['role'] != 2) : ?>
                                        <option value="5">Member</option>
                                    <?php else : ?>
                                        <option value="2">Admin</option>
                                        <option value="3">Waiter</option>
                                        <option value="4">Kasir</option>
                                        <option value="5">Member</option>

                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control text-small"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Foto Profile <sup>*Optional</sup></label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Verifikasi Password</label>
                                <input type="password" name="v_password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary text-small">Tambah <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah user -->
<?php foreach ($user as $ubahRow) : ?>
    <div class="modal fade" id="ubahUser_<?= $ubahRow['user_id'] ?>" tabindex="1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title">Ubah User</b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/user/ubah_user.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $ubahRow['user_id'] ?>">
                        <input type="hidden" name="itsProfile" value="n">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" value="<?= $ubahRow['user_nama'] ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Telepon</label>
                                    <input type="number" name="telp" value="<?= $ubahRow['user_telp'] ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="<?= $ubahRow['user_email'] ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" value="<?= $ubahRow['user_username'] ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control text-small">
                                        <?php
                                        $role = mysqli_query($conn, "SELECT * FROM tb_role");
                                        foreach ($role as $r_row) :
                                        ?>
                                            <option value="<?= $r_row['role_id'] ?>" <?= $r_row['role_id'] == $ubahRow['role_id'] ? 'selected' : '' ?>><?= $r_row['role_nama'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control text-small"><?= $ubahRow['user_alamat'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                                <div class="from-group">
                                    <label>Gambar Lama</label><br>
                                    <img src="frontend/images/profile/<?= $ubahRow['user_foto'] ?>" class="img-thumbnail" width="100" alt="">
                                    <input type="hidden" name="gambar_lama" value="<?= $ubahRow['user_foto'] ?>">
                                    <br>
                                    <br>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary text-small">Simpan Perubahan <i class="fas fa-save"></i></button>
                            </div>
                        </div>
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