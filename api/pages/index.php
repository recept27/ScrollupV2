<?php include 'header.php'; ?>

<!-- content -->
<h2>Anasayfa</h2>
<h3>Burada son eklenenler cihazlarınız listleniyor</h3>
<div class="content">
    <meta name="robots" content="noindex, follow">

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
$scrollupsQuery = $db->prepare("SELECT id, device_id FROM scrollups ORDER BY id DESC LIMIT 10");
$scrollupsQuery->execute();

if ($scrollupsQuery->rowCount() > 0) {
    while ($scrollupsData = $scrollupsQuery->fetch(PDO::FETCH_ASSOC)) {
        $scrollupId = $scrollupsData['id'];
        $deviceId = $scrollupsData['device_id'];

        $contentQuery = $db->prepare("SELECT * FROM content WHERE scrollups_id = :scrollupId ORDER BY id DESC LIMIT 1");
        $contentQuery->bindParam(':scrollupId', $scrollupId);
        $contentQuery->execute();

        if ($contentQuery->rowCount() > 0) {
            $contentData = $contentQuery->fetch(PDO::FETCH_ASSOC);
            $contentUrl = $contentData['content_url'];
            $contentType = $contentData['content_type'];
            
            if ($contentType == 'video') {
                $content = '<video controls height="300">
                                <source src="' . $contentUrl . '" type="video/mp4">
                            </video>';
            } else if ($contentType == 'resim') {
                $content = '<img src="' . $contentUrl . '" height="200">';
            } else {
                $content = ''; // İçerik türü belirsizse boş değer atama
            }

            echo '<div style="margin:2px;" class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="display-7">
                                <h4 class="mb-3">Scrollup-' . $deviceId . '</h4>
                            </div>
                            <div class="dropdown ms-auto">
                                <!-- Dropdown içeriği -->
                            </div>
                        </div>
                        <div class="d-flex mb-3" style="position: relative;">
                            ' . $content . ' <!-- İçerik gösterimi -->
                        </div>
                    </div>
                </div>';
        } else {
            echo '<div class="col-lg-4 col-md-12">
                    <div style="margin:2px;" class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="display-7">
                                    <h4 class="mb-3">Scrollup-' . $deviceId . '</h4>
                                </div>
                                <div class="dropdown ms-auto">
                                    <!-- Dropdown içeriği -->
                                </div>
                            </div>
                            <div class="d-flex mb-3" style="position: relative;">
                                <img src="assets/logo_content.png" height="150">
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
} else {
    echo "No data found in the scrollups table.";
}
?>

    </div>

    <br>

    <!-- ./ content -->

    <?php include 'footer.php'; ?>
