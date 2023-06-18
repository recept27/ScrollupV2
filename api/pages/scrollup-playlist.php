<?php
include 'baglan.php';

ob_start();
session_start();

$kullanicisor = $db->prepare("SELECT * FROM users WHERE kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['kullanici_mail']
));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($say == 0) {
  header("Location: login.php?durum=izinsiz");
  exit;
}

$scrollup_id = $_GET['scrollup_id'];
$scrollupsQuery = $db->prepare("SELECT * FROM content WHERE scrollups_id = :id");
$scrollupsQuery->execute(['id' => $scrollup_id]);
$scrollups = $scrollupsQuery->fetchAll(PDO::FETCH_ASSOC);

if (count($scrollups) <= 0) {
    $scrollups=[];
}
$query = $scrollups;

if (isset($_GET['arama'])) {
  $search = $_GET['arama'];
  $filteredScrollups = array_filter($scrollups, function ($scrollup) use ($search) {
    return strpos($scrollup['desc'], $search) !== false;
  });
  $query = $filteredScrollups;
}

$sayfada = 10; // sayfada gösterilecek içerik miktarını belirtiyoruz.
$sayi1 = count($query);

$toplam_sayfa = ceil($sayi1 / $sayfada);

$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if ($sayfa < 1) {
  $sayfa = 1;
} elseif ($sayfa > $toplam_sayfa) {
  $sayfa = $toplam_sayfa;
}

$limit = ($sayfa - 1) * $sayfada;
$paginatedScrollups = array_slice($query, $limit, $sayfada);

if ($sayi1 == 0) {
  echo "Bu kategoride ürün bulunamadı";
}

?>


<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $settingsData['site_name']; ?> - Scrollup Playlist </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png"/>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="../dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <!-- Bootstrap Docs -->
    <link rel="stylesheet" href="../dist/css/bootstrap-docs.css" type="text/css">

    
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
    <div class="page-title">Scrollup Playlist</div>


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
        
    <div class="mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">
                        <i class="bi bi-globe2 small me-2"></i> Anasayfa
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Scrollup Playlist</li>
            </ol>
        </nav>
    </div>



    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                
                <div class="d-md-flex gap-4 align-items-center">
                    <form action="" method="get" class="mb-3 mb-md-0">
                        <div class="row g-3">
                      
                     
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="text" name="arama" class="form-control" placeholder="Arama">
                                    <button class="btn btn-outline-light" >
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                  <div class="d-none d-md-flex"><?php if(isset($search)){echo 'Aranan Kelime: ' . ' ' . $search;} ?></div>
                <div class="dropdown ms-auto">
                    <a href="#" data-bs-toggle="dropdown"
                       class="btn btn-primary dropdown-toggle"
                       aria-haspopup="true" aria-expanded="false">İşlem</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="scrollup-playlist-ekle.php?scrollup_id=<?php echo $_GET['scrollup_id'] ?>" class="dropdown-item">Playlist Ekle</a>
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-lg mb-0" id="orders">
            <thead>
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#orders"
                           id="defaultCheck1">
                </th>
                <th>ID</th>
                <th>İçerik</th>
                <th>Döngü Sayısı</th>
              
                <th class="text-end">Döngü Süresi</th>
                <th class="text-end">Aksiyon</th>
            </tr>
            </thead>
            <tbody>
           





<?php
$sayi= 0;
foreach($query AS $c) {
     // Değişiklik burada başlıyor
                       if ($c['content_type'] == 'image' && file_exists($c['content_url'])) {
    $contentUrl = '<img width="150px" src="' . $c['content_url'] . '" alt="Image">';
} elseif ($c['content_type'] == 'video' && file_exists($c['content_url'])) {
    $contentUrl = '<video height="200px" src="' . $c['content_url'] . '" controls></video>';
} else {
    $contentUrl = 'Geçersiz içerik türü veya dosya bulunamadı';
}

                        // Değişiklik burada bitiyor

?>
      <tr>
          
          <td>
              <input class="form-check-input" type="checkbox">
          </td>

          
          <td>
              <a href="#"><?php echo $sayi++; ?></a>
          </td>
           <td><?php echo $contentUrl; ?></td>
          <td><?php echo $c['content_loop']; ?></td>
          <td><?php echo $c['content_duration']; ?></td>
   
     
        
          <td class="text-end">
              <div class="d-flex">
                  <div class="dropdown ms-auto">
                      <a href="#" data-bs-toggle="dropdown"
                         class="btn btn-floating"
                         aria-haspopup="true" aria-expanded="false">
                          <i class="bi bi-three-dots"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end">
                          <a href="scrollup-playlist-duzenle.php?playlist_id=<?php echo $c['id']; ?>" class="dropdown-item">PlayList Göster/Düzenle</a>
               
                            <a href="islem.php?playlist_id=<?php echo $c['id']; ?>&scrollup_id=<?php echo $_GET['scrollup_id']; ?>&scrollup-playlist-sil=ok" class="dropdown-item">Playlist Sil</a>
                      
                      </div>
                  </div>
              </div>
          </td>

    

      </tr>





<?php

 
 }

?>
          
            
      


     


           
       
         
        
        
            </tbody>
        </table>
    </div>

    <nav class="mt-4" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
                    <?php

$s=0;

while ($s < $toplam_sayfa) {

    $s++; ?>

    <?php 

    if ($s==$sayfa) {?>

    <li class="page-item active">

        <a class="page-link" href="?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

    </li>

    <?php } else {?>


    <li class="page-item">

        <a class="page-link" href="?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

    </li>

    <?php   }

}

?>
     
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    </div>
    <!-- ./ content -->

     <!-- content-footer -->
<footer class="content-footer">
        <div>© 2021 - <a href="" >Aceris Admin Panel</a></div>
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

    <!-- Examples -->
    <script src="../dist/js/examples/orders.js"></script>

<!-- Main Javascript file -->
<script src="../dist/js/app.min.js"></script>
</body>


</html>
