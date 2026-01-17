<?php
/**************************************************************
 * MIME TYPE (Multipurpose Internet Mail Extensions) DEMOSU
 * Tek sayfalık, canlı ve açıklamalı PHP örneği
 **************************************************************/

/*
 MIME Type = Dosyanın internet üzerindeki kimliğidir.
 Tarayıcıya "bu dosya nedir?" bilgisini verir.
 Örnek:
 image/jpeg → resim
 text/html  → web sayfası
 application/pdf → PDF dosyası
*/

/* ------------------------------------------------------------
   1) Bu sayfanın MIME type'ını ayarlama
   ------------------------------------------------------------ */

/*
 Tarayıcıya bu sayfanın HTML olduğunu bildiriyoruz.
 (Normalde PHP otomatik gönderir, biz eğitim amaçlı yazıyoruz)
*/
header("Content-Type: text/html; charset=UTF-8");


/* ------------------------------------------------------------
   2) Dosya uzantısından MIME TYPE bulma (manuel tablo)
   ------------------------------------------------------------ */

/*
 En sık kullanılan MIME type eşleştirme dizisi
 (Gerçek sistemlerde whitelist olarak kullanılır)
*/
$mimeMap = [
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'pdf'  => 'application/pdf',
    'zip'  => 'application/zip',
    'mp3'  => 'audio/mpeg',
    'mp4'  => 'video/mp4',
    'html' => 'text/html',
    'txt'  => 'text/plain'
];

/*
 Örnek dosya adı belirliyoruz
*/
$ornekDosyaAdi = "ornek.pdf";

/*
 pathinfo ile dosyanın uzantısını alıyoruz
*/
$uzanti = pathinfo($ornekDosyaAdi, PATHINFO_EXTENSION);

/*
 Uzantıya göre MIME type buluyoruz
*/
$manuelMime = $mimeMap[$uzanti] ?? 'Bilinmeyen MIME type';


/* ------------------------------------------------------------
   3) Gerçek dosyanın MIME TYPE'ını otomatik tespit etme
   ------------------------------------------------------------ */

/*
 __FILE__ → şu an çalışan PHP dosyasının kendisi
*/
$gercekDosya = __FILE__;

/*
 Varsayılan değer
*/
$gercekMime = "Tespit edilemedi";

/*
 finfo fonksiyonu varsa MIME otomatik tespit edilir
*/
if (function_exists('finfo_open')) {

    // MIME type tespit motorunu başlat
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    // Dosyanın gerçek MIME type'ını oku
    $gercekMime = finfo_file($finfo, $gercekDosya);

    // Bellek sızıntısı olmaması için kapat
    finfo_close($finfo);
}


/* ------------------------------------------------------------
   4) Tarayıcıdan gelen dosya isteğinin MIME TYPE'ı
   ------------------------------------------------------------ */

/*
 Tarayıcının hangi türleri kabul ettiğini gösterir
 (image/webp, text/html vb.)
*/
$tarayiciMime = $_SERVER['HTTP_ACCEPT'] ?? 'Bilgi yok';


/* ------------------------------------------------------------
   5) Güvenlikte MIME TYPE neden önemlidir?
   ------------------------------------------------------------ */

/*
 Örnek:
 Kullanıcı .jpg diye virüs yükleyebilir.
 Bu yüzden sadece uzantıya değil,
 gerçek MIME type'a bakılır.
*/

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>MIME TYPE Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        .satir { padding:6px 0; border-bottom:1px solid #1f2937; }
        .etiket { color:#93c5fd; display:inline-block; min-width:260px; }
        code { background:#1f2937; padding:3px 6px; border-radius:6px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) Sayfanın MIME Type Bilgisi</h2>
    <div class="satir"><span class="etiket">Header ile gönderilen tür:</span> text/html</div>
</div>

<div class="kutu">
    <h2>2) Uzantıdan Manuel MIME Tespiti</h2>
    <div class="satir"><span class="etiket">Örnek dosya adı:</span> <?= htmlspecialchars($ornekDosyaAdi) ?></div>
    <div class="satir"><span class="etiket">Dosya uzantısı:</span> <?= htmlspecialchars($uzanti) ?></div>
    <div class="satir"><span class="etiket">Bulunan MIME type:</span> <?= htmlspecialchars($manuelMime) ?></div>
</div>

<div class="kutu">
    <h2>3) Gerçek Dosyanın Otomatik MIME Type'ı</h2>
    <div class="satir"><span class="etiket">Bu PHP dosyasının MIME type:</span> <?= htmlspecialchars($gercekMime) ?></div>
</div>

<div class="kutu">
    <h2>4) Tarayıcının Kabul Ettiği MIME Türleri</h2>
    <div class="satir"><span class="etiket">HTTP_ACCEPT:</span> <?= htmlspecialchars($tarayiciMime) ?></div>
</div>

<div class="kutu">
    <h2>5) MIME TYPE Neden Kritik?</h2>
    <div class="satir">✔ Dosya yükleme güvenliği</div>
    <div class="satir">✔ Tarayıcının dosyayı nasıl açacağını belirler</div>
    <div class="satir">✔ Mail eklerinde dosya türünü tanımlar</div>
    <div class="satir">✔ Sunucu dosyayı indirsin mi açsın mı karar verir</div>
</div>

</body>
</html>
