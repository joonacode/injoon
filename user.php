<?php

include 'templates/header.php'; 
$user = mysqli_query($conn, "SELECT * FROM tb_user ORDER BY user_id DESC");


?>

    <!-- Header -->
    <section class="header-page">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.html" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Master User</li>
                </ol>
            </nav>
            <h1>Master User</h1>
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
                                                    <th>No</th>
                                                    <th>Nama</th>
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
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $urRow['user_nama'] ?></td>
                                                        <td><?= $urRow['user_telp'] ?></td>
                                                        <td><?= $urRow['user_email'] ?></td>
                                                        <td><?= $urRow['user_username'] ?></td>
                                                        <td><?= $role['role_nama'] ?></td>
                                                        <td>
                                                            <a href="backend/user/hapus_user.php?id=<?= $urRow['user_id'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
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
                    <form action="backend/user/tambah_user.php" method="POST">
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
                                        <option value="2">Admin</option>
                                        <option value="3">Waiter</option>
                                        <option value="4">Kasir</option>
                                        <option value="5">Member</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control text-small"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Verifikasi Password</label>
                                    <input type="password" name="v_password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary text-small">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



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