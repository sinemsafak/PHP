<?php
/************************************************************
 * PHP Regex Konum Belirleyicileri Demo
 * ^  $  \b  \B  (?=)  (?!)
 ************************************************************/

/*
 ----------------------------------------------------------
 Örnek metin
 ----------------------------------------------------------
*/
$metin = "PHP regex öğreniyoruz 2025";

/*
 ----------------------------------------------------------
 ^ → Metin başlangıcı kontrolü
 ----------------------------------------------------------
*/
$baslangic = preg_match("/^PHP/", $metin);

/*
 ----------------------------------------------------------
 $ → Metin bitiş kontrolü
 ----------------------------------------------------------
*/
$bitis = preg_match("/2025$/", $metin);

/*
 ----------------------------------------------------------
 \b → Kelime sınırı
 ----------------------------------------------------------
*/
$kelimeSiniri = preg_match("/\bregex\b/", $metin);

/*
 ----------------------------------------------------------
 \B → Kelime sınırı olmayan yer
 ----------------------------------------------------------
*/
$kelimeDisi = preg_match("/HP\B/", $metin);

/*
 ----------------------------------------------------------
 (?=) → Pozitif lookahead
 "regex" kelimesinden sonra boşluk var mı?
 ----------------------------------------------------------
*/
$pozitifLookahead = preg_match("/regex(?=\s)/", $metin);

/*
 ----------------------------------------------------------
 (?! ) → Negatif lookahead
 "PHP" kelimesinden sonra sayı gelmiyor mu?
 ----------------------------------------------------------
*/
$negatifLookahead = preg_match("/PHP(?!\d)/", $metin);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Regex Konum Belirleyicileri</title>
<style>
body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
.kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
</style>
</head>

<body>

<div class="kutu">
<h2>Metin</h2>
<p><?= $metin ?></p>
</div>

<div class="kutu"><b>^ başlangıç:</b> <?= $baslangic ? "Eşleşti" : "Eşleşmedi" ?></div>

<div class="kutu"><b>$ bitiş:</b> <?= $bitis ? "Eşleşti" : "Eşleşmedi" ?></div>

<div class="kutu"><b>\b kelime sınırı:</b> <?= $kelimeSiniri ? "Bulundu" : "Bulunamadı" ?></div>

<div class="kutu"><b>\B kelime dışı:</b> <?= $kelimeDisi ? "Bulundu" : "Bulunamadı" ?></div>

<div class="kutu"><b>(?=) pozitif lookahead:</b> <?= $pozitifLookahead ? "Şart sağlandı" : "Sağlanmadı" ?></div>

<div class="kutu"><b>(?! ) negatif lookahead:</b> <?= $negatifLookahead ? "Şart sağlandı" : "Sağlanmadı" ?></div>

</body>
</html>
