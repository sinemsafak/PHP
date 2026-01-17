<?php
/************************************************************
 * PHP Mail & Şifre Formu - Tek Sayfa POST Kontrolü
 * Boş alan kontrolü + başarı mesajı
 ************************************************************/

/*
 Formdan gelen hata ve başarı mesajlarını
 sayfa içinde göstermek için değişkenler tanımlıyoruz
*/
$hata = "";
$basari = "";

/*
 Form gönderilmiş mi diye kontrol ediyoruz
 $_SERVER["REQUEST_METHOD"] POST ise form submit edilmiştir
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*
     Formdan gelen mail ve şifre verilerini alıyoruz
     ?? '' ifadesi: Değer yoksa boş string ata demektir
    */
    $mail = $_POST["mail"] ?? '';
    $sifre = $_POST["sifre"] ?? '';

    /*
     trim() → baştaki ve sondaki boşlukları temizler
     empty() → değişken boş mu kontrol eder
    */

    // Mail alanı boş mu kontrolü
    if (empty(trim($mail))) {
        $hata = "Mail alanı boş bırakılamaz!";
    }
    // Şifre alanı boş mu kontrolü
    elseif (empty(trim($sifre))) {
        $hata = "Şifre alanı boş bırakılamaz!";
    }
    else {
        /*
         Buraya normalde veritabanına kayıt işlemi yazılır
         Şimdilik sadece başarılı mesajı gösteriyoruz
        */
        $basari = "Başarıyla kaydoldunuz: " . htmlspecialchars($mail);
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Formu</title>
    <style>
        body { background:#111; font-family:Arial; }
        .kutu {
            width:400px;
            margin:100px auto;
            background:#1e1e1e;
            padding:25px;
            border-radius:8px;
            color:#fff;
        }
        input {
            width:100%;
            padding:10px;
            margin-bottom:10px;
            border:none;
            border-radius:4px;
        }
        button {
            background:#0d6efd;
            border:none;
            padding:10px;
            width:100%;
            color:#fff;
            border-radius:4px;
            cursor:pointer;
        }
        .hata { background:#842029; padding:10px; margin-top:10px; }
        .basari { background:#0f5132; padding:10px; margin-top:10px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>Kayıt Ol</h2>

    <!-- Form verileri aynı sayfaya gönderilir -->
    <form method="POST">

        <!-- Mail girişi -->
        <input type="email" name="mail" placeholder="Mail adresiniz">

        <!-- Şifre girişi -->
        <input type="password" name="sifre" placeholder="Şifreniz">

        <!-- Formu gönderen buton -->
        <button type="submit">Gönder</button>
    </form>

    <?php
    /*
     Eğer hata mesajı varsa ekranda göster
    */
    if (!empty($hata)) {
        echo '<div class="hata">' . $hata . '</div>';
    }

    /*
     Eğer başarı mesajı varsa ekranda göster
    */
    if (!empty($basari)) {
        echo '<div class="basari">' . $basari . '</div>';
    }
    ?>
</div>

</body>
</html>
