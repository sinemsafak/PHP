<?php
/************************************************************
 * PHP Regex Nicelik Belirleyiciler Demo
 * {n} {n,} {n,m} + * ?
 ************************************************************/

/*
 ----------------------------------------------------------
 Test metni
 ----------------------------------------------------------
*/
$metin = "aaaa aa a 12345 abbb";

/*
 ----------------------------------------------------------
 {4} → tam 4 adet 'a'
 ----------------------------------------------------------
*/
$eslesme1 = preg_match("/a{4}/", $metin);

/*
 ----------------------------------------------------------
 {2,} → en az 2 adet 'a'
 ----------------------------------------------------------
*/
$eslesme2 = preg_match("/a{2,}/", $metin);

/*
 ----------------------------------------------------------
 {2,3} → 2 ile 3 arası 'a'
 ----------------------------------------------------------
*/
$eslesme3 = preg_match("/a{2,3}/", $metin);

/*
 ----------------------------------------------------------
 + → en az 1 tekrar
 ----------------------------------------------------------
*/
$eslesme4 = preg_match("/a+/", $metin);

/*
 ----------------------------------------------------------
 * → 0 veya daha fazla tekrar
 ----------------------------------------------------------
*/
$eslesme5 = preg_match("/b*/", $metin);

/*
 ----------------------------------------------------------
 ? → 0 veya 1 tekrar
 ----------------------------------------------------------
*/
$eslesme6 = preg_match("/ab?/", $metin);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Regex Nicelik Belirleyiciler</title>
<style>
body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
.kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
</style>
</head>

<body>

<div class="kutu">
<h2>Test Metni</h2>
<p><?= $metin ?></p>
</div>

<div class="kutu">{4} → <?= $eslesme1 ? "Bulundu" : "Yok" ?></div>
<div class="kutu">{2,} → <?= $eslesme2 ? "Bulundu" : "Yok" ?></div>
<div class="kutu">{2,3} → <?= $eslesme3 ? "Bulundu" : "Yok" ?></div>
<div class="kutu">+ → <?= $eslesme4 ? "Bulundu" : "Yok" ?></div>
<div class="kutu">* → <?= $eslesme5 ? "Bulundu" : "Yok" ?></div>
<div class="kutu">? → <?= $eslesme6 ? "Bulundu" : "Yok" ?></div>

</body>
</html>
