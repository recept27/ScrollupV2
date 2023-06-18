<?php
include 'baglan.php';
ob_start();
session_start();

$kullanici_mail = $_SESSION['kullanici_mail'] ?? null;

if (!$kullanici_mail) {
    header("Location: login.php?durum=izinsiz");
    exit;
}

$kullanicisor = $db->prepare("SELECT * FROM users WHERE kullanici_mail = :mail");
$kullanicisor->execute(['mail' => $kullanici_mail]);
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$site_name = $settingsData['site_name'] ?? '';

?>

<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $site_name ?> Scrollup Ekle</title>

    <link rel="shortcut icon" href="../assets/images/favicon.png"/>

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <link rel="stylesheet" href="../dist/css/bootstrap-docs.css" type="text/css">
    <link rel="stylesheet" href="../libs/prism/prism.css" type="text/css">
    <link rel="stylesheet" href="../dist/css/app.min.css" type="text/css">
</head>

<body>
<div class="preloader">
    <img src="../assets/images/logo.png" alt="logo">
    <div class="preloader-icon"></div>
</div>

<?php include 'menu.php'; ?>

<div class="layout-wrapper">
    <div class="header">
        <div class="menu-toggle-btn">
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <a href="index.html" class="logo">
            <img width="100" src="../assets/images/logo.png" alt="logo">
        </a>
        <div class="page-title">Scrollup Ekle</div>
        <form class="search-form">
            <div class="input-group">
                
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                  
                </li>
            </ul>
        </div>
        <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="order-2 order-lg-1 col-lg-12 bd-content">
                <h4>Genel</h4>
                <p class="lead">Scrollup Eklerken dikkatli giriniz. Cihaz ID'niz cihazın arkasında QR kodun alt tarafında yer alamaktadır.</p>
                <div class="card">
                    <div class="card-body">
                        <form action="islem.php" method="POST">
                            <div class="mb-3">
                                <label for="bildirim-title" class="form-label">Scrollup Aygıt İd *</label>
                                <input type="text" class="form-control" required="" name="scrollup-device-id" placeholder="Cihaz'ın Arkasında Yer alan İD numarasını Giriniz" id="scrollup-id"
                                       aria-describedby="emailHelp">
                            </div>
                            <button type="submit" name="scrollup-ekle" class="btn btn-primary">Aygıt Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="order-1 order-lg-2 col-lg-3">
            </div>
        </div>
    </div>

    <footer class="content-footer">
        <div>© 2023 - <a href="">İNFİNİA TECH</a></div>
        <div>
            <nav class="nav gap-4">
                <a href="" class="nav-link">Licenses</a>
                <a href="#" class="nav-link">Change Log</a>
                <a href="#" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>
</div>

<script src="../libs/bundle.js"></script>
<script src="../libs/prism/prism.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../libs/ckeditor5/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'));
</script>
</body>

</html>
