<?php
// -----------------------------
// TEMEL AYARLAR
// -----------------------------
error_reporting(E_ALL);                          // Tüm hata türlerini raporla
ini_set('display_errors', 1);                    // Hataları ekranda göster
date_default_timezone_set('Europe/Istanbul');    // Tarih/saat için varsayılan zaman dilimini İstanbul yap

// -----------------------------
// BASİT EKRANA YAZDIRMA
// -----------------------------
echo "<h1>PHP Fonksiyon Örnekleri</h1>";         // HTML başlık etiketiyle sayfa başlığı yazdır
echo "<hr>";                                     // Yatay çizgi çiz

// -----------------------------
// KENDİ FONKSİYONLARIMIZ (USER-DEFINED FUNCTIONS)
// -----------------------------

function selamVer($isim = "Ziyaretçi") {         // selamVer isminde, varsayılan parametreli bir fonksiyon tanımla
    return "Merhaba, " . $isim;                  // Fonksiyon çağrıldığında oluşturulan selam metnini geri döndür
}

function topla($a, $b) {                         // İki parametre alan topla fonksiyonu tanımla
    return $a + $b;                              // Parametrelerin toplamını döndür
}

function kareAl($sayi) {                         // Tek parametre alan kareAl fonksiyonu tanımla
    return $sayi * $sayi;                        // Sayının karesini döndür
}

function yazdirSatir($metin) {                   // Ekrana satır yazdıran fonksiyon tanımla
    echo "<p>" . $metin . "</p>";                // Verilen metni <p> etiketi içinde yazdır
}

// Fonksiyonları kullan
yazdirSatir(selamVer("Ali"));                    // selamVer fonksiyonunu 'Ali' parametresiyle çağır ve sonucu yazdır
yazdirSatir(selamVer());                         // selamVer fonksiyonunu parametresiz çağır (varsayılan değer kullanılır)
yazdirSatir("5 + 7 = " . topla(5, 7));           // topla fonksiyonu ile 5 ve 7’yi topla, sonucu yazdır
yazdirSatir("6 sayısının karesi: " . kareAl(6)); // kareAl fonksiyonu ile 6’nın karesini hesapla ve yazdır

echo "<hr>";                                     // Bölüm ayırmak için yatay çizgi

// -----------------------------
// STRING (METİN) FONKSİYONLARI
// -----------------------------
echo "<h2>String Fonksiyonları</h2>";            // String fonksiyonları başlığını yazdır

$metin = "Merhaba Dünya";                        // $metin isminde bir string değişken tanımla
yazdirSatir("Orijinal metin: " . $metin);        // Orijinal metni yazdır

$uzunluk = strlen($metin);                       // strlen ile metnin karakter uzunluğunu hesapla
yazdirSatir("Metnin uzunluğu: " . $uzunluk);     // Uzunluğu ekrana yazdır

$buyuk = strtoupper($metin);                     // strtoupper ile metnin tüm harflerini büyük harfe çevir
yazdirSatir("Büyük harf: " . $buyuk);            // Büyük harfli halini yazdır

$kucuk = strtolower($metin);                     // strtolower ile metnin tüm harflerini küçük harfe çevir
yazdirSatir("Küçük harf: " . $kucuk);            // Küçük harfli halini yazdır

$parca = substr($metin, 0, 7);                   // substr ile metinden 0. indexten başlayarak 7 karakter al
yazdirSatir("İlk 7 karakter: " . $parca);        // Alınan kısmı yazdır

$degismis = str_replace("Dünya", "PHP", $metin); // str_replace ile 'Dünya' kelimesini 'PHP' ile değiştir
yazdirSatir("Değişmiş metin: " . $degismis);     // Değişmiş metni yazdır

$konum = strpos($metin, "Dünya");                // strpos ile 'Dünya' kelimesinin metin içindeki konumunu bul
yazdirSatir("'Dünya' kelimesinin konumu: " . $konum); // Bulunan konumu yazdır

echo "<hr>";                                     // Yeni bölüm için çizgi

// -----------------------------
// SAYISAL VE MATEMATİKSEL FONKSİYONLAR
// -----------------------------
echo "<h2>Matematik Fonksiyonları</h2>";         // Matematik fonksiyonları başlığını yazdır

$sayi = 3.56789;                                 // Ondalıklı bir sayı tanımla
yazdirSatir("Orijinal sayı: " . $sayi);          // Orijinal sayıyı yazdır

$yuvarla = round($sayi, 2);                      // round ile sayıyı virgülden sonra 2 basamak olacak şekilde yuvarla
yazdirSatir("2 basamak yuvarlanmış: " . $yuvarla); // Yuvarlanmış sonucu yazdır

$yukari = ceil($sayi);                           // ceil ile sayıyı yukarı yuvarla
yazdirSatir("Yukarı yuvarlama (ceil): " . $yukari); // Yukarı yuvarlanan sonuç

$asagi = floor($sayi);                           // floor ile sayıyı aşağı yuvarla
yazdirSatir("Aşağı yuvarlama (floor): " . $asagi);  // Aşağı yuvarlanan sonuç

$kuvvet = pow(2, 5);                             // pow ile 2 üzeri 5’i hesapla
yazdirSatir("2^5 = " . $kuvvet);                 // Sonucu yazdır

$karekok = sqrt(81);                             // sqrt ile 81’in karekökünü al
yazdirSatir("81'in karekökü: " . $karekok);      // Sonucu yazdır

$rasgele = rand(1, 100);                         // rand ile 1 ile 100 arasında rastgele bir sayı üret
yazdirSatir("1-100 arası rastgele sayı: " . $rasgele); // Üretilen sayıyı yazdır

$diziSayi = [5, 9, 2, 7];                        // Sayılardan oluşan bir dizi tanımla
yazdirSatir("Sayı dizisi: " . implode(", ", $diziSayi)); // implode ile dizi elemanlarını virgülle birleştirip yazdır

$min = min($diziSayi);                           // min ile dizideki en küçük değeri bul
$max = max($diziSayi);                           // max ile dizideki en büyük değeri bul
yazdirSatir("Dizideki en küçük sayı: " . $min);  // En küçük sayıyı yazdır
yazdirSatir("Dizideki en büyük sayı: " . $max);  // En büyük sayıyı yazdır

echo "<hr>";                                     // Yeni bölüm için çizgi

// -----------------------------
// DİZİ (ARRAY) FONKSİYONLARI
// -----------------------------
echo "<h2>Dizi Fonksiyonları</h2>";              // Dizi fonksiyonları başlığını yazdır

$isimler = ["Ali", "Ayşe", "Mehmet"];            // $isimler isimli bir dizi tanımla
yazdirSatir("İsimler dizisi: " . implode(", ", $isimler)); // Dizideki isimleri virgülle ayırarak yazdır

$elemanSayisi = count($isimler);                 // count ile dizide kaç eleman olduğunu öğren
yazdirSatir("Eleman sayısı: " . $elemanSayisi);  // Eleman sayısını yazdır

array_push($isimler, "Zeynep");                  // array_push ile dizi sonuna 'Zeynep' elemanını ekle
yazdirSatir("Zeynep eklendikten sonra: " . implode(", ", $isimler)); // Güncel diziyi yazdır

$son = array_pop($isimler);                      // array_pop ile dizinin son elemanını çıkar ve değişkene ata
yazdirSatir("Çıkarılan son eleman: " . $son);    // Çıkarılan elemanı yazdır
yazdirSatir("Pop sonrası dizi: " . implode(", ", $isimler)); // Dizinin yeni halini yazdır

$varMi = in_array("Ali", $isimler);              // in_array ile 'Ali' ismi dizide var mı kontrol et
yazdirSatir("'Ali' dizide var mı? " . ($varMi ? "Evet" : "Hayır")); // Sonucu Evet/Hayır olarak yazdır

$anahtarlar = array_keys($isimler);              // array_keys ile dizinin anahtarlarını (indexlerini) al
yazdirSatir("Dizinin indeksleri: " . implode(", ", $anahtarlar)); // Indeksleri yazdır

$yaslar = [                                      // Anahtar-değer çiftlerinden oluşan bir dizi (associative array) tanımla
    "Ali" => 25,                                 // Anahtar 'Ali', değer 25
    "Ayşe" => 30,                                // Anahtar 'Ayşe', değer 30
];

$birlesik = array_merge($isimler, array_keys($yaslar)); // array_merge ile iki diziyi birleştir (isimler + yaslar’ın anahtarları)
yazdirSatir("Birleşik dizi: " . implode(", ", $birlesik)); // Ortaya çıkan diziyi yazdır

echo "<hr>";                                     // Yeni bölüm için çizgi

// -----------------------------
// TARİH - SAAT FONKSİYONLARI
// -----------------------------
echo "<h2>Tarih - Saat Fonksiyonları</h2>";      // Tarih-saat fonksiyonları başlığını yazdır

$simdiZamanDamgasi = time();                     // time ile mevcut Unix zaman damgasını al
yazdirSatir("Unix zaman damgası: " . $simdiZamanDamgasi); // Zaman damgasını yazdır

$bugun = date("d.m.Y H:i:s");                    // date ile güncel tarihi ve saati biçimlendir (gün.ay.yıl saat:dakika:saniye)
yazdirSatir("Bugünün tarihi ve saati: " . $bugun); // Biçimlendirilmiş tarihi yazdır

$yarinZamanDamgasi = strtotime("+1 day");        // strtotime ile şu andan 1 gün sonrasının zaman damgasını al
$yarin = date("d.m.Y", $yarinZamanDamgasi);      // date ile yarının tarihini biçimlendir
yazdirSatir("Yarının tarihi: " . $yarin);        // Yarının tarihini yazdır

echo "<hr>";                                     // Yeni bölüm için çizgi

// -----------------------------
// SÜPER GLOBAL DEĞİŞKENLER (KISA ÖRNEK)
// -----------------------------
echo "<h2>Süper Global Kullanımı (Kısa Örnek)</h2>"; // Süper global başlığı yazdır

// URL’de ?isim=Ali gibi bir parametre gelmiş mi diye kontrol ediyoruz
$gelenIsim = isset($_GET['isim']) ? $_GET['isim'] : "Parametre yok"; // $_GET['isim'] tanımlıysa onu al, yoksa 'Parametre yok' yaz

yazdirSatir("GET ile gelen 'isim' parametresi: " . $gelenIsim); // GET parametresini ekrana yazdır

// Sunucu hakkında bazı bilgiler
yazdirSatir("Sunucu adı (SERVER_NAME): " . $_SERVER['SERVER_NAME']); // $_SERVER süper globalinden sunucu adını yazdır
yazdirSatir("İstek yöntemi (REQUEST_METHOD): " . $_SERVER['REQUEST_METHOD']); // İstek metodunu (GET/POST) yazdır

echo "<hr>";                                     // Yeni bölüm için çizgi

// -----------------------------
// DOSYA İŞLEMLERİ (BASİT ÖRNEK)
// -----------------------------
echo "<h2>Dosya Fonksiyonları (Basit Örnek)</h2>"; // Dosya fonksiyonları başlığını yazdır

$dosyaAdi = "ornek.txt";                         // Kullanacağımız dosyanın adını belirle
$icerik = "Bu satır PHP ile dosyaya yazıldı.\n"; // Dosyaya yazılacak metni tanımla (\n satır sonu karakteri)

// file_put_contents: Dosyaya içerik yazar (dosya yoksa oluşturur, varsa üzerine yazar)
file_put_contents($dosyaAdi, $icerik);           // ornek.txt dosyasına $icerik yaz

// file_get_contents: Dosyanın tamamını okur ve string olarak döndürür
$okunan = file_get_contents($dosyaAdi);          // ornek.txt dosyasının içeriğini oku

yazdirSatir("Dosyaya yazılan ve okunan içerik: " . nl2br($okunan)); // nl2br ile \n karakterlerini <br>’e çevirerek ekrana yazdır

echo "<hr>";                                     // Son bölüm

?>
