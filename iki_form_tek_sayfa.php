<?php
/**************************************************************
 * İKİ FORM - VERİYİ BİRLİKTE ÇEKME (SESSION ile)
 * Tek sayfa, yorum satırlarıyla açıklamalı örnek
 **************************************************************/

session_start(); // Oturum başlatır; form verilerini sayfalar arası saklamak için gerekir

$mesaj = "";     // Ekranda gösterilecek bilgilendirme mesajı
$hata  = "";     // Ekranda gösterilecek hata mesajı

// "Sıfırla" butonuna basıldıysa (GET ile ?reset=1 gönderiyoruz)
if (isset($_GET["reset"])) {          // URL'de reset parametresi var mı kontrol eder
    unset($_SESSION["form1"]);        // Form1 verilerini oturumdan siler
    unset($_SESSION["form2"]);        // Form2 verilerini oturumdan siler
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // Sayfayı temiz URL ile yeniler
    exit;                             // Yönlendirmeden sonra kodun devam etmesini engeller
}

// Form gönderildi mi? (POST geldiyse gönderilmiştir)
if ($_SERVER["REQUEST_METHOD"] === "POST") { // İstek yöntemi POST mu kontrol eder

    // Hangi form gönderildiğini anlamak için gizli alanı okuyoruz
    $formId = $_POST["form_id"] ?? ""; // form_id yoksa boş string ata

    // 1. FORM gönderildiyse
    if ($formId === "form1") { // form_id "form1" mi?

        $adSoyad = trim($_POST["adsoyad"] ?? ""); // Kullanıcı adını alır, boşlukları temizler
        $yas     = trim($_POST["yas"] ?? "");     // Yaş bilgisini alır, boşlukları temizler

        // Basit doğrulama (boş mu?)
        if ($adSoyad === "" || $yas === "") { // Alanlardan biri boşsa
            $hata = "Form-1: Ad Soyad ve Yaş alanları boş bırakılamaz!";
        } else {
            // Verileri SESSION'a kaydediyoruz (aynı anda çekme mantığı için)
            $_SESSION["form1"] = [               // form1 anahtarına dizi kaydeder
                "adsoyad" => $adSoyad,           // adsoyad değerini saklar
                "yas"     => $yas                // yas değerini saklar
            ];
            $mesaj = "Form-1 kaydedildi. Şimdi Form-2'yi doldurun.";
        }
    }

    // 2. FORM gönderildiyse
    elseif ($formId === "form2") { // form_id "form2" mi?

        $email = trim($_POST["email"] ?? ""); // Email'i alır, boşlukları temizler
        $sehir = trim($_POST["sehir"] ?? ""); // Şehri alır, boşlukları temizler

        // Basit doğrulama (boş mu?)
        if ($email === "" || $sehir === "") { // Alanlardan biri boşsa
            $hata = "Form-2: E-posta ve Şehir alanları boş bırakılamaz!";
        } else {
            // Verileri SESSION'a kaydediyoruz
            $_SESSION["form2"] = [              // form2 anahtarına dizi kaydeder
                "email" => $email,              // email değerini saklar
                "sehir" => $sehir               // sehir değerini saklar
            ];
            $mesaj = "Form-2 kaydedildi. Eğer Form-1 de doluysa birlikte göstereceğim.";
        }
    }
}

// İki formun verisi de var mı? (İşte “aynı anda çekme” sonucu burada)
$ikiFormHazirMi = isset($_SESSION["form1"]) && isset($_SESSION["form2"]); // İkisi de set mi?

// XSS güvenliği için ekrana basmadan önce kaçış fonksiyonu
function e($str) { // Güvenli çıktı fonksiyonu tanımlar
    return htmlspecialchars((string)$str, ENT_QUOTES, "UTF-8"); // HTML özel karakterlerini kaçırır
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İki Form - Veriyi Birlikte Çekme</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .row { display:flex; gap:16px; flex-wrap:wrap; }
        .box { background:#111827; border-radius:10px; padding:16px; flex:1; min-width:280px; }
        input { width:100%; padding:10px; border-radius:8px; border:1px solid #1f2937; background:#0b1220; color:#e2e8f0; margin:8px 0; }
        button, a.btn { display:inline-block; padding:10px 12px; border-radius:8px; border:none; cursor:pointer; background:#2563eb; color:white; text-decoration:none; }
        a.btn { background:#475569; }
        .msg { background:#064e3b; padding:10px; border-radius:8px; margin-bottom:12px; }
        .err { background:#7f1d1d; padding:10px; border-radius:8px; margin-bottom:12px; }
        code { background:#1f2937; padding:2px 6px; border-radius:6px; }
        .result { background:#0b1220; border:1px solid #1f2937; border-radius:10px; padding:12px; margin-top:16px; }
    </style>
</head>
<body>

<h2>İki Formdan Veriyi Birlikte Çekme (SESSION)</h2>

<?php if ($mesaj !== ""): ?> <!-- Mesaj varsa göster -->
    <div class="msg"><?= e($mesaj) ?></div>
<?php endif; ?>

<?php if ($hata !== ""): ?> <!-- Hata varsa göster -->
    <div class="err"><?= e($hata) ?></div>
<?php endif; ?>

<div class="row">

    <!-- 1. FORM -->
    <div class="box">
        <h3>Form-1 (Kişisel Bilgi)</h3>

        <!-- action boş: aynı sayfaya gönderir; method POST -->
        <form method="POST">
            <!-- Hangi formun gönderildiğini anlamak için gizli alan -->
            <input type="hidden" name="form_id" value="form1">

            <label>Ad Soyad</label>
            <input type="text" name="adsoyad" placeholder="Örn: Fehmi Uyar">

            <label>Yaş</label>
            <input type="number" name="yas" placeholder="Örn: 25">

            <button type="submit">Form-1 Gönder</button>
        </form>

        <p>
            Kayıt durumu:
            <code><?= isset($_SESSION["form1"]) ? "DOLU" : "BOŞ" ?></code>
        </p>
    </div>

    <!-- 2. FORM -->
    <div class="box">
        <h3>Form-2 (İletişim Bilgi)</h3>

        <form method="POST">
            <input type="hidden" name="form_id" value="form2">

            <label>E-posta</label>
            <input type="email" name="email" placeholder="Örn: test@mail.com">

            <label>Şehir</label>
            <input type="text" name="sehir" placeholder="Örn: İstanbul">

            <button type="submit">Form-2 Gönder</button>
        </form>

        <p>
            Kayıt durumu:
            <code><?= isset($_SESSION["form2"]) ? "DOLU" : "BOŞ" ?></code>
        </p>
    </div>

</div>

<!-- İki form verisi de geldiyse birlikte (aynı ekranda) göster -->
<?php if ($ikiFormHazirMi): ?>
    <div class="result">
        <h3>✅ İki Form Verisi Birlikte (Aynı Anda Çekilmiş Gibi)</h3>

        <p><strong>Ad Soyad:</strong> <?= e($_SESSION["form1"]["adsoyad"]) ?></p>
        <p><strong>Yaş:</strong> <?= e($_SESSION["form1"]["yas"]) ?></p>
        <p><strong>E-posta:</strong> <?= e($_SESSION["form2"]["email"]) ?></p>
        <p><strong>Şehir:</strong> <?= e($_SESSION["form2"]["sehir"]) ?></p>

        <!-- Sıfırlamak için link (GET ile reset) -->
        <a class="btn" href="?reset=1">Verileri Sıfırla</a>
    </div>
<?php else: ?>
    <div class="result">
        <h3>ℹ️ Birlikte göstermek için</h3>
        <p>İki formu da gönderin. Veriler <code>$_SESSION</code> içinde tutulur, ikisi de dolunca birlikte gösterilir.</p>
        <a class="btn" href="?reset=1">Temizle / Baştan Başla</a>
    </div>
<?php endif; ?>

</body>
</html>
