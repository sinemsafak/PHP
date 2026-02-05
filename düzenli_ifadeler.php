<?php
/**************************************************************
 * PHP REGULAR EXPRESSIONS (REGEX) DEMO
 * Tek sayfalık, açıklamalı örnek
 **************************************************************/

/*
 Regex test edeceğimiz örnek metin
*/
$metin = "Ahmet 25 yaşında. Email: ahmet123@gmail.com";

/* ============================================================
   1) preg_match → eşleşme kontrolü
   ============================================================ */

/*
 \d+ → bir veya daha fazla rakam
 i → büyük/küçük harf duyarsız
*/
preg_match("/\d+/i", $metin, $yas); // İlk sayıyı bulur

/* ============================================================
   2) preg_match_all → tüm eşleşmeleri bulma
   ============================================================ */

/*
 \w+ → kelimeleri bulur
*/
preg_match_all("/\w+/u", $metin, $kelimeler);

/* ============================================================
   3) preg_replace → değiştirme
   ============================================================ */

/*
 Sayıları yıldız ile değiştir
*/
$degistirilmis = preg_replace("/\d+/", "***", $metin);

/* ============================================================
   4) preg_split → parçalama
   ============================================================ */

/*
 Boşluklara göre böl
*/
$parcalar = preg_split("/\s+/", $metin);

/* ============================================================
   5) preg_grep → filtreleme
   ============================================================ */

/*
 Sadece rakam içeren parçaları seç
*/
$dizi = ["abc", "123", "php7", "456"];
$filtre = preg_grep("/\d+/", $dizi);

/* ============================================================
   Regex ayar örnekleri
   ============================================================ */

/*
 i → büyük/küçük harf duyarsız
*/
$buyukKucuk = preg_match("/ahmet/i", $metin);

/*
 s → çok satırlı kontrol
*/
$cokSatir = preg_match("/Ahmet.*gmail/s", $metin);

/*
 u → UTF-8 karakter desteği
*/
$utf8 = preg_match("/yaş/u", $metin);

/*
 x → boşlukları yok sayar
*/
$regexX = preg_match("/ A h m e t /x", $metin);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>PHP Regex Demo</title>
<style>
body {font-family:Arial;background:#0f172a;color:white;padding:20px}
.kutu {background:#1e293b;padding:15px;margin-bottom:15px;border-radius:8px}
</style>
</head>
<body>

<h2>PHP Regular Expressions Demo</h2>

<div class="kutu">
<b>preg_match → İlk sayı:</b><br>
<?= $yas[0] ?? "Bulunamadı" ?>
</div>

<div class="kutu">
<b>preg_match_all → Kelimeler:</b><br>
<?= implode(", ", $kelimeler[0]) ?>
</div>

<div class="kutu">
<b>preg_replace → Sayılar gizlendi:</b><br>
<?= $degistirilmis ?>
</div>

<div class="kutu">
<b>preg_split → Parçalar:</b><br>
<?= implode(" | ", $parcalar) ?>
</div>

<div class="kutu">
<b>preg_grep → Rakam içerenler:</b><br>
<?= implode(", ", $filtre) ?>
</div>

<div class="kutu">
<b>Regex Ayar Kontrolleri:</b><br>
i → <?= $buyukKucuk ? "eşleşti" : "eşleşmedi" ?><br>
s → <?= $cokSatir ? "eşleşti" : "eşleşmedi" ?><br>
u → <?= $utf8 ? "eşleşti" : "eşleşmedi" ?><br>
x → <?= $regexX ? "eşleşti" : "eşleşmedi" ?>
</div>

</body>
</html>
