<?php
/**************************************************************
 * DİZİLERDE ANONİM FUNCTION + func_num_args + func_get_args DEMO
 * Tek sayfa - açıklamalı örnek
 **************************************************************/

/* ------------------------------------------------------------
   1) Örnek bir dizi tanımlıyoruz
   ------------------------------------------------------------ */

// Sayılar dizisi oluşturduk (dizilerde işlem yapmak için)
$sayilar = [1, 2, 3, 4, 5, 6];


/* ------------------------------------------------------------
   2) array_map ile anonim function kullanımı
   ------------------------------------------------------------ */

/*
 array_map:
 - Dizinin her elemanını tek tek dolaşır
 - Verdiğimiz fonksiyonun döndürdüğü değeri yeni diziye koyar
*/

// Her sayının karesini alan anonim fonksiyon (closure) tanımlıyoruz
$kareler = array_map(function ($n) {
    // $n o anki elemandır
    return $n * $n; // karesini döndür
}, $sayilar); // işlem yapılacak dizi


/* ------------------------------------------------------------
   3) array_filter ile anonim function kullanımı
   ------------------------------------------------------------ */

/*
 array_filter:
 - Dizideki elemanları filtreler
 - Fonksiyon true dönerse eleman kalır, false dönerse çıkar
*/

// Sadece çift sayıları filtreleyen anonim fonksiyon
$ciftSayilar = array_filter($sayilar, function ($n) {
    return $n % 2 == 0; // çiftse true
});


/* ------------------------------------------------------------
   4) usort ile anonim function kullanımı (sıralama)
   ------------------------------------------------------------ */

/*
 usort:
 - Diziyi bizim belirlediğimiz kurala göre sıralar
 - Fonksiyon iki eleman alır ($a, $b)
 - 0, -1, 1 döndürerek sıralama belirler
*/

// Karışık bir dizi oluşturuyoruz
$isimler = ["Zeynep", "Ahmet", "Mehmet", "Elif"];

// Alfabetik sıralama için usort + anonim function
usort($isimler, function ($a, $b) {
    // strcmp iki stringi karşılaştırır
    return strcmp($a, $b);
});


/* ------------------------------------------------------------
   5) func_num_args ve func_get_args örneği
   ------------------------------------------------------------ */

/*
 Bu fonksiyon kaç parametre gelirse gelsin çalışacak.
 func_num_args()  -> kaç argüman geldiğini söyler
 func_get_args()  -> gelen argümanları dizi olarak verir
*/
function toplaDegiskenli()
{
    // Fonksiyona kaç parametre geldi?
    $adet = func_num_args();

    // Gelen parametrelerin tamamını dizi olarak al
    $args = func_get_args();

    // Toplamı tutacağımız değişken
    $toplam = 0;

    // Tüm argümanları dolaş
    foreach ($args as $deger) {
        // Eğer sayı değilse hata fırlat (basit kontrol)
        if (!is_numeric($deger)) {
            throw new Exception("Sadece sayılar gönderilmeli! Hatalı değer: " . htmlspecialchars((string)$deger));
        }

        // Sayıysa toplamı artır
        $toplam += $deger;
    }

    // Sonuç olarak hem adet hem args hem toplam döndürelim
    return [
        "adet" => $adet,
        "args" => $args,
        "toplam" => $toplam
    ];
}

// Hata yakalamak için try-catch kullanıyoruz
try {
    // Fonksiyona farklı sayıda parametre gönderiyoruz
    $sonuc1 = toplaDegiskenli(10, 20, 30);
    $sonuc2 = toplaDegiskenli(5, 7);
    // İstersen bunu açıp hata örneği görebilirsin:
    // $sonuc3 = toplaDegiskenli(1, "abc", 3);
} catch (Exception $e) {
    // Eğer hata olursa mesajı kaydet
    $hataMesaji = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Anonim Function & func_get_args Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        code { background:#1f2937; padding:2px 6px; border-radius:6px; }
        pre { background:#1f2937; padding:10px; border-radius:10px; overflow:auto; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) Orijinal Dizi</h2>
    <pre><?php print_r($sayilar); ?></pre>
</div>

<div class="kutu">
    <h2>2) array_map + Anonim Function (Kareler)</h2>
    <p><code>array_map(function(){...}, $sayilar)</code></p>
    <pre><?php print_r($kareler); ?></pre>
</div>

<div class="kutu">
    <h2>3) array_filter + Anonim Function (Çift Sayılar)</h2>
    <p><code>array_filter($sayilar, function(){...})</code></p>
    <pre><?php print_r($ciftSayilar); ?></pre>
</div>

<div class="kutu">
    <h2>4) usort + Anonim Function (İsimleri Sıralama)</h2>
    <p><code>usort($isimler, function($a,$b){...})</code></p>
    <pre><?php print_r($isimler); ?></pre>
</div>

<div class="kutu">
    <h2>5) func_num_args & func_get_args (Değişken Parametre)</h2>

    <?php if (!empty($hataMesaji ?? "")): ?>
        <p style="color:#f87171;"><b>Hata:</b> <?= htmlspecialchars($hataMesaji) ?></p>
    <?php endif; ?>

    <h3>Örnek 1: toplaDegiskenli(10, 20, 30)</h3>
    <pre><?php print_r($sonuc1); ?></pre>

    <h3>Örnek 2: toplaDegiskenli(5, 7)</h3>
    <pre><?php print_r($sonuc2); ?></pre>

    <p>
        <b>Açıklama:</b><br>
        <code>func_num_args()</code> fonksiyona kaç argüman geldiğini verir.<br>
        <code>func_get_args()</code> gelen argümanların tamamını dizi olarak döndürür.
    </p>
</div>

</body>
</html>
