<!doctype html>
<html lang="tr">
<?php include 'baglan.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $settingsData['site_name']; ?> Giriş Sayfası</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png"/>

    <!-- Themify icons -->
    <link rel="stylesheet" href="../dist/icons/themify-icons/themify-icons.css" type="text/css">

    <!-- Main style file -->
    <link rel="stylesheet" href="../dist/css/app.min.css" type="text/css">
</head>

<body class="auth">
    <!-- preloader -->
    <div class="preloader">
        <img src="../assets/images/logo.png" alt="logo">
        <div class="preloader-icon"></div>
    </div>
    <!-- ./ preloader -->

    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="../assets/images/logo.png" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">Giriş Yap</h1>
                                    <p class="text-muted">Devam etmek için <?= $settingsData['site_name']; ?> oturum açın</p>
                                </div>
                                <form action="islem.php" method="POST" class="mb-5">
                                    <div class="mb-3">
                                        <input type="email" name="kullanici_mail" class="form-control" placeholder="E-posta giriniz..." autofocus required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="kullanici_password" class="form-control" placeholder="Şifre Giriniz..." required>
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <p class="small">Hesabınıza erişemiyor musunuz?<a href="#">Şifrenizi şimdi sıfırlayın</a>.</p>
                                        <button class="btn btn-primary" name="admingiris">Giriş Yap</button>
                                    </div>
                                </form>
                                <p class="text-center d-block d-lg-none mt-5 mt-lg-0">Problem varsa adminle iletişime geçiniz.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo">
                            <img width="120" src="../assets/images/logo.png" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold"><?= $settingsData['site_name']; ?> Hoşgeldiniz</h3>
                            <p class="lead my-5">Bir hesabınız yoksa, Adminle İletişime Geçiniz</p>
                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">Gizlilik Politikası</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Şartlar ve Koşullar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bundle scripts -->
    <script src="../libs/bundle.js"></script>

    <!-- Main Javascript file -->
    <script src="../dist/js/app.min.js"></script>
</body>

</html>
