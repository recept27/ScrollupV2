<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=firstrip_scrollup;charset=utf8", 'firstrip_admin_scrollup', 'gb-Lbe8Q,GL5');
} catch (PDOException $e) {
    echo $e->getMessage();
}

$settingsQuery = $db->query("SELECT * FROM settings WHERE id = 1");
$settingsData = $settingsQuery->fetch(PDO::FETCH_ASSOC) ?: [];



?>
