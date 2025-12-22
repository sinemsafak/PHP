<?php
/*************************************************
 * PHP DİZİLER - TEMEL SEVİYE
 * WampServer + VS Code için örnekler
 *************************************************/


/*************************************************
 * 1. SAYFA - BASİT (İNDEKSLİ) DİZİLER
 *************************************************/

// İndeksli dizi tanımlama
$meyveler = ["Elma", "Armut", "Muz", "Çilek"];

// Dizinin elemanlarına indeks numarası ile erişilir
echo "1. Meyve: " . $meyveler[0] . "<br>";
echo "2. Meyve: " . $meyveler[1] . "<br>";
echo "3. Meyve: " . $meyveler[2] . "<br>";

echo "<hr>";



/*************************************************
 * 2. SAYFA - İNDEKSLİ DİZİYİ EKRANA YAZDIRMA
 *************************************************/

// for döngüsü ile dizinin elemanlarını yazdırma
for ($i = 0; $i < 4; $i++) {
    echo "Meyve: " . $meyveler[$i] . "<br>";
}

echo "<hr>";



/*************************************************
 * 3. SAYFA - STRING VE SAYI DİZİLERİ
 *************************************************/

// Sayılardan oluşan dizi
$sayilar = [10, 20, 30, 40];

// Dizideki elemanlarla işlem yapma
echo $sayilar[0] + $sayilar[1]; // 10 + 20
echo "<br>";

// Metinlerden oluşan dizi
$isimler = ["Ahmet", "Mehmet", "Ayşe"];

echo "Merhaba " . $isimler[2];
echo "<hr>";



/*************************************************
 * 4. SAYFA - ANAHTARLI (ASSOCIATIVE) DİZİLER
 *************************************************/

// Anahtar - değer mantığıyla dizi tanımlama
$ogrenci = [
    "ad" => "Ali",
    "soyad" => "Yılmaz",
    "yas" => 21,
    "bolum" => "Bilgisayar Programcılığı"
];

// Anahtar adıyla erişim
echo "Ad: " . $ogrenci["ad"] . "<br>";
echo "Soyad: " . $ogrenci["soyad"] . "<br>";
echo "Yaş: " . $ogrenci["yas"] . "<br>";
echo "Bölüm: " . $ogrenci["bolum"] . "<br>";

echo "<hr>";



/*************************************************
 * 5. SAYFA - ANAHTARLI DİZİYİ DÖNGÜYLE GEZME
 *************************************************/

// foreach döngüsü ile anahtarlı dizi yazdırma
foreach ($ogrenci as $anahtar => $deger) {
    echo $anahtar . " : " . $deger . "<br>";
}

echo "<hr>";



/*************************************************
 * 6. SAYFA - ÇOK BOYUTLU (İÇ İÇE) DİZİLER
 *************************************************/

// Birden fazla öğrenciyi tutan dizi
$ogrenciler = [
    [
        "ad" => "Ahmet",
        "yas" => 20
    ],
    [
        "ad" => "Mehmet",
        "yas" => 22
    ],
    [
        "ad" => "Ayşe",
        "yas" => 19
    ]
];

// İç içe dizilerden veri çekme
echo $ogrenciler[0]["ad"] . " - " . $ogrenciler[0]["yas"] . "<br>";
echo $ogrenciler[1]["ad"] . " - " . $ogrenciler[1]["yas"] . "<br>";
echo $ogrenciler[2]["ad"] . " - " . $ogrenciler[2]["yas"] . "<br>";

echo "<hr>";



/*************************************************
 * 7. SAYFA - ÇOK BOYUTLU DİZİYİ DÖNGÜYLE GEZME
 *************************************************/

foreach ($ogrenciler as $ogrenci) {
    echo "Ad: " . $ogrenci["ad"] . "<br>";
    echo "Yaş: " . $ogrenci["yas"] . "<br>";
    echo "------<br>";
}

?>
