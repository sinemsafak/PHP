<?php
/***************************************************************
 * PHP serialize() & unserialize() - TEK SAYFA DEMO
 * - Dizi/nesne verisini string'e çevirme (serialize)
 * - String veriyi tekrar eski haline getirme (unserialize)
 * - Güvenli unserialize: allowed_classes
 ***************************************************************/

/* Tarayıcıya doğru karakter setiyle HTML döndürmek için header gönderiyoruz */
header("Content-Type: text/html; charset=UTF-8");


/* -------------------------------------------------------------
   1) SERİLEŞTİRİLECEK ÖRNEK VERİLER
------------------------------------------------------------- */

/* Örnek bir dizi oluşturuyoruz (array) */
$kullanici = [
    "id" => 7,                     // Kullanıcının id'si
    "ad" => "Ahmet",                // Kullanıcının adı
    "roller" => ["admin", "editor"] // Kullanıcının rolleri (iç içe dizi)
];

/* Örnek bir sınıf tanımlıyoruz (nesne serialize edilebilsin diye) */
class Urun
{
    public $ad;        // Ürün adı
    public $fiyat;     // Ürün fiyatı

    public function __construct($ad, $fiyat)
    {
        $this->ad = $ad;        // Gelen adı nesneye atar
        $this->fiyat = $fiyat;  // Gelen fiyatı nesneye atar
    }
}

/* Sınıftan bir nesne üretiyoruz */
$urun = new Urun("Klavye", 799.90);


/* -------------------------------------------------------------
   2) serialize() - VERİYİ STRING'E ÇEVİRME
------------------------------------------------------------- */

/* Diziyi serialize ediyoruz: artık saklanabilir/taşınabilir string olur */
$kullaniciSerialized = serialize($kullanici);

/* Nesneyi serialize ediyoruz: class bilgisiyle beraber string olur */
$urunSerialized = serialize($urun);


/* -------------------------------------------------------------
   3) unserialize() - STRING'I TEKRAR ORİJİNAL TİPE DÖNÜŞTÜRME
------------------------------------------------------------- */

/*
 Güvenli kullanım:
 allowed_classes => false dersek nesne üretimine izin vermez (dizi vs. için güvenli)
 allowed_classes => ['Urun'] dersek sadece Urun sınıfından nesne üretimine izin verir
*/

/* Diziyi geri açıyoruz (array olarak döner) */
$kullaniciUnserialized = unserialize($kullaniciSerialized, [
    "allowed_classes" => false // Dizide nesne beklemiyoruz, en güvenli ayar
]);

/* Nesneyi geri açıyoruz (Urun nesnesi olarak döner) */
$urunUnserialized = unserialize($urunSerialized, [
    "allowed_classes" => ["Urun"] // Sadece Urun sınıfına izin ver
]);


/* -------------------------------------------------------------
   4) ÖRNEK: FORM İLE SERİLEŞTİRME / GERİ AÇMA
------------------------------------------------------------- */

/* Ekranda mesaj göstermek için değişkenler */
$mesaj = "";
$gelenVeri = "";

/* Form gönderildiyse (POST ise) */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* Textarea'dan gelen string'i alıyoruz (yoksa boş) */
    $gelenVeri = $_POST["serialized"] ?? "";

    /* Boş mu kontrol ediyoruz */
    if (trim($gelenVeri) === "") {
        $mesaj = "Serialized veri boş olamaz!";
    } else {
        /*
         Kullanıcının gönderdiği veriyi açmaya çalışıyoruz.
         Güvenlik için nesne üretimine izin vermiyoruz.
        */
        $acilan = @unserialize($gelenVeri, ["allowed_classes" => false]);

        /*
         @ işareti: unserialize hatası olursa PHP uyarısını bastırır
         (Biz hatayı kendimiz kontrol edip mesaj göstereceğiz)
        */

        /* Eğer unserialize false dönerse veri bozuk/hatalı olabilir */
        if ($acilan === false && $gelenVeri !== serialize(false)) {
            $mesaj = "Unserialize başarısız! Veri formatı geçersiz olabilir.";
        } else {
            /* Başarılı açıldıysa kullanıcıya bilgi veriyoruz */
            $mesaj = "Unserialize başarılı! Açılan veri aşağıda gösterildi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>serialize & unserialize Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:14px; border-radius:10px; margin-bottom:14px; }
        .satir { padding:6px 0; border-bottom:1px solid #1f2937; }
        .etiket { display:inline-block; min-width:260px; color:#93c5fd; }
        code, pre, textarea { background:#1f2937; color:#e2e8f0; padding:10px; border-radius:8px; }
        textarea { width:100%; height:90px; border:0; }
        button { padding:10px 14px; border:0; border-radius:8px; cursor:pointer; }
        .uyari { background:#7f1d1d; padding:10px; border-radius:8px; margin-top:10px; }
        .basari { background:#14532d; padding:10px; border-radius:8px; margin-top:10px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) serialize() Çıktıları</h2>

    <div class="satir"><span class="etiket">Kullanıcı dizisi (array):</span></div>
    <pre><?php print_r($kullanici); ?></pre>

    <div class="satir"><span class="etiket">serialize($kullanici):</span></div>
    <pre><?= htmlspecialchars($kullaniciSerialized) ?></pre>

    <hr>

    <div class="satir"><span class="etiket">Ürün nesnesi (object):</span></div>
    <pre><?php print_r($urun); ?></pre>

    <div class="satir"><span class="etiket">serialize($urun):</span></div>
    <pre><?= htmlspecialchars($urunSerialized) ?></pre>
</div>

<div class="kutu">
    <h2>2) unserialize() Sonuçları</h2>

    <div class="satir"><span class="etiket">unserialize($kullaniciSerialized):</span></div>
    <pre><?php print_r($kullaniciUnserialized); ?></pre>

    <div class="satir"><span class="etiket">unserialize($urunSerialized):</span></div>
    <pre><?php print_r($urunUnserialized); ?></pre>
</div>

<div class="kutu">
    <h2>3) Form ile unserialize Denemesi</h2>

    <!-- Form aynı sayfaya POST ile gönderilir -->
    <form method="POST">
        <!-- Kullanıcı buraya bir serialized string yapıştırabilir -->
        <textarea name="serialized" placeholder="Serialized string buraya..."><?= htmlspecialchars($gelenVeri) ?></textarea>

        <!-- Buton formu gönderir -->
        <button type="submit">Unserialize Et</button>
    </form>

    <?php if ($mesaj !== ""): ?>
        <?php
        /* Mesaj içeriğine göre basit bir başarı/hata rengi seçiyoruz */
        $sinif = (str_contains($mesaj, "başarılı") || str_contains($mesaj, "Başarılı")) ? "basari" : "uyari";
        ?>
        <div class="<?= $sinif ?>">
            <?= htmlspecialchars($mesaj) ?>
        </div>

        <?php
        /* Eğer kullanıcı bir şey gönderdi ve açıldıysa sonucu da gösterelim */
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $acilan = @unserialize($gelenVeri, ["allowed_classes" => false]);
            if (!($acilan === false && $gelenVeri !== serialize(false))) {
                echo "<h3>Açılan Veri:</h3>";
                echo "<pre>";
                print_r($acilan);
                echo "</pre>";
            }
        }
        ?>
    <?php endif; ?>
</div>

<div class="kutu">
    <h2>Notlar (Önemli)</h2>
    <div class="satir">✔ serialize() veriyi saklamak/taşımak için string yapar (session, cache, dosya vs.).</div>
    <div class="satir">⚠ Kullanıcıdan gelen veriye direkt unserialize() yapmak tehlikelidir.</div>
    <div class="satir">✅ Güvenlik için <code>allowed_classes</code> kullan veya mümkünse JSON tercih et.</div>
</div>

</body>
</html>
