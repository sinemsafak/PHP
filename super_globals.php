<?php
/***********************
 * 1. $GLOBALS ÖRNEĞİ
 ***********************/

/*
 $GLOBALS, PHP'deki tüm global değişkenleri
 özel bir dizi (array) içinde tutar.
 Fonksiyon içinden bile global değişkenlere erişmemizi sağlar.
*/

// Global (genel) değişken tanımlıyoruz
$siteAdi = "WampServer PHP Dersi";

// Global değişkeni değiştirecek fonksiyon
function siteAdiniDegistir()
{
    /*
     Normalde fonksiyon içinden $siteAdi değişkenine
     direkt erişemeyiz. Çünkü fonksiyon scope (kapsamı) ayrıdır.
     Bu yüzden $GLOBALS kullanıyoruz.
    */

    // $GLOBALS dizisi içinden "siteAdi" anahtarına erişiyoruz
    $GLOBALS["siteAdi"] = "PHP Süper Küreseller Dersi";
}

// Fonksiyonu çağırıyoruz
siteAdiniDegistir();



/***********************
 * 2. $_SERVER ÖRNEĞİ
 ***********************/

/*
 $_SERVER, sunucu ve istek (request) bilgilerini tutan
 bir süper küresel dizidir.
 Tarayıcı, sunucu, dosya yolu gibi bilgileri içerir.
*/

// Sayfanın çalıştığı dosya adını alır
$dosyaAdi = $_SERVER["PHP_SELF"];

// Sunucunun adını alır (localhost gibi)
$sunucuAdi = $_SERVER["SERVER_NAME"];

// İsteğin yapıldığı yöntemi alır (GET veya POST)
$istekYontemi = $_SERVER["REQUEST_METHOD"];

// Tarayıcı bilgisini alır
$tarayiciBilgisi = $_SERVER["HTTP_USER_AGENT"];

// Dosyanın sunucudaki tam yolunu alır
$dosyaYolu = $_SERVER["SCRIPT_FILENAME"];

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP $GLOBALS ve $_SERVER Örneği</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; padding: 20px; }
        .kutu { background: #fff; padding: 15px; margin-bottom: 20px; border-radius: 6px; }
        h2 { color: #2c3e50; }
        p { font-size: 16px; }
        code { background: #eee; padding: 3px 6px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1. $GLOBALS Örneği</h2>

    <?php
    /*
     $siteAdi değişkeni fonksiyon içinde
     $GLOBALS ile değiştirildi.
    */
    ?>

    <p><strong>Güncel Site Adı:</strong> <?php echo $siteAdi; ?></p>

    <p>
        Bu değer, fonksiyon içinden şu kod ile değiştirildi:
        <code>$GLOBALS["siteAdi"]</code>
    </p>
</div>

<div class="kutu">
    <h2>2. $_SERVER Örneği</h2>

    <p><strong>Çalışan Dosya:</strong> <?php echo $dosyaAdi; ?></p>
    <p><strong>Sunucu Adı:</strong> <?php echo $sunucuAdi; ?></p>
    <p><strong>İstek Yöntemi:</strong> <?php echo $istekYontemi; ?></p>
    <p><strong>Tarayıcı Bilgisi:</strong> <?php echo $tarayiciBilgisi; ?></p>
    <p><strong>Dosyanın Sunucudaki Yolu:</strong> <?php echo $dosyaYolu; ?></p>

    <?php
    /*
     Yukarıdaki tüm bilgiler $_SERVER süper küresel dizisinden geldi.
     Örnek:
     $_SERVER["SERVER_NAME"]
     $_SERVER["PHP_SELF"]
    */
    ?>
</div>

</body>
</html>
