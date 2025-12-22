<?php
/*************************************************
 * PHP DİZİ FONKSİYONLARI
 * 
 *************************************************/


/*************************************************
 *  BİLGİ & KONTROL FONKSİYONLARI
 *************************************************/

$dizi = ["Elma", "Armut", "Muz"];

echo count($dizi);              // Eleman sayısı
echo "<br>";

var_dump(is_array($dizi));      // Dizi mi?
echo "<hr>";



/*************************************************
 *  EKLEME & SİLME
 *************************************************/

array_push($dizi, "Çilek");     // Sona ekle
array_unshift($dizi, "Kiraz");  // Başa ekle

array_pop($dizi);               // Sondan sil
array_shift($dizi);             // Baştan sil

print_r($dizi);
echo "<hr>";



/*************************************************
 *  ARAMA & KONTROL
 *************************************************/

echo in_array("Elma", $dizi);   // Dizide var mı?
echo "<br>";

echo array_search("Muz", $dizi); // Anahtarını bul
echo "<hr>";



/*************************************************
 *  SIRALAMA
 *************************************************/

$sayilar = [5, 3, 9, 1];

sort($sayilar);    // Küçük → büyük
rsort($sayilar);   // Büyük → küçük

print_r($sayilar);
echo "<hr>";



/*************************************************
 * ANAHTARLI DİZİ SIRALAMA
 *************************************************/

$ogrenci = [
    "ad" => "Ali",
    "yas" => 21,
    "not" => 85
];

asort($ogrenci);  // Değere göre sırala
ksort($ogrenci);  // Anahtara göre sırala

print_r($ogrenci);
echo "<hr>";



/*************************************************
 *  BİRLEŞTİRME & PARÇALAMA
 *************************************************/

$a = ["Elma", "Armut"];
$b = ["Muz", "Çilek"];

$birlesik = array_merge($a, $b);
print_r($birlesik);

echo "<br>";

$parca = array_slice($birlesik, 1, 2);
print_r($parca);

echo "<hr>";



/*************************************************
 * ANAHTAR & DEĞER FONKSİYONLARI
 *************************************************/

print_r(array_keys($ogrenci));
echo "<br>";
print_r(array_values($ogrenci));
echo "<hr>";



/*************************************************
 *  DİZİ TEMİZLEME & FİLTRELEME
 *************************************************/

$veriler = ["Ali", "", null, "Ayşe", false];

$temiz = array_filter($veriler); // Boşları siler
print_r($temiz);

echo "<hr>";



/*************************************************
 *  DİZİ DÖNÜŞÜMLERİ
 *************************************************/

$sayilar = [1, 2, 3, 4];

$kareler = array_map(function($sayi) {
    return $sayi * $sayi;
}, $sayilar);

print_r($kareler);
echo "<hr>";



/*************************************************
 * KARŞILAŞTIRMA
 *************************************************/

$d1 = [1, 2, 3];
$d2 = [2, 3, 4];

$fark = array_diff($d1, $d2);
print_r($fark);

echo "<hr>";



/*************************************************
 * ÇOK BOYUTLU DİZİLER
 *************************************************/

$ogrenciler = [
    ["ad" => "Ali", "yas" => 20],
    ["ad" => "Ayşe", "yas" => 22],
];

$yaslar = array_column($ogrenciler, "yas");
print_r($yaslar);

echo "<hr>";



/*************************************************
 *  RASTGELE & TERS
 *************************************************/

shuffle($dizi);               // Karıştır
print_r($dizi);

echo "<br>";

print_r(array_reverse($dizi)); // Ters çevir

echo "<hr>";



/*************************************************
 * DİZİDEN STRING / STRINGDEN DİZİ
 *************************************************/

$metin = implode(", ", $dizi);
echo $metin;

echo "<br>";

$yeniDizi = explode(", ", $metin);
print_r($yeniDizi);

echo "<hr>";



/*************************************************
 *
 *************************************************/

print_r(array_unique(["a","b","a","c"])); // Tekrarları sil
echo "<br>";

print_r(array_chunk($birlesik, 2));       // Parçalara ayır

echo "<hr>";

?>
