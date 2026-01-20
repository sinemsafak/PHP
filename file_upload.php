<?php
/***************************************************************
 * PHP Dosya Yükleme (File Upload) ve Hosting Kullanımı Demo
 * WampServer + PHP için tek sayfa örneği
 ***************************************************************/

/* ------------------------------------------------------------
   1) Dosya Yükleme - HTML formu
   ------------------------------------------------------------ */

/* 
 Buradaki form, kullanıcıdan bir dosya alır ve POST ile
 kendisine göndermek üzere ayarlanmıştır.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen dosyayı kontrol et
    $dosya = $_FILES['dosya'];

    // Dosya adı, tipi, boyutu
    $dosyaAdi = $dosya['name'];
    $dosyaTipi = $dosya['type'];
    $dosyaBoyutu = $dosya['size'];
    $dosyaHata = $dosya['error'];

    // Dosya yükleme hatalarını kontrol et
    if ($dosyaHata !== UPLOAD_ERR_OK) {
        echo "<p class='error'>Dosya yükleme hatası! Hata Kodu: $dosyaHata</p>";
    } else {
        // Dosya türü kontrolü (örneğin sadece .jpg ve .png kabul edilsin)
        $gecerliTipler = ['image/jpeg', 'image/png'];
        if (!in_array($dosyaTipi, $gecerliTipler)) {
            echo "<p class='error'>Geçersiz dosya türü! Sadece JPG ve PNG dosyaları kabul edilir.</p>";
        } elseif ($dosyaBoyutu > 5 * 1024 * 1024) { // 5MB'yi geçmemeli
            echo "<p class='error'>Dosya boyutu çok büyük! Maksimum 5MB olabilir.</p>";
        } else {
            // Dosyayı sunucuya yükle
            $hedefKlasor = 'uploads/'; // Dosyaların kaydedileceği klasör
            $hedefYol = $hedefKlasor . basename($dosyaAdi); // Yüklenen dosyanın hedef yolu

            // Dosyayı hedef klasöre taşı
            if (move_uploaded_file($dosya['tmp_name'], $hedefYol)) {
                echo "<p class='success'>Dosya başarıyla yüklendi: <strong>$dosyaAdi</strong></p>";
            } else {
                echo "<p class='error'>Dosya yüklenirken bir hata oluştu.</p>";
            }
        }
    }
}

/* ------------------------------------------------------------
   2) HTML Formu
   Bu form, kullanıcının dosya seçmesini sağlar.
------------------------------------------------------------ */
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosya Yükleme Demo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 30px; }
        .container { width: 500px; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
        label { display: block; margin-bottom: 8px; }
        input[type="file"] { display: block; margin-bottom: 20px; }
        button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>

<div class="container">
    <h2>Dosya Yükle</h2>
    <p>Lütfen yüklemek istediğiniz dosyayı seçin ve "Gönder" butonuna tıklayın.</p>

    <!-- Dosya yükleme formu -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="dosya">Dosya Seç:</label>
        <input type="file" name="dosya" id="dosya" required>
        <button type="submit">Gönder</button>
    </form>
</div>

</body>
</html>

<?php
/* ------------------------------------------------------------
   3) Hosting ve Sunucu Bilgisi (Varsayılan Ayarları)
   ------------------------------------------------------------ */

/* Hosting/Server bilgileri */
echo "<hr><h3>Sunucu Bilgileri:</h3>";
echo "<p><strong>Sunucu Adı:</strong> " . $_SERVER['SERVER_NAME'] . "</p>";  // Sunucu adı
echo "<p><strong>Sunucu IP Adresi:</strong> " . $_SERVER['SERVER_ADDR'] . "</p>"; // Sunucu IP
echo "<p><strong>Sunucu Yazılımı:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>"; // Sunucu yazılımı
echo "<p><strong>Web Kök Dizin:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";  // Web Kök Dizin

/* ------------------------------------------------------------
   4) Hosting Kullanım (Dosya Yolu)
   ------------------------------------------------------------ */

/* Upload için kullanılan dosya yolu */
echo "<hr><h3>Yükleme Klasörü: </h3>";
echo "<p><strong>Dosyalar Buraya Yükleniyor:</strong> uploads/</p>"; // Yükleme yapılan klasör
?>
