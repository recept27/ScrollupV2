<?php 

include "function.php";






include 'baglan.php';
ob_start();
session_start();

      if (isset($_POST['admingiris'])) {

                            $kullanici_mail=$_POST['kullanici_mail'];
                            $kullanici_password=md5($_POST['kullanici_password']);
                        
                            $kullanicisor=$db->prepare("SELECT * FROM users where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
                            $kullanicisor->execute(array(
                                'mail' => $kullanici_mail,
                                'password' => $kullanici_password,
                                'yetki' => 5
                                ));
                        
                            echo $say=$kullanicisor->rowCount();
                        
                            if ($say==1) {
                        
                                $_SESSION['kullanici_mail']=$kullanici_mail;
                                header("Location:index.php");
                                exit;
                        
                        
                        
                            } else {
                        
                                header("Location:login.php?durum=no");
                                exit;
                            }
                            
                        
                        }



//bildirim ekkle
                       
            include 'baglan.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scrollup-ekle']) ) {
    $device_id = $_POST['scrollup-device-id'];
    
    // Kullanıcının oturum açtığı mail adresini al
    $kullanici_mail = $_SESSION['kullanici_mail'];
    
    // Kullanıcının mail adresine göre kullanıcıyı bul
    $kullanicisor = $db->prepare("SELECT * FROM users WHERE kullanici_mail = :mail");
    $kullanicisor->execute(['mail' => $kullanici_mail]);
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
    
    if ($kullanicicek) {
        $user_id = $kullanicicek['id'];
        
        // Veritabanında kullanıcıya ait "device_id"yi güncelle
        $updateQuery = $db->prepare("UPDATE scrollups SET user_id = :user_id WHERE device_id = :device_id");
        $updateQuery->execute(['user_id' => $user_id, 'device_id' => $device_id]);
        
        if ($updateQuery) {
            // İşlem başarılıysa islem.php sayfasına yönlendir
            header("Location: scrolluplarim.php");
            exit;
        }
    }
    
    // İşlem başarısız ise hata mesajını scrollup-ekle.php sayfasına iletebilirsin
    header("Location: scrollup-ekle.php?hata=1");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scrollup-playlist-ekle'])) {
    $foto = $_FILES['foto'];
    $scrollup_id = $_POST['scrollup_id'];
    $playlistAdi = $_POST['playlistAdi'];
    $playlistDongusu = $_POST['playlistDongusu'];
    $playlistSuresi = $_POST['playlistSuresi'];

    // Generate a unique file name
    $originalFileName = $foto['name'];
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '.' . $extension;

    // Specify the upload directory and move the file
    $uploadDirectory = "../uploads/";
    $fotoYolu = $uploadDirectory . $uniqueFileName;
    move_uploaded_file($foto["tmp_name"], $fotoYolu);

    // Determine the content type based on the file extension
    $contentType = '';
    if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
        $contentType = 'image';
    } elseif (in_array(strtolower($extension), ['mp4', 'mov', 'avi'])) {
        $contentType = 'video';
    } else {
        // Redirect to scrollup-playlist-ekle.php with error code for unsupported file types
        header("Location: scrollup-playlist-ekle.php?error=2");
        exit;
    }

    // Insert the new record into the database
    $stmt = $db->prepare("INSERT INTO content (content_url, content_title, content_loop, content_duration, content_type, scrollups_id) VALUES (:foto, :playlistAdi, :playlistDongusu, :playlistSuresi, :contentType, :scrollup_id)");
    $stmt->bindParam(':foto', $fotoYolu);
    $stmt->bindParam(':playlistAdi', $playlistAdi);
    $stmt->bindParam(':playlistDongusu', $playlistDongusu);
    $stmt->bindParam(':playlistSuresi', $playlistSuresi);
    $stmt->bindParam(':contentType', $contentType);
    $stmt->bindParam(':scrollup_id', $scrollup_id);
    $stmt->execute();

    if ($stmt) {
        // Redirect with scrollup_id if successful
        header("Location: scrollup-playlist.php?scrollup_id=$scrollup_id");
        exit;
    } else {
        // Redirect to scrollup-playlist-ekle.php with error code
        header("Location: scrollup-playlist-ekle.php?error=1");
        exit;
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scrollup-playlist-duzenle'])) {
    $foto = $_FILES['foto'];
    $playlist_id = $_POST['playlist_id'];
    $playlistAdi = $_POST['playlistAdi'];
    $playlistDongusu = $_POST['playlistDongusu'];
    $playlistSuresi = $_POST['playlistSuresi'];

    if ($foto['error'] === UPLOAD_ERR_OK) {
        // File is uploaded, handle the file
        $originalFileName = $foto['name'];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $extension;
        $uploadDirectory = "../uploads/";
        $fotoYolu = $uploadDirectory . $uniqueFileName;

        if (move_uploaded_file($foto["tmp_name"], $fotoYolu)) {
            // File is uploaded successfully, update all information
            $contentType = '';
            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                $contentType = 'image';
            } elseif (in_array(strtolower($extension), ['mp4', 'mov', 'avi'])) {
                $contentType = 'video';
            } else {
                // Redirect to scrollup-playlist-duzenle.php with error code for unsupported file types
                header("Location: scrollup-playlist-duzenle.php?playlist=$playlist_id&error=2");
                exit;
            }

            // Update the record in the database with the file and other information
            $stmt = $db->prepare("UPDATE content SET content_url = :foto, content_title = :playlistAdi, content_loop = :playlistDongusu, content_duration = :playlistSuresi, content_type = :contentType WHERE id = :playlist_id");
            $stmt->bindParam(':foto', $fotoYolu);
            $stmt->bindParam(':playlistAdi', $playlistAdi);
            $stmt->bindParam(':playlistDongusu', $playlistDongusu);
            $stmt->bindParam(':playlistSuresi', $playlistSuresi);
            $stmt->bindParam(':contentType', $contentType);
            $stmt->bindParam(':playlist_id', $playlist_id);
            $stmt->execute();

            if ($stmt) {
                // Redirect with scrollup_id if successful
                header("Location: scrollup-playlist-duzenle.php?playlist_id=$playlist_id");
                exit;
            } else {
                // Redirect to scrollup-playlist-duzenle.php with error code
                header("Location: scrollup-playlist-duzenle.php?playlist_id=$playlist_id&error=1");
                exit;
            }
        } else {
            // Error occurred while moving the uploaded file
            header("Location: scrollup-playlist-duzenle.php?playlist_id=$playlist_id&error=3");
            exit;
        }
    } else {
        // No file uploaded, update only the other information
        $stmt = $db->prepare("UPDATE content SET content_title = :playlistAdi, content_loop = :playlistDongusu, content_duration = :playlistSuresi WHERE id = :playlist_id");
        $stmt->bindParam(':playlistAdi', $playlistAdi);
        $stmt->bindParam(':playlistDongusu', $playlistDongusu);
        $stmt->bindParam(':playlistSuresi', $playlistSuresi);
        $stmt->bindParam(':playlist_id', $playlist_id);
        $stmt->execute();

        if ($stmt) {
            // Redirect with scrollup_id if successful
            header("Location: scrollup-playlist-duzenle.php?playlist_id=$playlist_id");
            exit;
        } else {
            // Redirect to scrollup-playlist-duzenle.php with error code
            header("Location: scrollup-playlist-duzenle.php?playlist_id=$playlist_id&error=1");
            exit;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['scrollup-playlist-sil'])) {
    $playlist_id = $_GET['playlist_id'];
    $scrollup_id = $_GET['scrollup_id'];

    // Get the file path from the database
    $stmt = $db->prepare("SELECT content_url FROM content WHERE id = :playlist_id");
    $stmt->bindParam(':playlist_id', $playlist_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $filePath = $row['content_url'];

        // Delete the record from the database
        $stmt = $db->prepare("DELETE FROM content WHERE id = :playlist_id");
        $stmt->bindParam(':playlist_id', $playlist_id);
        $stmt->execute();

        if ($stmt) {
            // Delete the file from the server
            if (unlink($filePath)) {
                // Redirect to scrollup-playlist.php after successful deletion
                header("Location: scrollup-playlist.php?scrollup_id=$scrollup_id");
                exit;
            } else {
                // Redirect to scrollup-playlist-duzenle.php with error code for file deletion
                header("Location: scrollup-playlist.php?scrollup_id=$scrollup_id&error=2");
                exit;
            }
        } else {
            // Redirect to scrollup-playlist-duzenle.php with error code for database deletion
            header("Location: scrollup-playlist.php?scrollup_id=$scrollup_id&error=1");
            exit;
        }
    } else {
        // Redirect to scrollup-playlist-duzenle.php with error code for invalid playlist ID
        header("Location: scrollup-playlist.php?scrollup_id=$scrollup_id&error=3");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scrollup-duzenle'])) {
    $scrollup_id = $_GET['scrollup_id'];
    $device_id = $_POST['scrollup-device-id'];
    $wifi_ssid = $_POST['scrollup-wifi-ssid'];
    $wifi_password = $_POST['scrollup-wifi-password'];
    $bluetooth_ssid = $_POST['scrollup-bluetooth-ssid'];
    $bluetooth_status = isset($_POST['bluetooth-durumu']) ? '1' : '0';
    $wifi_status = isset($_POST['wifi-durumu']) ? '1' : '0';

    // Veritabanında kullanıcıya ait "device_id"yi güncelle
    $updateQuery = $db->prepare("UPDATE scrollups SET device_id = :device_id, device_wifi_name = :wifi_ssid, device_wifi_password = :wifi_password, device_bluetooth_name = :bluetooth_ssid, bluetooth_status = :bluetooth_status, wifi_status = :wifi_status WHERE id = :scrollup_id");
    $updateQuery->execute(['device_id' => $device_id, 'wifi_ssid' => $wifi_ssid, 'wifi_password' => $wifi_password, 'bluetooth_ssid' => $bluetooth_ssid, 'bluetooth_status' => $bluetooth_status, 'wifi_status' => $wifi_status, 'scrollup_id' => $scrollup_id]);

    if ($updateQuery) {
        // İşlem başarılıysa scrolluplarim.php sayfasına yönlendir
        header("Location: scrollup-duzenle.php?scrollup_id=".$scrollup_id);
        exit;
    } else {
        // İşlem başarısız ise hata mesajını scrollup-duzenle.php sayfasına iletebilirsin
        header("Location: scrollup-duzenle.php?scrollup_id=".$scrollup_id."&hata=1");
        exit;
    }
}


?>