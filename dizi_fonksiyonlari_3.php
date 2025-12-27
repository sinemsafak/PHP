<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');

function title($t) {
    echo "\n\n<hr><h3>{$t}</h3><pre>";
}
function dump($label, $data) {
    echo $label . ":\n";
    print_r($data);
    echo "\n";
}

/* -----------------------------------------------------------
   ÖRNEK VERİLER
----------------------------------------------------------- */
$assoc = [
    'Ad'    => 'Ali',
    'Soyad' => 'Yılmaz',
    'Yas'   => 25,
    'Sehir' => 'İstanbul',
];

$nums = [1, 2, 2, 3, 3, 3, 4, 5, 5];

$users = [
    ['id' => 10, 'name' => 'Ali',  'city' => 'İstanbul'],
    ['id' => 20, 'name' => 'Ayşe', 'city' => 'Ankara'],
    ['id' => 30, 'name' => 'Mehmet', 'city' => 'İzmir'],
];

$a1 = ['a' => 'kedi', 'b' => 'köpek', 'c' => 'kuş'];
$a2 = ['a' => 'kedi', 'b' => 'aslan', 'd' => 'balık'];

$v1 = ['kedi', 'köpek', 'kuş'];
$v2 = ['kedi', 'aslan', 'balık', 'kuş'];

/* -----------------------------------------------------------
   array_change_key_case()
   Bir dizideki tüm anahtarları küçük veya büyük harfe dönüştürür.
----------------------------------------------------------- */
title("array_change_key_case()");
$lowerKeys = array_change_key_case($assoc, CASE_LOWER);
$upperKeys = array_change_key_case($assoc, CASE_UPPER);
dump("Orijinal", $assoc);
dump("Anahtarlar küçük", $lowerKeys);
dump("Anahtarlar büyük", $upperKeys);
echo "</pre>";

/* -----------------------------------------------------------
   array_chunk()
   Bir diziyi belirli boyutlarda parçalara böler.
----------------------------------------------------------- */
title("array_chunk()");
$chunked = array_chunk($v2, 2);
dump("Orijinal", $v2);
dump("2'şerli parçalar", $chunked);
echo "</pre>";

/* -----------------------------------------------------------
   array_column()
   Çok boyutlu dizide tek bir sütunun değerlerini döndürür.
----------------------------------------------------------- */
title("array_column()");
$names = array_column($users, 'name');      // sadece name sütunu
$idToName = array_column($users, 'name', 'id'); // id => name
dump("Orijinal", $users);
dump("Sadece name", $names);
dump("id => name", $idToName);
echo "</pre>";

/* -----------------------------------------------------------
   array_combine()
   Bir anahtar dizisi + bir değer dizisiyle yeni dizi oluşturur.
----------------------------------------------------------- */
title("array_combine()");
$keys = ['site', 'db', 'user'];
$vals = ['example.com', 'mydb', 'root'];
$combined = array_combine($keys, $vals);
dump("Anahtarlar", $keys);
dump("Değerler", $vals);
dump("Birleşik", $combined);
echo "</pre>";

/* -----------------------------------------------------------
   array_count_values()
   Dizideki tüm değerlerin kaç kez geçtiğini sayar.
----------------------------------------------------------- */
title("array_count_values()");
$counted = array_count_values($nums);
dump("Orijinal", $nums);
dump("Sayım", $counted);
echo "</pre>";

/* -----------------------------------------------------------
   array_diff()
   Dizileri karşılaştırır, farkları döndürür (sadece değerleri karşılaştırır).
----------------------------------------------------------- */
title("array_diff()");
$diffVals = array_diff($v2, $v1);
dump("v2", $v2);
dump("v1", $v1);
dump("v2 - v1 (değer farkı)", $diffVals);
echo "</pre>";

/* -----------------------------------------------------------
   array_diff_assoc()
   Dizileri karşılaştırır (anahtar + değer karşılaştırır), farkları döndürür.
----------------------------------------------------------- */
title("array_diff_assoc()");
$diffAssoc = array_diff_assoc($a1, $a2);
dump("a1", $a1);
dump("a2", $a2);
dump("a1 - a2 (anahtar+değer farkı)", $diffAssoc);
echo "</pre>";

/* -----------------------------------------------------------
   array_diff_key()
   Dizileri karşılaştırır, farkları döndürür (sadece anahtarları karşılaştırır).
----------------------------------------------------------- */
title("array_diff_key()");
$diffKey = array_diff_key($a1, $a2);
dump("a1", $a1);
dump("a2", $a2);
dump("a1 - a2 (anahtar farkı)", $diffKey);
echo "</pre>";

/* -----------------------------------------------------------
   array_diff_uassoc()
   Anahtar+değer karşılaştırır; anahtar karşılaştırma fonksiyonu kullanıcı tanımlıdır.
----------------------------------------------------------- */
title("array_diff_uassoc()");
// Anahtar karşılaştırması: string karşılaştır (case-insensitive)
$keyCompare = function($k1, $k2) {
    return strcasecmp((string)$k1, (string)$k2); // 0: eşit, <0, >0
};
$diffUassoc = array_diff_uassoc($a1, $a2, $keyCompare);
dump("a1", $a1);
dump("a2", $a2);
dump("a1 - a2 (uassoc)", $diffUassoc);
echo "</pre>";

/* -----------------------------------------------------------
   array_diff_ukey()
   Sadece anahtarları karşılaştırır; anahtar karşılaştırma fonksiyonu kullanıcı tanımlıdır.
----------------------------------------------------------- */
title("array_diff_ukey()");
$diffUkey = array_diff_ukey($a1, $a2, $keyCompare);
dump("a1", $a1);
dump("a2", $a2);
dump("a1 - a2 (ukey)", $diffUkey);
echo "</pre>";

/* -----------------------------------------------------------
   array_fill()
   Belirtilen başlangıç indeksinden itibaren, belirli sayıda elemanı aynı değerle doldurur.
----------------------------------------------------------- */
title("array_fill()");
$filled = array_fill(0, 5, 'PHP'); // 0'dan başla, 5 eleman, değer "PHP"
dump("Doldurulmuş", $filled);
echo "</pre>";

/* -----------------------------------------------------------
   array_fill_keys()
   Belirtilen anahtarlarla bir dizi oluşturur ve hepsine aynı değeri verir.
----------------------------------------------------------- */
title("array_fill_keys()");
$filledKeys = array_fill_keys(['admin', 'editor', 'user'], true);
dump("Doldurulmuş (anahtarlara göre)", $filledKeys);
echo "</pre>";

/* -----------------------------------------------------------
   array_filter()
   Bir diziyi filtreler (varsayılan: false kabul edilenleri atar).
----------------------------------------------------------- */
title("array_filter()");
$mixed = [0, 1, 2, "", "merhaba", null, false, true, "0", 10];
$filteredDefault = array_filter($mixed); // "falsey" değerleri atar
$filteredCustom = array_filter($mixed, function($x) {
    // Sadece sayısal ve 2'den büyük olanları al
    return is_numeric($x) && $x > 2;
});
dump("Orijinal", $mixed);
dump("Varsayılan filtre", $filteredDefault);
dump("Özel filtre (numeric && >2)", $filteredCustom);
echo "</pre>";

/* -----------------------------------------------------------
   array_flip()
   Anahtarlar ile değerleri yer değiştirir (değerler anahtar olur).
   Not: Değerler benzersiz olmalı; çakışırsa sonuncusu kazanır.
----------------------------------------------------------- */
title("array_flip()");
$flipMe = ['TR' => 'Türkiye', 'DE' => 'Almanya', 'FR' => 'Fransa'];
$flipped = array_flip($flipMe);
dump("Orijinal", $flipMe);
dump("Flip", $flipped);
echo "</pre>";

/* -----------------------------------------------------------
   array_intersect()
   Dizileri karşılaştırır ve eşleşenleri döndürür (sadece değerleri karşılaştırır).
----------------------------------------------------------- */
title("array_intersect()");
$intersectVals = array_intersect($v1, $v2);
dump("v1", $v1);
dump("v2", $v2);
dump("Kesişim (değer)", $intersectVals);
echo "</pre>";

/* -----------------------------------------------------------
   array_intersect_assoc()
   Anahtar+değer eşleşenleri döndürür.
----------------------------------------------------------- */
title("array_intersect_assoc()");
$intersectAssoc = array_intersect_assoc($a1, $a2);
dump("a1", $a1);
dump("a2", $a2);
dump("Kesişim (anahtar+değer)", $intersectAssoc);
echo "</pre>";

/* -----------------------------------------------------------
   array_intersect_key()
   Sadece anahtar kesişimini döndürür.
----------------------------------------------------------- */
title("array_intersect_key()");
$intersectKey = array_intersect_key($a1, $a2);
dump("a1", $a1);
dump("a2", $a2);
dump("Kesişim (anahtar)", $intersectKey);
echo "</pre>";

/* -----------------------------------------------------------
   array_intersect_uassoc()
   Anahtar+değer kesişimi; anahtar karşılaştırması kullanıcı tanımlı fonksiyonla yapılır.
----------------------------------------------------------- */
title("array_intersect_uassoc()");
$intersectUassoc = array_intersect_uassoc($a1, $a2, $keyCompare);
dump("a1", $a1);
dump("a2", $a2);
dump("Kesişim (uassoc)", $intersectUassoc);
echo "</pre>";

/* -----------------------------------------------------------
   array_intersect_ukey()
   Anahtar kesişimi; anahtar karşılaştırması kullanıcı tanımlı fonksiyonla yapılır.
----------------------------------------------------------- */
title("array_intersect_ukey()");
$intersectUkey = array_intersect_ukey($a1, $a2, $keyCompare);
dump("a1", $a1);
dump("a2", $a2);
dump("Kesişim (ukey)", $intersectUkey);
echo "</pre>";

/* -----------------------------------------------------------
   array_key_exists()
   Dizide belirtilen anahtar var mı kontrol eder.
----------------------------------------------------------- */
title("array_key_exists()");
dump("assoc", $assoc);
echo "Anahtar 'Ad' var mı? " . (array_key_exists('Ad', $assoc) ? "EVET" : "HAYIR") . "\n";
echo "Anahtar 'Email' var mı? " . (array_key_exists('Email', $assoc) ? "EVET" : "HAYIR") . "\n";
echo "</pre>";

/* -----------------------------------------------------------
   array_keys()
   Dizinin tüm anahtarlarını (istersen filtre ile) döndürür.
----------------------------------------------------------- */
title("array_keys()");
$keysAll = array_keys($assoc);
$keysByValue = array_keys($assoc, 'İstanbul'); // değeri İstanbul olan anahtar(lar)
dump("assoc", $assoc);
dump("Tüm anahtarlar", $keysAll);
dump("'İstanbul' değerine sahip anahtarlar", $keysByValue);
echo "</pre>";

/* -----------------------------------------------------------
   array_map()
   Dizinin her elemanını bir fonksiyona gönderir, yeni dizi döndürür.
----------------------------------------------------------- */
title("array_map()");
$prices = [10, 20, 30];
$withVat = array_map(function($p) {
    return $p * 1.20; // %20 KDV ekle
}, $prices);

$upperNames = array_map('mb_strtoupper', array_column($users, 'name'));
dump("Fiyatlar", $prices);
dump("KDV'li", $withVat);
dump("İsimler (BÜYÜK)", $upperNames);
echo "</pre>";

echo "<hr><b>Bitti.</b>";
