<?php
/***************************************************************
 * PHP FORM KULLANIMI - TEK SAYFA DEMO
 * GET / POST / Validation / Güvenlik
 ***************************************************************/

/* Sayfanın karakter setini ayarlıyoruz (Türkçe sorun olmasın diye) */
header("Content-Type: text/html; charset=UTF-8");

/* Hata ve başarı mesajlarını tutacak değişkenler */
$hata = "";
$basari = "";

/* Formdan gelen verileri saklamak için değişkenler */
$ad = "";
$email = "";
$mesaj = "";

/*
 Form gönderilmiş mi kontrolü
 Eğer method POST ise form submit edilmiştir
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
     $_POST dizisi ile formdan gelen verileri alıyoruz
     ?? '' → Eğer değer yoksa boş string ata
    */
    $ad = $_POST["ad"] ?? '';
    $email = $_POST["email"] ?? '';
    $mesaj = $_POST["mesaj"] ?? '';

    /*
     trim() → baştaki ve sondaki boşlukları siler
     empty() → alan boş mu kontrol eder
    */

    // Ad alanı boş mu?
    if (empty(trim($ad))) {
        $hata = "Ad alanı boş bırakılamaz!";
    }
    // Email alanı boş mu?
    elseif (empty(trim($email))) {
        $hata = "Email alanı boş bırakılamaz!";
    }
    // Mesaj alanı boş mu?
    elseif (empty(trim($mesaj))) {
        $hata = "Mesaj alanı boş bırakılamaz!";
    }
    else {
        /*
         Normalde burada:
         - Veritabanına kayıt
         - Mail gönderme
         - Log alma
         yapılır.
         Şimdilik sadece başarılı mesaj gösteriyoruz.
        */
        $basari = "Form başarıyla gönderildi!";

        /* Gönderim sonrası alanları temizliyoruz */
        $ad = "";
        $email = "";
        $mesaj = "";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Form Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:20px; border-radius:10px; width:400px; margin:auto; }
        input, textarea { width:100%; padding:10px; margin-bottom:10px; border:0; border-radius:6px; }
        button { padding:10px; width:100%; border:0; border-radius:6px; cursor:pointer; }
        .hata { background:#7f1d1d; padding:10px; border-radius:6px; margin-top:10px; }
        .basari { background:#14532d; padding:10px; border-radius:6px; margin-top:10px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>İletişim Formu</h2>

    <!-- Form aynı sayfaya POST ile gönderiliyor -->
    <form method="POST">

        <!-- Ad alanı -->
        <input type="text" name="ad" placeholder="Adınız"
               value="<?= htmlspecialchars($ad) ?>">
        <!--
         htmlspecialchars:
         XSS saldırılarını engeller
         Kullanıcının yazdığı HTML kodu çalışmaz
        -->

        <!-- Email alanı -->
        <input type="email" name="email" placeholder="Email"
               value="<?= htmlspecialchars($email) ?>">

        <!-- Mesaj alanı -->
        <textarea name="mesaj" placeholder="Mesajınız"><?= htmlspecialchars($mesaj) ?></textarea>

        <!-- Formu gönderen buton -->
        <button type="submit">Gönder</button>
    </form>

    <?php
    /* Hata varsa göster */
    if (!empty($hata)) {
        echo '<div class="hata">'.$hata.'</div>';
    }

    /* Başarı varsa göster */
    if (!empty($basari)) {
        echo '<div class="basari">'.$basari.'</div>';
    }
    ?>
</div>

</body>
</html>
