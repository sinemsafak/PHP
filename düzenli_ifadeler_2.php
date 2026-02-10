<?php
/***********************************************************
 * PHP Regex Demo
 * preg_grep() ve preg_quote() kullanımı
 ***********************************************************/

/*
 ----------------------------------------------------------
 1) Örnek dizi oluşturuyoruz
 ----------------------------------------------------------
*/
$kelimeler = [
    "php",
    "python",
    "java",
    "php regex",
    "php ders",
    "c++",
    "node.js"
];

/*
 ----------------------------------------------------------
 2) preg_grep() — regex ile filtreleme
 ----------------------------------------------------------

 /^php/  → php ile başlayan kelimeleri bulur
*/
$phpIleBaslayanlar = preg_grep('/^php/', $kelimeler);

/*
 ----------------------------------------------------------
 3) preg_quote() — özel karakterleri güvenli hale getirir
 ----------------------------------------------------------

 Regex içinde + . gibi karakterler özeldir.
 Kullanıcıdan gelen veri regex’i bozabilir.

 preg_quote bunu engeller.
*/
$kullaniciGirdisi = "c++";

/*
 Regex güvenliği için kaçış yapıyoruz
*/
$guvenliPattern = preg_quote($kullaniciGirdisi, '/');

/*
 Kaçış sonrası arama yapıyoruz
*/
$sonuc = preg_grep("/$guvenliPattern/", $kelimeler);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>PHP Regex Demo</title>
<style>
body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
.kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
</style>
</head>

<body>

<div class="kutu">
<h2>Orijinal Dizi</h2>
<pre><?php print_r($kelimeler); ?></pre>
</div>

<div class="kutu">
<h2>preg_grep() → "php" ile başlayanlar</h2>
<pre><?php print_r($phpIleBaslayanlar); ?></pre>
</div>

<div class="kutu">
<h2>preg_quote() ile güvenli arama ("c++")</h2>
<pre><?php print_r($sonuc); ?></pre>
</div>

</body>
</html>
