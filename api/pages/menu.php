<!-- menu -->
<div class="menu">
    <div class="menu-header">
        <a href="index.php" class="menu-header-logo">
            <img src="../assets/images/logo.png" alt="logo">
        </a>
        <a href="index.html" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>
    <div class="menu-body">
        <!-- profile -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                <div class="avatar me-3">
                    <img src="../assets/images/user/man_avatar3.jpg" class="rounded-circle" alt="image">
                </div>
                <div>
                    <div class="fw-bold">Firma Yetkilisi</div>
                    <small class="text-muted">Admin</small>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="logout.php" class="dropdown-item d-flex align-items-center text-danger">
                    <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Çıkış Yap
                </a>
            </div>
        </div>
        <!-- profile -->
        <ul>
            <li class="menu-divider">Gösterge Paneli Menü</li>
            <li>
                <a class="active" href="index.php">
                    <span class="nav-link-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span>Anasayfa</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-collection"></i>
                    </span>
                    <span>Scrolluplarım</span>
                </a>
                <ul>
                    <li>
                        <a href="scrolluplarim.php">Scrolluplarım</a>
                    </li>
                    <li>
                        <a href="scrollup-ekle.php">Scrollup Ekle</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </span>
                    <span>Genel Ayarlar</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- ./menu -->
