<?php
/*************************************************
 * PHP DİZİ FONKSİYONLARI
 *************************************************/


/*************************************************
 *  count()
 * Dizide kaç eleman olduğunu verir
 *************************************************/

$meyveler = ["Elma", "Armut", "Muz", "Çilek"];

echo "Meyve sayısı: " . count($meyveler);
echo "<hr>";



/*************************************************
 *  array_push()
 * Dizinin sonuna eleman ekler
 *************************************************/

array_push($meyveler, "Kiraz", "Karpuz");

echo "<pre>";
print_r($meyveler);
echo "</pre>";

echo "<hr>";



/*************************************************
 *  array_pop()
 * Dizinin sonundaki elemanı siler
 *************************************************/

$sonEleman = array_pop($meyveler);

echo "Silinen eleman: " . $sonEleman . "<br>";

echo "<pre>";
print_r($meyveler);
echo "</pre>";

echo "<hr>";



/*************************************************
 *  array_shift()
 * Dizinin başındaki elemanı siler
 *************************************************/

$ilkEleman = array_shift($meyveler);

echo "Silinen ilk eleman: " . $ilkEleman . "<br>";

echo "<pre>";
print_r($meyveler);
echo "</pre>";

echo "<hr>";



/*************************************************
 *  array_unshift()
 * Dizinin başına eleman ekler
 *************************************************/

array_unshift($meyveler, "Portakal");

echo "<pre>";
print_r($meyveler);
echo "</pre>";

echo "<hr>";



/*************************************************
 *in_array()
 * Dizide belirli bir değer var mı kontrol eder
 *************************************************/

$varMi = in_array("Muz", $meyveler);

if ($varMi) {
    echo "Muz dizide var";
} else {
    echo "Muz dizide yok";
}

echo "<hr>";



/*************************************************
 *  array_search()
 * Dizideki bir değerin anahtarını bulur
 *************************************************/

$anahtar = array_search("Çilek", $meyveler);

echo "Çilek anahtarı: " . $anahtar;
echo "<hr>";



/*************************************************
 *  array_merge()
 * İki diziyi birleştirir
 *************************************************/

$sebzeler = ["Domates", "Biber", "Salatalık"];

$gida = array_merge($meyveler, $sebzeler);

echo "<pre>";
print_r($gida);
echo "</pre>";

echo "<hr>";



/*************************************************
 * array_keys() ve array_values()
 *************************************************/

$ogrenci = [
    "ad" => "Ali",
    "soyad" => "Yılmaz",
    "yas" => 21
];

// Anahtarları alma
$anahtarlar = array_keys($ogrenci);

// Değerleri alma
$degerler = array_values($ogrenci);

echo "Anahtarlar:<br>";
print_r($anahtarlar);

echo "<br><br>Değerler:<br>";
print_r($degerler);

echo "<hr>";



/*************************************************
 *  sort() ve rsort()
 * Diziyi sıralar
 *************************************************/

$sayilar = [5, 2, 9, 1, 7];

sort($sayilar); // Küçükten büyüğe

echo "Küçükten büyüğe:<br>";
print_r($sayilar);

echo "<br><br>";

rsort($sayilar); // Büyükten küçüğe

echo "Büyükten küçüğe:<br>";
print_r($sayilar);

echo "<hr>";



/*************************************************
 * array_reverse()
 * Diziyi ters çevirir
 *************************************************/

$ters = array_reverse($sayilar);

print_r($ters);

echo "<hr>";



/*************************************************
 *  array_slice()
 * Dizinin belli bir kısmını alır
 *************************************************/

$parca = array_slice($gida, 1, 3);

echo "<pre>";
print_r($parca);
echo "</pre>";

?>
