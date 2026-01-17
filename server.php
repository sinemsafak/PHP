<?php
/*
 $_SERVER dizisi, sunucu, istek ve istemci (kullanıcı)
 hakkında otomatik üretilen bilgileri tutar.
*/
/* Çalışan dosyanın URL'e göre yolunu verir */
$phpSelf = $_SERVER['PHP_SELF'];

/* Sunucunun kullandığı CGI sürümünü verir */
$gatewayInterface = $_SERVER['GATEWAY_INTERFACE'];

/* Sunucunun IP adresini verir */
$serverAddr = $_SERVER['SERVER_ADDR'];

/* Sunucunun alan adını verir (localhost gibi) */
$serverName = $_SERVER['SERVER_NAME'];

/* Sunucu yazılım bilgisini verir (Apache, Nginx vs.) */
$serverSoftware = $_SERVER['SERVER_SOFTWARE'];

/* HTTP protokol sürümünü verir */
$serverProtocol = $_SERVER['SERVER_PROTOCOL'];

/* Sayfaya hangi yöntemle gelindiğini verir (GET, POST) */
$requestMethod = $_SERVER['REQUEST_METHOD'];

/* İsteğin yapıldığı zamanın timestamp karşılığı */
$requestTime = $_SERVER['REQUEST_TIME'];

/* URL'deki ? sonrası sorgu kısmını verir */
$queryString = $_SERVER['QUERY_STRING'];

/* Tarayıcının kabul ettiği içerik türlerini verir */
$httpAccept = $_SERVER['HTTP_ACCEPT'] ?? 'Bilgi yok';

/* Tarayıcının karakter seti bilgisini verir */
$httpAcceptCharset = $_SERVER['HTTP_ACCEPT_CHARSET'] ?? 'Bilgi yok';

/* Mevcut isteğin host bilgisini verir */
$httpHost = $_SERVER['HTTP_HOST'];

/* Kullanıcının geldiği önceki sayfayı verir */
$httpReferer = $_SERVER['HTTP_REFERER'] ?? 'Doğrudan giriş';

/* HTTPS kullanılıp kullanılmadığını belirtir */
$https = $_SERVER['HTTPS'] ?? 'Kapalı';

/* Siteye giren kullanıcının IP adresi */
$remoteAddr = $_SERVER['REMOTE_ADDR'];

/* Kullanıcının bilgisayar adı (çoğu zaman boş gelir) */
$remoteHost = $_SERVER['REMOTE_HOST'] ?? 'Çözümlenemedi';

/* Kullanıcının bağlandığı port numarası */
$remotePort = $_SERVER['REMOTE_PORT'];

/* Çalışan PHP dosyasının sunucudaki tam yolu */
$scriptFilename = $_SERVER['SCRIPT_FILENAME'];

/* Sunucu yöneticisinin mail adresi */
$serverAdmin = $_SERVER['SERVER_ADMIN'] ?? 'Tanımlı değil';

/* Sunucunun kullandığı port */
$serverPort = $_SERVER['SERVER_PORT'];

/* Sunucu imzası (sürüm bilgisi) */
$serverSignature = $_SERVER['SERVER_SIGNATURE'] ?? 'Kapalı';

/* Dosya sistemindeki gerçek yol */
$pathTranslated = $_SERVER['PATH_TRANSLATED'] ?? 'Yok';

/* Scriptin web üzerindeki yolu */
$scriptName = $_SERVER['SCRIPT_NAME'];

/* Sayfanın tam URI bilgisi */
$scriptUri = $_SERVER['SCRIPT_URI'] ?? 'Desteklenmiyor';

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>$_SERVER Süper Küreseli Demo</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; padding:20px; }
        table { width:100%; border-collapse: collapse; background:#fff; }
        th, td { border:1px solid #ccc; padding:8px; }
        th { background:#2c3e50; color:#fff; }
    </style>
</head>
<body>


<table>
<tr><th>Değişken</th><th>Değer</th></tr>

<tr><td>PHP_SELF</td><td><?= $phpSelf ?></td></tr>
<tr><td>GATEWAY_INTERFACE</td><td><?= $gatewayInterface ?></td></tr>
<tr><td>SERVER_ADDR</td><td><?= $serverAddr ?></td></tr>
<tr><td>SERVER_NAME</td><td><?= $serverName ?></td></tr>
<tr><td>SERVER_SOFTWARE</td><td><?= $serverSoftware ?></td></tr>
<tr><td>SERVER_PROTOCOL</td><td><?= $serverProtocol ?></td></tr>
<tr><td>REQUEST_METHOD</td><td><?= $requestMethod ?></td></tr>
<tr><td>REQUEST_TIME</td><td><?= $requestTime ?></td></tr>
<tr><td>QUERY_STRING</td><td><?= $queryString ?></td></tr>
<tr><td>HTTP_ACCEPT</td><td><?= $httpAccept ?></td></tr>
<tr><td>HTTP_ACCEPT_CHARSET</td><td><?= $httpAcceptCharset ?></td></tr>
<tr><td>HTTP_HOST</td><td><?= $httpHost ?></td></tr>
<tr><td>HTTP_REFERER</td><td><?= $httpReferer ?></td></tr>
<tr><td>HTTPS</td><td><?= $https ?></td></tr>
<tr><td>REMOTE_ADDR</td><td><?= $remoteAddr ?></td></tr>
<tr><td>REMOTE_HOST</td><td><?= $remoteHost ?></td></tr>
<tr><td>REMOTE_PORT</td><td><?= $remotePort ?></td></tr>
<tr><td>SCRIPT_FILENAME</td><td><?= $scriptFilename ?></td></tr>
<tr><td>SERVER_ADMIN</td><td><?= $serverAdmin ?></td></tr>
<tr><td>SERVER_PORT</td><td><?= $serverPort ?></td></tr>
<tr><td>SERVER_SIGNATURE</td><td><?= $serverSignature ?></td></tr>
<tr><td>PATH_TRANSLATED</td><td><?= $pathTranslated ?></td></tr>
<tr><td>SCRIPT_NAME</td><td><?= $scriptName ?></td></tr>
<tr><td>SCRIPT_URI</td><td><?= $scriptUri ?></td></tr>

</table>

</body>
</html>

