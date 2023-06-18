<?php

// API endpoint
$apiUrl = "https://panel.firstrip.com.tr/api/";

try {
    // Veritabanı bağlantısını oluşturma
    $conn = new PDO("mysql:host=localhost;dbname=firstrip_scrollup;charset=utf8", 'firstrip_admin_scrollup', 'gb-Lbe8Q,GL5');

    // Hata raporlamasını etkinleştirme
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Scrollups tablosundaki ID'yi kontrol etme
    $scrollupId = $_GET['scrollup_id'];
    $scrollupCheckQuery = "SELECT * FROM scrollups WHERE id = :scrollup_id";
    $scrollupCheckStmt = $conn->prepare($scrollupCheckQuery);
    $scrollupCheckStmt->bindParam(':scrollup_id', $scrollupId);
    $scrollupCheckStmt->execute();

    if ($scrollupCheckStmt->rowCount() > 0) {
        // Scrollup ID'ye göre content tablosundaki satırları getirme
        $contentQuery = "SELECT id, content_url AS url, CAST(content_loop AS UNSIGNED) AS `loop`, CAST(content_duration AS UNSIGNED) AS duration FROM content WHERE scrollups_id = :scrollup_id";
        $contentStmt = $conn->prepare($contentQuery);
        $contentStmt->bindParam(':scrollup_id', $scrollupId);
        $contentStmt->execute();

        // Sonuçları alma
        $results = array(); // Boş bir dizi olarak tanımlanıyor
        $results = $contentStmt->fetchAll(PDO::FETCH_ASSOC);

        // Check each content_url and prepend the base URL if needed
        $baseUrl = "https://panel.firstrip.com.tr/";
        foreach ($results as $key => $row) {
            if (strpos($row['url'], "../") === 0) { // if the url starts with "../"
                $results[$key]['url'] = str_replace("../", $baseUrl, $row['url']);
            }
            
            // Output content_loop and content_duration as integers
            $results[$key]['loop'] = (int) $row['loop'];
            $results[$key]['duration'] = (int) $row['duration'];
        }

        // HTTP başlıklarını ayarlama
        header('Content-Type: application/json');

        // JSON yanıtını gönderme
        echo json_encode($results);

    } else {
        echo "Scrollup ID bulunamadı.";
    }
} catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

// Veritabanı bağlantısını kapatma
$conn = null;

?>
