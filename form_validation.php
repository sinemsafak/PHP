<?php
/***************************************************************
 * PHP FORM DOĞRULAMA (VALIDATION) - TEK SAYFA DEMO
 * - Boş alan kontrolü
 * - Email format kontrolü
 * - Uzunluk kontrolü
 * - Güvenlik (XSS)
 ***************************************************************/

/* Türkçe karakter sorunu olmaması için sayfa charset ayarı */
header("Content-Type: text/html; charset=UTF-8");

/* Hata mesajlarını dizi olarak tutacağız */
$hatalar = [];

/* Formdan gelen değerleri tutacak değişkenler */
$ad = "";
$email = "";
$sifre = "";

/*
 Form gönderildi mi kontrolü
 Eğer method POST ise kullanıcı submit etmiştir
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
     $_POST ile formdan gelen ham verileri alıyoruz
     ?? '' → yoksa boş string ata
    */
    $ad = $_POST["ad"] ?? '';
    $email = $_POST["email"] ?? '';
    $sifre = $_POST["sifre"] ?? '';

    /*
     trim() → baştaki ve sondaki boşlukları siler
     htmlspecialchars → XSS saldırılarını engeller
    */
    $ad = trim($ad);
    $email = trim($email);
    $sifre = trim($sifre);

    /* ---------- DOĞRULAMA KURALLARI ---------- */

    // Ad boş mu?
    if (empty($ad)) {
        $hatalar[] = "Ad alanı boş bırakılamaz.";
    }

    // Email boş mu?
    if (empty($email)) {
        $hatalar[] = "Email alanı boş bırakılamaz.";
    }
    // Email formatı doğru mu?
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hatalar[] = "Geçerli bir email adresi giriniz.";
    }

    // Şifre boş mu?
    if (empty($sifre)) {
        $hatalar[] = "Şifre alanı boş bırakılamaz.";
    }
    // Şifre uzunluğu en az 6 karakter mi?
    elseif (strlen($sifre) < 6) {
        $hatalar[] = "Şifre en az 6 karakter olmalıdır.";
    }

    /*
     Eğer hata yoksa (dizi boşsa)
     form başarıyla doğrulanmıştır
    */
    if (empty($hatalar)) {
        /*
         Gerçek projede burada:
         - DB kayıt
         - password_hash
         - mail gönderme
         yapılır
        */
        $basarili = true;

        // Başarılı olunca alanları temizleyelim
        $ad = "";
        $email = "";
        $sifre = "";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Form Doğrulama</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:20px; border-radius:10px; width:400px; margin:auto; }
        input { width:100%; padding:10px; margin-bottom:10px; border:0; border-radius:6px; }
        button { width:100%; padding:10px; border:0; border-radius:6px; cursor:pointer; }
        .hata { background:#7f1d1d; padding:10px; border-radius:6px; margin-top:10px; }
        .basari { background:#14532d; padding:10px; border-radius:6px; margin-top:10px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>Kayıt Formu</h2>

    <!-- Form aynı sayfaya POST ile gönderilir -->
    <form method="POST">

        <!-- Ad alanı -->
        <input type="text" name="ad" placeholder="Adınız"
               value="<?= htmlspecialchars($ad) ?>">

        <!-- Email alanı -->
        <input type="email" name="email" placeholder="Email"
               value="<?= htmlspecialchars($email) ?>">

        <!-- Şifre alanı -->
        <input type="password" name="sifre" placeholder="Şifre">

        <!-- Formu gönderen buton -->
        <button type="submit">Kaydol</button>
    </form>

    <?php
    /* Eğer hatalar varsa hepsini liste olarak göster */
    if (!empty($hatalar)) {
        echo '<div class="hata"><ul>';
        foreach ($hatalar as $hata) {
            echo '<li>'.$hata.'</li>';
        }
        echo '</ul></div>';
    }

    /* Eğer başarılıysa mesaj göster */
    if (!empty($basarili)) {
        echo '<div class="basari">Form başarıyla doğrulandı ve gönderildi!</div>';
    }
    ?>
</div>

</body>
</html>
