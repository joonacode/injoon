<?php
session_start();
require 'backend/config.php';
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
    <link rel="stylesheet" href="frontend/libraries/DataTables/datatables.min.css">
    <link rel="stylesheet" href="frontend/styles/main.css">

    <title>InJoon</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-cus">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="frontend/images/logo.png" alt="">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-4 mr-3">
                    <li class="nav-item mx-md-2">
                        <a href="index.html" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Entri Referensi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="masakan.html">Master Masakan</a>
                            <a class="dropdown-item" href="user.html">Master User</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>


                    <li class="nav-item mx-md-2">
                        <a href="#kelebihan-game" class="nav-link">Entri Order</a>
                    </li>

                    <li class="nav-item mx-md-2">
                        <a href="#preview-game" class="nav-link">Entri Transaksi</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#preview-game" class="nav-link">Laporan</a>
                    </li>
                </ul>
                <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')" class="btn btn-dark px-3 py-2 bg-cus-dark ml-auto text-small border-0">Logout <i class="fas fa-sign-out-alt"></i></a>

            </div>

        </div>
    </nav>