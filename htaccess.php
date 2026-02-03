<?php
/************************************************************
 * .htaccess Demo - Tek Sayfa PHP Açıklamalı
 * Apache sunucularda kullanılan .htaccess kurallarını
 * açıklamalı şekilde gösterir.
 ************************************************************/

/*
 .htaccess gerçek bir PHP dosyası değildir.
 Apache tarafından okunur.
 Ama biz eğitim için içeriğini PHP içinde gösteriyoruz.
*/

/* Örnek .htaccess içeriğini string olarak tutuyoruz */
$htaccessIcerik = '
# 1) Dizin listelemeyi kapatır
Options -Indexes

# 2) Varsayılan index dosyasını belirler
DirectoryIndex index.php index.html

# 3) Hataları özel sayfaya yönlendirir
ErrorDocument 404 /404.php

# 4) URL rewrite (SEO dostu link)
RewriteEngine On
RewriteRule ^profil/(.*)$ profil.php?kullanici=$1 [L]

# 5) HTTPS yönlendirmesi (SSL zorunlu)
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# 6) PHP dosyalarını gizle (.php uzantısını kaldırır)
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php [L]

# 7) Dosya yükleme limiti
php_value upload_max_filesize 10M
php_value post_max_size 10M

# 8) Cache kontrolü
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresDefault "access plus 7 days"
</IfModule>

# 9) Hotlink koruması
RewriteCond %{HTTP_REFERER} !^$
RewriteCond %{HTTP_REFERER} !^https?://(www\.)?siteadresin.com [NC]
RewriteRule \.(jpg|png|gif)$ - [F]

# 10) IP engelleme
Deny from 192.168.1.100
';

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>.htaccess Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        pre { background:#020617; padding:15px; border-radius:10px; overflow:auto; }
        h2 { color:#38bdf8; }
        .satir { margin-bottom:8px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>.htaccess Nedir?</h2>
    <div class="satir">
        .htaccess, Apache web sunucusunda dizin bazlı
        ayar yapmamızı sağlayan yapılandırma dosyasıdır.
    </div>
    <div class="satir">
        PHP çalışmadan önce sunucu tarafından okunur.
    </div>
</div>

<div class="kutu">
    <h2>Örnek .htaccess İçeriği</h2>
    <pre><?= htmlspecialchars($htaccessIcerik) ?></pre>
</div>

<div class="kutu">
    <h2>Satır Satır Ne İşe Yarıyor?</h2>

    <div class="satir"><b>Options -Indexes</b> → Klasördeki dosya listesini gizler</div>
    <div class="satir"><b>DirectoryIndex</b> → Ana dosyayı belirler</div>
    <div class="satir"><b>ErrorDocument 404</b> → 404 hatasını özel sayfaya yönlendirir</div>
    <div class="satir"><b>RewriteEngine On</b> → URL yönlendirme motorunu açar</div>
    <div class="satir"><b>profil/ahmet</b> → profil.php?kullanici=ahmet olur</div>
    <div class="satir"><b>HTTPS redirect</b> → HTTP geleni otomatik HTTPS yapar</div>
    <div class="satir"><b>.php gizleme</b> → /hakkimizda → hakkimizda.php</div>
    <div class="satir"><b>upload_max_filesize</b> → Dosya yükleme sınırı</div>
    <div class="satir"><b>Cache</b> → Tarayıcıya dosyayı 7 gün sakla der</div>
    <div class="satir"><b>Hotlink</b> → Resimleri başka siteler kullanamasın</div>
    <div class="satir"><b>Deny from</b> → IP engelleme</div>
</div>

<div class="kutu">
    <h2>Gerçek Hayatta Ne İçin Kullanılır?</h2>
    <div class="satir">✔ SEO link yapısı</div>
    <div class="satir">✔ SSL zorunlu kılma</div>
    <div class="satir">✔ Güvenlik (IP, hotlink)</div>
    <div class="satir">✔ Dosya gizleme</div>
    <div class="satir">✔ Cache performans</div>
</div>

</body>
</html>
