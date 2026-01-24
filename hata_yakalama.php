<?php
/**************************************************************
 * PHP TRY - CATCH - FINALLY & ERROR REPORTING DEMOSU
 * Tek sayfalık, açıklamalı örnek
 **************************************************************/

/* ------------------------------------------------------------
   1) ERROR REPORTING (Hata gösterme ayarları)
   ------------------------------------------------------------ */

/*
 error_reporting(E_ALL)
 → Tüm PHP hatalarını gösterir (Notice, Warning, Fatal vs.)
 Geliştirme ortamında AÇIK olmalıdır.
*/
error_reporting(E_ALL);

/*
 display_errors = 1
 → Hataları tarayıcıda göster
 Canlı (production) sunucuda KAPALI olmalıdır.
*/
ini_set("display_errors", 1);


/* ------------------------------------------------------------
   2) TRY - CATCH - FINALLY örneği
   ------------------------------------------------------------ */

/*
 try bloğu:
 Hata çıkma ihtimali olan kod buraya yazılır
*/
try {

    // Kullanıcıdan geldiğini varsaydığımız bir değer
    $sayi = 0;

    /*
     Eğer sayı 0 ise kendi hatamızı fırlatıyoruz
     throw → bilerek exception üretir
    */
    if ($sayi == 0) {
        throw new Exception("Sayı 0 olamaz! Bölme hatası.");
    }

    // Normal şartlarda çalışan kod
    $sonuc = 10 / $sayi;

    echo "Sonuç: " . $sonuc;

}
/*
 catch bloğu:
 try içinde hata oluşursa burası çalışır
*/
catch (Exception $e) {

    /*
     $e->getMessage()
     → hatanın mesajını verir
    */
    echo "<div style='color:red;'>HATA YAKALANDI: " . $e->getMessage() . "</div>";

}
/*
 finally bloğu:
 Hata olsun ya da olmasın HER ZAMAN çalışır
*/
finally {

    echo "<div style='color:yellow;'>FINALLY BLOĞU ÇALIŞTI (Temizlik işlemleri burada yapılır)</div>";

}


/* ------------------------------------------------------------
   3) Gerçek hayattan örnek: Dosya okuma
   ------------------------------------------------------------ */

echo "<hr>";

try {

    /*
     Olmayan bir dosyayı açmaya çalışıyoruz
     fopen hata üretir ama exception üretmez
     Bu yüzden manuel kontrol yapıyoruz
    */
    $dosya = "olmayan_dosya.txt";

    if (!file_exists($dosya)) {
        throw new Exception("Dosya bulunamadı: " . $dosya);
    }

    $icerik = file_get_contents($dosya);
    echo $icerik;

}
catch (Exception $e) {

    echo "<div style='color:red;'>DOSYA HATASI: " . $e->getMessage() . "</div>";

}
finally {

    echo "<div style='color:lightgreen;'>Dosya kontrol işlemi tamamlandı.</div>";

}


/* ------------------------------------------------------------
   4) Fatal hata örneği (try-catch YAKALAYAMAZ!)
   ------------------------------------------------------------ */

/*
 Aşağıdaki satır yorumdan çıkarılırsa:
 $x = 5 / "abc";
 → Fatal TypeError üretir ve try-catch yakalayamaz.
 Çünkü bu gerçek PHP motor hatasıdır.
*/

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Try Catch Finally Demo</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; font-family:Arial; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>TRY - CATCH - FINALLY Nedir?</h2>
    <p><b>try:</b> Riskli kod</p>
    <p><b>catch:</b> Hata yakalama</p>
    <p><b>finally:</b> Her durumda çalışan blok</p>
</div>

<div class="kutu">
    <h2>Error Reporting Nedir?</h2>
    <p>PHP hatalarının ekranda görünüp görünmeyeceğini kontrol eder.</p>
    <p>Geliştirmede: AÇIK</p>
    <p>Canlı sistemde: KAPALI</p>
</div>

</body>
</html>
