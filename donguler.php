<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Döngüler Örnekleri</title>
</head>
<body>

<h1>PHP Döngüler – Örnek Sayfası</h1>

<hr>
<h2>1 while Döngüsü</h2>

<?php
// while döngüsü: Koşul DOĞRU olduğu sürece çalışan döngüdür.

// $sayi değişkenini 1 olarak başlatıyoruz
$sayi = 1;

echo "1) while ile 1'den 5'e kadar sayılar:<br>";

// $sayi 5'ten küçük veya eşit olduğu sürece döngü döner
while ($sayi <= 5) {
    // O anki sayıyı ekrana yazdır
    echo $sayi . "<br>";
    
    // Her turda $sayi'yi 1 artırıyoruz
    $sayi++;
}
?>

<hr>
<h2>2 do...while Döngüsü</h2>

<?php
// do...while döngüsü: Önce kod bloğu çalışır, SONRA koşul kontrol edilir.
// Bu yüzden en az 1 kere çalışması kesindir.

$sayi = 1;

echo "2) do...while ile 1'den 5'e kadar sayılar:<br>";

do {
    // Önce mevcut sayıyı yazdır
    echo $sayi . "<br>";
    
    // Sonra sayıyı 1 artır
    $sayi++;
    
// En son koşul kontrol edilir
} while ($sayi <= 5);
?>

<hr>
<h2>3 for Döngüsü</h2>

<?php
// for döngüsü: başlangıç, bitiş ve artış değerleri belliyse kullanmak için idealdir.

echo "3) for ile 1'den 5'e kadar sayılar:<br>";

// $i 1'den başlar, 5'e kadar gider, her turda 1 artar
for ($i = 1; $i <= 5; $i++) {
    echo $i . "<br>";
}
?>

<hr>
<h2>4 foreach Döngüsü (Dizi Üzerinde)</h2>

<?php
// foreach: Özellikle DİZİLER üzerinde gezinmek için kullanılır.

$meyveler = ["Elma", "Armut", "Muz", "Kivi"];

echo "4) foreach ile meyve isimleri:<br>";

// $meyveler dizisinin her bir elemanı sırayla $meyve değişkenine atanır
foreach ($meyveler as $meyve) {
    echo $meyve . "<br>";
}
?>

<hr>
<h2>5 foreach (Anahtar → Değer Kullanımı)</h2>

<?php
// Dizide hem ANAHTAR (key) hem DEĞER (value) varsa bu şekilde kullanabiliriz.

$notlar = [
    "Ahmet"  => 85,
    "Ayşe"   => 92,
    "Mehmet" => 70
];

echo "5) foreach ile öğrenci notları (isim → not):<br>";

// $isim dizinin anahtarını, $not ise değerini temsil eder
foreach ($notlar as $isim => $not) {
    echo $isim . " adlı öğrencinin notu: " . $not . "<br>";
}
?>

<hr>
<h2>6 İç İçe (Nested) for Döngüsü – Çarpım Tablosu</h2>

<?php
// İç içe döngü: Bir döngünün içinde başka bir döngü kullanmaktır.
// Burada küçük bir çarpım tablosu yapıyoruz (1–5 arası).

echo "6) 1–5 arası küçük çarpım tablosu:<br><br>";

// Dış döngü satırları temsil ediyor
for ($i = 1; $i <= 5; $i++) {
    
    // İç döngü sütunları temsil ediyor
    for ($j = 1; $j <= 5; $j++) {
        // Her çarpım sonucunu yan yana yazdır
        echo $i . "x" . $j . "=" . ($i * $j) . " &nbsp; ";
    }
    
    // Her satır bittiğinde alt satıra geç
    echo "<br>";
}
?>
</body>
</html>
