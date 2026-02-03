<?php
/***************************************************************
 * PHP Formlarla Çoklu Veri Gönderimi (Tek Sayfa)
 * - checkbox[] (çoklu seçim)
 * - select multiple (çoklu seçim)
 * - aynı isimle çoklu input (telefon[])
 * - dinamik input ekleme (hobi[])
 * - dosya yükleme (attachments[])
 ***************************************************************/

/* Sayfada göstermek için mesaj değişkenleri */
$hata = "";        // Hata mesajını tutar
$sonuc = [];       // Gönderilen verileri düzenli göstermek için dizi

/* Form POST ile gönderildiyse bu blok çalışır */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ---------------------------
       1) Tekil alanlar (ad, email)
       --------------------------- */

    /* $_POST'tan veri alma, yoksa boş string ata */
    $ad    = $_POST["ad"]    ?? "";  // ad alanı
    $email = $_POST["email"] ?? "";  // email alanı

    /* trim: baştaki/sondaki boşlukları temizler */
    $ad    = trim($ad);              // ad temizlendi
    $email = trim($email);           // email temizlendi

    /* Basit doğrulama: ad boş mu? */
    if ($ad === "") {
        $hata = "Ad alanı boş bırakılamaz.";
    }
    /* Basit doğrulama: email formatı doğru mu? */
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hata = "Lütfen geçerli bir e-posta girin.";
    }

    /* Hata yoksa çoklu alanları işle */
    if ($hata === "") {

        /* ---------------------------------------
           2) Checkbox ile çoklu seçim: ilgi[] 
           --------------------------------------- */

        /* Checkbox'lar aynı isimle gönderilir: ilgi[] => dizi gelir */
        $ilgi = $_POST["ilgi"] ?? [];                     // seçilmediyse boş dizi
        $ilgi = array_map("trim", (array)$ilgi);          // hepsini trimle
        $ilgi = array_filter($ilgi, fn($v) => $v !== ""); // boşları temizle

        /* ---------------------------------------
           3) Select multiple: sehirler[]
           --------------------------------------- */

        /* <select multiple name="sehirler[]"> => dizi gelir */
        $sehirler = $_POST["sehirler"] ?? [];                     // boşsa []
        $sehirler = array_map("trim", (array)$sehirler);           // temizle
        $sehirler = array_filter($sehirler, fn($v) => $v !== "");  // boşları at

        /* ---------------------------------------
           4) Aynı isimle çoklu input: telefon[]
           --------------------------------------- */

        /* Birden fazla telefon alanı aynı isimle gönderilir: telefon[] */
        $telefonlar = $_POST["telefon"] ?? [];                            // dizi al
        $telefonlar = array_map("trim", (array)$telefonlar);              // temizle
        $telefonlar = array_filter($telefonlar, fn($v) => $v !== "");     // boşları sil

        /* ---------------------------------------
           5) Dinamik input (JS ile eklenen): hobi[]
           --------------------------------------- */

        /* JS ile yeni input eklenince hobi[] dizisi büyür */
        $hobiler = $_POST["hobi"] ?? [];                                  // dizi al
        $hobiler = array_map("trim", (array)$hobiler);                    // temizle
        $hobiler = array_filter($hobiler, fn($v) => $v !== "");           // boşları sil

        /* ---------------------------------------
           6) Çoklu dosya yükleme: attachments[]
           --------------------------------------- */

        /* Dosyalar $_FILES içinde tutulur; attachments[] çoklu dosya için */
        $yuklenenDosyalar = []; // ekranda göstermek için dosya adlarını tutacağız

        /* attachments alanı geldiyse (en az bir dosya seçildiyse) */
        if (!empty($_FILES["attachments"]) && is_array($_FILES["attachments"]["name"])) {

            /* Dosya sayısı: name dizisinin uzunluğudur */
            $dosyaSayisi = count($_FILES["attachments"]["name"]);

            /* Tek tek dosyaları dolaş */
            for ($i = 0; $i < $dosyaSayisi; $i++) {

                /* İlgili dosyanın hata kodu */
                $err = $_FILES["attachments"]["error"][$i];

                /* UPLOAD_ERR_NO_FILE: dosya seçilmemiş demektir */
                if ($err === UPLOAD_ERR_NO_FILE) {
                    continue; // bunu atla
                }

                /* Başarılı yükleme mi? */
                if ($err === UPLOAD_ERR_OK) {

                    /* Orijinal dosya adı (güvenli göstermek için htmlspecialchars sonra basacağız) */
                    $orjAd = $_FILES["attachments"]["name"][$i];

                    /* Geçici dosya yolu (PHP yükleme alanı) */
                    $tmpYol = $_FILES["attachments"]["tmp_name"][$i];

                    /* Boyut kontrolü (örnek): 2MB */
                    $boyut = $_FILES["attachments"]["size"][$i];
                    if ($boyut > 2 * 1024 * 1024) {
                        $yuklenenDosyalar[] = "$orjAd (HATA: 2MB üstü)";
                        continue;
                    }

                    /* Yükleme klasörü (bu dosyanın yanında uploads/ olsun) */
                    $hedefKlasor = __DIR__ . "/uploads";           // fiziksel yol
                    if (!is_dir($hedefKlasor)) {                   // klasör yoksa
                        mkdir($hedefKlasor, 0777, true);           // oluştur
                    }

                    /* Dosya adını güvenli hale getir (çok basit örnek) */
                    $temizAd = preg_replace("/[^a-zA-Z0-9._-]/", "_", $orjAd);

                    /* Çakışma olmasın diye başına uniqid ekle */
                    $hedefYol = $hedefKlasor . "/" . uniqid("f_", true) . "_" . $temizAd;

                    /* Dosyayı geçiciden hedefe taşı */
                    if (move_uploaded_file($tmpYol, $hedefYol)) {
                        $yuklenenDosyalar[] = $orjAd . " (Yüklendi)";
                    } else {
                        $yuklenenDosyalar[] = $orjAd . " (HATA: Taşınamadı)";
                    }
                } else {
                    /* Diğer hata durumları */
                    $yuklenenDosyalar[] = $_FILES["attachments"]["name"][$i] . " (HATA KODU: $err)";
                }
            }
        }

        /* ---------------------------------------
           7) Sonuçları ekranda göstermek için topla
           --------------------------------------- */

        $sonuc = [
            "Ad" => $ad,
            "E-posta" => $email,
            "İlgi Alanları (checkbox[])" => $ilgi,
            "Şehirler (select multiple)" => $sehirler,
            "Telefonlar (telefon[])" => $telefonlar,
            "Hobiler (hobi[])" => $hobiler,
            "Yüklenen Dosyalar (attachments[])" => $yuklenenDosyalar
        ];
    }
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Çoklu Veri Gönderimi - Tek Sayfa</title>
    <style>
        body{font-family:Arial;background:#0f172a;color:#e2e8f0;padding:20px}
        .kutu{max-width:820px;margin:auto;background:#111827;padding:16px;border-radius:10px}
        label{display:block;margin-top:10px}
        input,select{width:100%;padding:8px;margin-top:6px;border-radius:6px;border:1px solid #334155;background:#0b1220;color:#e2e8f0}
        .satir{display:flex;gap:10px}
        .satir > div{flex:1}
        .mini{display:flex;gap:10px;flex-wrap:wrap;margin-top:6px}
        .mini label{display:flex;gap:6px;align-items:center;margin:0}
        button{margin-top:12px;padding:10px 14px;border:0;border-radius:8px;cursor:pointer}
        .btn{background:#2563eb;color:#fff}
        .btn2{background:#334155;color:#fff}
        .hata{background:#7f1d1d;padding:10px;border-radius:8px;margin-top:12px}
        .basari{background:#064e3b;padding:10px;border-radius:8px;margin-top:12px}
        pre{white-space:pre-wrap;background:#0b1220;padding:10px;border-radius:8px;border:1px solid #334155}
    </style>
</head>
<body>
<div class="kutu">
    <h2>Formlarla Çoklu Veri Gönderimi</h2>

    <!-- enctype="multipart/form-data" dosya upload için şart -->
    <form method="POST" enctype="multipart/form-data">

        <div class="satir">
            <div>
                <!-- Tekil input -->
                <label>Ad Soyad</label>
                <input type="text" name="ad" placeholder="Örn: Ahmet Yılmaz"
                       value="<?= htmlspecialchars($_POST["ad"] ?? "") ?>">
            </div>

            <div>
                <!-- Tekil input -->
                <label>E-posta</label>
                <input type="email" name="email" placeholder="ornek@mail.com"
                       value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
        </div>

        <!-- Checkbox ile çoklu veri -->
        <label>İlgi Alanları (checkbox[])</label>
        <div class="mini">
            <label><input type="checkbox" name="ilgi[]" value="php"> PHP</label>
            <label><input type="checkbox" name="ilgi[]" value="javascript"> JavaScript</label>
            <label><input type="checkbox" name="ilgi[]" value="mysql"> MySQL</label>
            <label><input type="checkbox" name="ilgi[]" value="linux"> Linux</label>
        </div>

        <!-- Select multiple ile çoklu veri -->
        <label>Şehirler (select multiple)</label>
        <select name="sehirler[]" multiple size="4">
            <option value="istanbul">İstanbul</option>
            <option value="ankara">Ankara</option>
            <option value="izmir">İzmir</option>
            <option value="bursa">Bursa</option>
        </select>

        <!-- Aynı isimle çoklu input -->
        <label>Telefonlar (telefon[])</label>
        <div class="satir">
            <div><input type="text" name="telefon[]" placeholder="Telefon 1"></div>
            <div><input type="text" name="telefon[]" placeholder="Telefon 2"></div>
            <div><input type="text" name="telefon[]" placeholder="Telefon 3"></div>
        </div>

        <!-- Dinamik olarak input ekleme alanı -->
        <label>Hobiler (hobi[]) - “Hobi Ekle” ile çoğalır</label>
        <div id="hobiAlan">
            <input type="text" name="hobi[]" placeholder="Örn: Kitap okumak">
        </div>

        <!-- JS ile yeni hobi input'u ekleyen buton -->
        <button type="button" class="btn2" onclick="hobiEkle()">Hobi Ekle</button>

        <!-- Çoklu dosya yükleme -->
        <label>Ek Dosyalar (attachments[])</label>
        <input type="file" name="attachments[]" multiple>

        <!-- Form gönderme -->
        <button type="submit" class="btn">Gönder</button>
    </form>

    <?php if ($hata !== ""): ?>
        <!-- Hata mesajı -->
        <div class="hata"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>

    <?php if (!empty($sonuc)): ?>
        <!-- Sonuç gösterimi -->
        <div class="basari">
            <strong>Gönderim başarılı! Gelen veriler:</strong>
            <pre><?php
                /* print_r ile diziyi okunur şekilde yazdır */
                print_r($sonuc);
            ?></pre>
        </div>
    <?php endif; ?>
</div>

<script>
/* Hobi ekleme fonksiyonu: formu büyütür, hobi[] dizisine yeni eleman eklenir */
function hobiEkle() {
    // hobi alanını tutan div'i seç
    const alan = document.getElementById('hobiAlan');

    // yeni input oluştur
    const input = document.createElement('input');
    input.type = 'text';          // metin alanı
    input.name = 'hobi[]';        // aynı isim => PHP tarafında dizi gelir
    input.placeholder = 'Yeni hobi';

    // input'u alana ekle
    alan.appendChild(input);
}
</script>
</body>
</html>
