<?php
/**************************************************************
 * RETURN İLE FONKSİYON DÖNDÜRME (CALLABLE)
 * Fonksiyonu otomatik çalıştırma (hemen çağırma)
 * Parametre gönderme - Tek sayfa demo
 **************************************************************/

/* ------------------------------------------------------------
   1) Fonksiyon döndüren fonksiyon (Factory / Closure)
   ------------------------------------------------------------ */

/*
 Bu fonksiyon bir "fonksiyon" döndürecek.
 Yani return ile callable (closure) döndürüyoruz.
*/
function selamlayiciOlustur($prefix)
{
    /*
     return function(...) use ($prefix)
     → burada anonim fonksiyon döndürülür.
     use($prefix) ile dışarıdaki $prefix değişkenini
     closure içine taşıyoruz.
    */
    return function ($isim) use ($prefix) {

        // htmlspecialchars ile XSS'e karşı basit koruma
        $isim = htmlspecialchars($isim);

        // prefix + isim ile selam mesajı döndür
        return $prefix . " " . $isim;
    };
}

/* ------------------------------------------------------------
   2) Dönen fonksiyonu değişkene alıp sonra çalıştırma
   ------------------------------------------------------------ */

// "Merhaba" prefix'i ile bir selamlayıcı fonksiyon üretiyoruz
$merhabaFonksiyonu = selamlayiciOlustur("Merhaba");

// Üretilen fonksiyonu parametre vererek çağırıyoruz
$sonuc1 = $merhabaFonksiyonu("Ahmet"); // Merhaba Ahmet

// "Selam" prefix'i ile ikinci bir fonksiyon üretiyoruz
$selamFonksiyonu = selamlayiciOlustur("Selam");

// Onu da çalıştırıyoruz
$sonuc2 = $selamFonksiyonu("Elif"); // Selam Elif


/* ------------------------------------------------------------
   3) Fonksiyonu OTOMATİK çalıştırma (hemen çağırma)
   ------------------------------------------------------------ */

/*
 PHP'de bir fonksiyonun döndürdüğü fonksiyonu
 aynı satırda hemen çağırabiliriz:

 selamlayiciOlustur("Hi")("Mehmet")

 İlk parantez: dış fonksiyonun parametresi
 İkinci parantez: dönen fonksiyonun parametresi
*/
$sonuc3 = selamlayiciOlustur("Nasılsın")("Mehmet");


/* ------------------------------------------------------------
   4) Parametreli işlem döndüren fonksiyon örneği (çarpan üretici)
   ------------------------------------------------------------ */

/*
 Bu fonksiyon bir çarpma fonksiyonu döndürür.
 Dıştan "carpan" alır, iç fonksiyonla sayıyı çarpar.
*/
function carpanOlustur($carpan)
{
    // Dış değişkeni closure içine alıyoruz
    return function ($sayi) use ($carpan) {

        // Sayısal mı kontrol edelim (demo amaçlı)
        if (!is_numeric($sayi)) {
            // Hatalıysa exception fırlat
            throw new Exception("Sayı gönderilmelidir! Gelen değer: " . htmlspecialchars((string)$sayi));
        }

        // Çarpım sonucunu döndür
        return $sayi * $carpan;
    };
}

// try-catch: hata olursa sayfa patlamasın
try {
    // 5 ile çarpan bir fonksiyon üretiyoruz
    $x5 = carpanOlustur(5);

    // Parametre gönderip çalıştırıyoruz
    $sonuc4 = $x5(10); // 50

    // Aynı satırda otomatik çalıştırma örneği
    $sonuc5 = carpanOlustur(3)(7); // 21

} catch (Exception $e) {
    // Hata olursa mesajı sakla
    $hata = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Return ile Fonksiyon Döndürme Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        code { background:#1f2937; padding:2px 6px; border-radius:6px; }
        .hata { background:#7f1d1d; padding:10px; border-radius:8px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) Return ile Fonksiyon Döndürme (Callable)</h2>
    <p><b>Örnek:</b> <code>$merhabaFonksiyonu = selamlayiciOlustur("Merhaba");</code></p>
    <p><b>Çalıştırma:</b> <code>$merhabaFonksiyonu("Ahmet");</code></p>
    <p><b>Sonuç:</b> <?= $sonuc1 ?></p>
</div>

<div class="kutu">
    <h2>2) Başka Bir Dönen Fonksiyon</h2>
    <p><b>Sonuç:</b> <?= $sonuc2 ?></p>
</div>

<div class="kutu">
    <h2>3) Fonksiyonu Otomatik Çalıştırma (Hemen Çağırma)</h2>
    <p><code>selamlayiciOlustur("Nasılsın")("Mehmet")</code></p>
    <p><b>Sonuç:</b> <?= $sonuc3 ?></p>
</div>

<div class="kutu">
    <h2>4) Parametre Gönderme (Çarpan Üretici)</h2>

    <?php if (!empty($hata ?? "")): ?>
        <div class="hata"><b>Hata:</b> <?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>

    <p><code>$x5 = carpanOlustur(5);</code> → sonra <code>$x5(10)</code></p>
    <p><b>Sonuç 1 (10 * 5):</b> <?= $sonuc4 ?? "-" ?></p>

    <p><code>carpanOlustur(3)(7)</code> (aynı satırda otomatik çalışma)</p>
    <p><b>Sonuç 2 (7 * 3):</b> <?= $sonuc5 ?? "-" ?></p>
</div>

</body>
</html>
