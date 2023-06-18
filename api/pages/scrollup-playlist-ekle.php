<?php
include 'baglan.php';
session_start();

$kullanicisor = $db->prepare("SELECT * FROM users WHERE kullanici_mail = :mail");
$kullanicisor->execute(['mail' => $_SESSION['kullanici_mail']]);
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if (!$kullanicicek) {
    header("Location: login.php?durum=izinsiz");
    exit;
}
?>

<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $settingsData['site_name']; ?> Playlist Ekle</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png"/>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="../dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <!-- Bootstrap Docs -->
    <link rel="stylesheet" href="../dist/css/bootstrap-docs.css" type="text/css">

    <!-- Prism -->
    <link rel="stylesheet" href="../libs/prism/prism.css" type="text/css">

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
        <a href="index.html" class="logo">
            <img width="100" src="../assets/images/logo.png" alt="logo">
        </a>
        <!-- ./ Logo -->
        <div class="page-title">Playlist Ekle</div>
        <form class="search-form">
            <div class="input-group">
                <button class="btn btn-outline-light" type="button" id="button-addon1">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" class="form-control" placeholder="Search..."
                       aria-label="Example text with button addon" aria-describedby="button-addon1">
                <a href="#" class="btn btn-outline-light close-header-search-bar">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="">
                        <i class="bi bi-bell icon-lg"></i>
                    </a>
                </li>
                <li class="nav-item ms-3">
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

    <!-- content -->
    <div class="content ">
        <div class="row">
            <div class="order-2 order-lg-1 col-lg-12 bd-content">

                <h4>Genel</h4>
                <p class="lead">Playlist eklerken dikkatli giriniz</p>

                <div class="card">
                    <div class="card-body">
                        <form action="islem.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="playlistAdi" class="form-label">Playlist Adı *</label>
                                <input type="text" class="form-control" required="" name="playlistAdi" id="playlistAdi"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="playlistDongusu" class="form-label">İçerik Döngü Sayısı*</label>
                                <input type="number" class="form-control" required="" name="playlistDongusu" id="playlistDongusu"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="playlistSuresi" class="form-label">İçerik Döngü Süresi (Dakkia Olarak)*</label>
                                <input type="number" class="form-control" required="" name="playlistSuresi" id="playlistSuresi"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Görsel İçerik Yükle (Video/Resim Dosyası Geçerlidir) *</label>
                                <input type="file" class="form-control" required="" name="foto" id="foto"
                                       aria-describedby="emailHelp">
                            </div>
                            <input type="hidden" name="scrollup_id" value="<?php echo $_GET['scrollup_id']; ?>" >
                            <button type="submit" name="scrollup-playlist-ekle" class="btn btn-primary ">Playlist Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="order-1 order-lg-2 col-lg-3"></div>
        </div>
    </div>
    <!-- ./ content -->

    <!-- content-footer -->
    <footer class="content-footer">
        <div>© 2023  - <a href="">İNFİNİA TECH</a></div>
        <div>
            <nav class="nav gap-4">
                <a href="" class="nav-link">Licenses</a>
                <a href="#" class="nav-link">Change Log</a>
                <a href="#" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>
    <!-- ./ content-footer -->

</div>
<!-- ./ layout-wrapper -->

<!-- Bundle scripts -->
<script src="../libs/bundle.js"></script>

<!-- Prism -->
<script src="../libs/prism/prism.js"></script>

<!-- Main Javascript file -->
<script src="../dist/js/app.min.js"></script>

<script src="../libs/ckeditor5/ckeditor.js"></script>
<script>
   ClassicEditor.create(document.querySelector('#editor'));
</script>

</body>

</html>
