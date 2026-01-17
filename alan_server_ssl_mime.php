<?php
/**************************************************************
 * TEK SAYFA PHP ÖRNEĞİ:
 * Domain - Server - Hosting - FTP - MIME Type - SSL (HTTPS)
 * WampServer / VS Code ile çalışır
 **************************************************************/

/* ------------------------------------------------------------
   DOMAIN / HOSTING / SERVER bilgileri genelde $_SERVER içinden gelir
   ------------------------------------------------------------ */

/* Host (domain) bilgisini verir: localhost, example.com gibi */
$domain = $_SERVER['HTTP_HOST'] ?? 'Bilinmiyor';

/* Sunucu adı: çoğu zaman domain ile aynı olur */
$serverName = $_SERVER['SERVER_NAME'] ?? 'Bilinmiyor';

/* Sunucu IP adresi (localhost ise genelde 127.0.0.1 veya ::1 olabilir) */
$serverIp = $_SERVER['SERVER_ADDR'] ?? 'Bilinmiyor';

/* Sunucu yazılımı: Apache / nginx ve sürüm bilgileri */
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Bilinmiyor';

/* Sunucu portu: HTTP 80, HTTPS 443 gibi */
$serverPort = $_SERVER['SERVER_PORT'] ?? 'Bilinmiyor';

/* ------------------------------------------------------------
   SSL (HTTPS) kontrolü
   ------------------------------------------------------------ */

/*
 HTTPS aktif mi?
 Bazı sunucularda HTTPS değeri "on" veya "1" olur
*/
$sslAktifMi = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'Evet (SSL/HTTPS aktif)' : 'Hayır (HTTP)';

/*
 Sayfanın tam adresini (URL) oluşturma:
 - SSL aktifse https://
 - değilse http://
*/
$protokol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$tamUrl = $protokol . '://' . $domain . ($_SERVER['REQUEST_URI'] ?? '/');


/* ------------------------------------------------------------
   MIME TYPE (İçerik türü) örneği
   ------------------------------------------------------------ */

/*
 Bu sayfanın çıktı formatı HTML olduğu için
 tarayıcıya Content-Type header'ı gönderebiliriz.
 (Genelde PHP otomatik ayarlar ama biz örnek olsun diye ekliyoruz.)
*/
header('Content-Type: text/html; charset=UTF-8');

/*
 MIME type örneği için bir dosya yolundan tahmin yapalım:
 finfo uzantısı açık olmalı (çoğu Wamp kurulumunda açık gelir)
*/
$ornekDosya = __FILE__; // Bu PHP dosyasının kendisi
$mimeType = 'Tespit edilemedi';

if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);           // MIME türü tespiti için finfo başlat
    $mimeType = finfo_file($finfo, $ornekDosya);       // Dosyanın MIME türünü bul
    finfo_close($finfo);                               // finfo kaynağını kapat
}

/* ------------------------------------------------------------
   FTP bilgisi (güvenli şekilde)
   ------------------------------------------------------------ */

/*
 FTP, bir sunucuya dosya atmak için kullanılan protokoldür.
 Bu sayfa FTP ile bağlantı kurmak zorunda değil.
 Ama FTP'nin mantığını göstermek için "örnek ayar" değişkenleri
 tanımlıyoruz (GERÇEK şifre koyma!).
*/
$ftpHost = $domain;          // Genelde ftp.domain.com veya domain.com olur
$ftpKullanici = "kullanici_adi";  // Örnek kullanıcı adı
$ftpPort = 21;               // FTP portu 21, FTPS genelde 990

/*
 Hosting kavramı:
 - Hosting: sitenin dosyalarının durduğu servis
 - Biz burada gerçek hosting firmasını bilemeyiz,
   ama server software, path ve domain bilgileri hosting ortamı hakkında fikir verir.
*/

/* ------------------------------------------------------------
   Hosting yolu: dosyanın sunucudaki fiziksel konumu
   ------------------------------------------------------------ */
$scriptFilename = $_SERVER['SCRIPT_FILENAME'] ?? 'Bilinmiyor'; // fiziksel dosya yolu
$documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? 'Bilinmiyor';     // site kök klasörü

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Domain / Server / Hosting / FTP / MIME / SSL Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        h2 { margin:0 0 10px 0; }
        .satir { padding:6px 0; border-bottom:1px solid #1f2937; }
        .etiket { color:#93c5fd; display:inline-block; min-width:180px; }
        code { background:#1f2937; padding:2px 6px; border-radius:6px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) Domain Bilgisi</h2>
    <div class="satir"><span class="etiket">Domain / Host:</span> <?= htmlspecialchars($domain) ?></div>
    <div class="satir"><span class="etiket">Tam URL:</span> <?= htmlspecialchars($tamUrl) ?></div>
</div>

<div class="kutu">
    <h2>2) Server Bilgisi</h2>
    <div class="satir"><span class="etiket">SERVER_NAME:</span> <?= htmlspecialchars($serverName) ?></div>
    <div class="satir"><span class="etiket">SERVER_ADDR (IP):</span> <?= htmlspecialchars($serverIp) ?></div>
    <div class="satir"><span class="etiket">SERVER_SOFTWARE:</span> <?= htmlspecialchars($serverSoftware) ?></div>
    <div class="satir"><span class="etiket">SERVER_PORT:</span> <?= htmlspecialchars($serverPort) ?></div>
</div>

<div class="kutu">
    <h2>3) Hosting Mantığı (Kök Dizin / Dosya Yolu)</h2>
    <div class="satir"><span class="etiket">DOCUMENT_ROOT:</span> <code><?= htmlspecialchars($documentRoot) ?></code></div>
    <div class="satir"><span class="etiket">SCRIPT_FILENAME:</span> <code><?= htmlspecialchars($scriptFilename) ?></code></div>
    <div class="satir"><span class="etiket">Açıklama:</span> Hosting, bu dosyaların sunucuda barındırıldığı hizmettir.</div>
</div>

<div class="kutu">
    <h2>4) FTP (Dosya Yükleme) Bilgisi - Örnek</h2>
    <div class="satir"><span class="etiket">FTP Host:</span> <?= htmlspecialchars($ftpHost) ?></div>
    <div class="satir"><span class="etiket">FTP Port:</span> <?= htmlspecialchars((string)$ftpPort) ?></div>
    <div class="satir"><span class="etiket">FTP Kullanıcı:</span> <?= htmlspecialchars($ftpKullanici) ?></div>
    <div class="satir"><span class="etiket">Not:</span> Gerçek projede şifreyi koda yazma. (.env kullan)</div>
</div>

<div class="kutu">
    <h2>5) MIME Type (İçerik Türü)</h2>
    <div class="satir"><span class="etiket">Bu dosyanın MIME type:</span> <?= htmlspecialchars($mimeType) ?></div>
    <div class="satir"><span class="etiket">Açıklama:</span> MIME type tarayıcıya “bu içerik ne?” bilgisini verir (text/html, image/png vb.)</div>
</div>

<div class="kutu">
    <h2>6) SSL / HTTPS Kontrolü</h2>
    <div class="satir"><span class="etiket">HTTPS Aktif mi?</span> <?= htmlspecialchars($sslAktifMi) ?></div>
    <div class="satir"><span class="etiket">Protokol:</span> <?= htmlspecialchars($protokol) ?></div>
</div>

</body>
</html>
