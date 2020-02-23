<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="frontend/images/favicon.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="frontend/libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/libraries/aos/aos.css">
    <link rel="stylesheet" href="frontend/libraries/owlcarousel/assets/owl.theme.default.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="frontend/styles/main.css">

    <title>InJoon</title>
</head>

<body class="bg-cus-dark">
    <section class="login-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-5 mx-auto">
                    <div class="card">
                        <div class="text-center mt-4 mb-1">
                            <h5> Login <i class="fas fa-lock"></i></h5>
                        </div>
                        <?php if (isset($_SESSION['pesan'])) : ?>
                            <?= $_SESSION['pesan'] ?>
                        <?php
                            unset($_SESSION['pesan']);
                        endif;
                        ?>
                        <form action="backend/login/cek_login.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Username / Email</label>
                                    <input type="text" name="ue" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary text-white btn-block">Login <i class="fas fa-sign-in-alt"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
    <script src="frontend/libraries/aos/aos.js"></script>
    <script src="frontend/libraries/owlcarousel/owl.carousel.min.js"></script>
    <!-- <script>
        AOS.init();
    </script> -->
</body>

</html>