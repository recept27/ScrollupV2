<?php
include 'baglan.php';
ob_start();
session_start();

$kullanicisor = $db->prepare("SELECT * FROM users WHERE kullanici_mail = :mail");
$kullanicisor->execute(array(
    'mail' => $_SESSION['kullanici_mail']
));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($say == 0) {
    header("Location: login.php?durum=login");
    exit;
}
?>


<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $settingsData['site_name']; ?> - Yönetim Paneli</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="../dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <!-- Bootstrap Docs -->
    <link rel="stylesheet" href="../dist/css/bootstrap-docs.css" type="text/css">

    <!-- Slick -->
    <link rel="stylesheet" href="../libs/slick/slick.css" type="text/css">

    <!-- Main style file -->
    <link rel="stylesheet" href="../dist/css/app.min.css" type="text/css">
</head>

<body>

    <!-- preloader -->
    <div class="preloader">
        <img src="../assets/images/logo.png" alt="logo">
        <div class="preloader-icon"></div>
    </div>
    <!-- ./ preloader -->

    <!-- sidebars -->



    <!-- ./ sidebars -->

    <?php include 'menu.php'; ?>

    <!-- layout-wrapper -->
    <div class="layout-wrapper">

        <!-- header -->
        <div class="header">
            <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
                <a href="#">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <!-- Logo -->
            <a href="index.php" class="logo">
                <img width="100" src="../assets/images/logo.png" alt="logo">
            </a>
            <!-- ./ Logo -->
            <div class="page-title">Scrollup Paneli</div>


            <div class="header-bar ms-auto">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                      
                    </li>

                    <li class="nav-item ms-3">
                        <a href="scrollup-ekle.php">
                            <button class="btn btn-primary btn-icon">
                                <i class="bi bi-plus-circle"></i> Scrollup Ekle
                            </button>
                        </a>
                    </li>
                </ul>
            </div>


            <!-- Header mobile buttons -->
            <div class="header-mobile-buttons">
                <a href="#" class="search-bar-btn">
                    <i class="bi bi-search"></i>
                </a>
                <a href="#" class="actions-btn">
                    <i class="bi bi-three-dots"></i>
                </a>
            </div>
            <!-- ./ Header mobile buttons -->
        </div>
        <!-- ./ header -->
