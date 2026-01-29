<?php
/***************************************************************
 * VERİ TÜRÜ BULMA VE TÜR DEĞİŞTİRME (CASTING) - TEK SAYFA DEMO
 * WampServer + VS Code ile çalışır
 ***************************************************************/

/* Tarayıcıya bu sayfanın HTML olduğunu bildirir (UTF-8 Türkçe için) */
header("Content-Type: text/html; charset=UTF-8");

/* -------------------------------------------------------------
   1) ÖRNEK DEĞİŞKENLER OLUŞTURMA
------------------------------------------------------------- */

/* String (metin) veri */
$metin = "123.45";                 // "123.45" bir stringtir (tırnak olduğu için)

/* Integer (tam sayı) veri */
$sayi = 100;                       // 100 bir integer'dır

/* Float (ondalıklı) veri */
$ondalik = 3.14;                   // 3.14 bir float'tır

/* Boolean (true/false) veri */
$aktifMi = true;                   // true bir boolean'dır

/* Array (dizi) veri */
$dizi = [1, 2, 3];                 // bu bir array'dir

/* Null (boş) veri */
$bos = null;                       // null değeri, "değer yok" demektir


/* -------------------------------------------------------------
   2) VERİ TÜRÜ BULMA (gettype, var_dump)
------------------------------------------------------------- */

/* gettype() değişkenin türünü string olarak döndürür */
$metinTuru = gettype($metin);       // "string" döner
$sayiTuru  = gettype($sayi);        // "integer" döner

/* var_dump() hem türü hem değeri detaylı yazdırır (debug için ideal) */
ob_start();                         // var_dump çıktısını yakalamak için tampon başlatır
var_dump($metin);                   // string(6) "123.45" gibi bir çıktı üretir
$varDumpMetin = ob_get_clean();     // tampondaki çıktıyı alır ve tamponu kapatır


/* -------------------------------------------------------------
   3) TÜR KONTROL FONKSİYONLARI (is_...)
------------------------------------------------------------- */

/* is_string(): string mi? */
$metinStringMi = is_string($metin); // true döner

/* is_numeric(): "sayı gibi görünen" string veya sayı mı? */
$metinNumericMi = is_numeric($metin); // true (çünkü "123.45" sayısal bir string)

/* is_int(): integer mı? */
$sayiIntMi = is_int($sayi);         // true

/* is_float(): float mı? */
$ondalikFloatMi = is_float($ondalik); // true

/* is_bool(): boolean mı? */
$aktifBoolMu = is_bool($aktifMi);   // true

/* is_array(): dizi mi? */
$diziArrayMi = is_array($dizi);     // true

/* is_null(): null mı? */
$bosNullMu = is_null($bos);         // true


/* -------------------------------------------------------------
   4) TÜR DEĞİŞTİRME (CASTING) - (int), (float), (string), (bool)
------------------------------------------------------------- */

/* (int) casting: string'i integer'a çevirir (ondalık kısmı atar) */
$metinInt = (int)$metin;            // "123.45" -> 123

/* (float) casting: string'i float'a çevirir */
$metinFloat = (float)$metin;        // "123.45" -> 123.45

/* (string) casting: sayıyı string'e çevirir */
$sayiString = (string)$sayi;        // 100 -> "100"

/* (bool) casting: "boş" değerlere false, diğerlerine true verir */
$sifirBool = (bool)0;               // 0 -> false
$bosStringBool = (bool)"";          // "" -> false
$metinBool = (bool)$metin;          // "123.45" -> true


/* -------------------------------------------------------------
   5) HAZIR DÖNÜŞTÜRME FONKSİYONLARI (intval, floatval, strval)
------------------------------------------------------------- */

/* intval(): integer'a çevirir (casting gibi) */
$intvalSonuc = intval("55");        // "55" -> 55

/* floatval(): float'a çevirir */
$floatvalSonuc = floatval("9.99");  // "9.99" -> 9.99

/* strval(): string'e çevirir */
$strvalSonuc = strval(777);         // 777 -> "777"


/* -------------------------------------------------------------
   6) ÖRNEK: KULLANICIDAN GELEN VERİYİ GÜVENLİ DÖNÜŞTÜRME
------------------------------------------------------------- */

/* Örnek URL: ?yas=18  (GET ile gelmiş gibi düşün) */
$yasHam = $_GET["yas"] ?? "";       // yas parametresi yoksa boş string ata

/* Eğer gelen değer numeric ise int'e çevir, değilse null yap */
$yas = is_numeric($yasHam) ? (int)$yasHam : null; // örn "18" -> 18, "abc" -> null

?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Veri Türü Bulma ve Tür Değiştirme</title>
  <style>
    body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
    .kutu { background:#111827; padding:14px; border-radius:10px; margin-bottom:14px; }
    .satir { padding:6px 0; border-bottom:1px solid #1f2937; }
    .etiket { display:inline-block; min-width:260px; color:#93c5fd; }
    code, pre { background:#1f2937; padding:6px 8px; border-radius:8px; display:block; overflow:auto; }
  </style>
</head>
<body>

<div class="kutu">
  <h2>1) gettype() ile Veri Türü Bulma</h2>
  <div class="satir"><span class="etiket">$metin değeri:</span> <?= htmlspecialchars($metin) ?></div>
  <div class="satir"><span class="etiket">$metin türü:</span> <?= htmlspecialchars($metinTuru) ?></div>
  <div class="satir"><span class="etiket">$sayi türü:</span> <?= htmlspecialchars($sayiTuru) ?></div>
</div>

<div class="kutu">
  <h2>2) var_dump() Çıktısı</h2>
  <pre><?= htmlspecialchars($varDumpMetin) ?></pre>
</div>

<div class="kutu">
  <h2>3) is_* Fonksiyonları ile Tür Kontrolü</h2>
  <div class="satir"><span class="etiket">is_string($metin):</span> <?= $metinStringMi ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_numeric($metin):</span> <?= $metinNumericMi ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_int($sayi):</span> <?= $sayiIntMi ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_float($ondalik):</span> <?= $ondalikFloatMi ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_bool($aktifMi):</span> <?= $aktifBoolMu ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_array($dizi):</span> <?= $diziArrayMi ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">is_null($bos):</span> <?= $bosNullMu ? "true" : "false" ?></div>
</div>

<div class="kutu">
  <h2>4) Casting ile Tür Değiştirme</h2>
  <div class="satir"><span class="etiket">(int)$metin:</span> <?= htmlspecialchars((string)$metinInt) ?></div>
  <div class="satir"><span class="etiket">(float)$metin:</span> <?= htmlspecialchars((string)$metinFloat) ?></div>
  <div class="satir"><span class="etiket">(string)$sayi:</span> <?= htmlspecialchars($sayiString) ?></div>
  <div class="satir"><span class="etiket">(bool)0:</span> <?= $sifirBool ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">(bool)\"\":</span> <?= $bosStringBool ? "true" : "false" ?></div>
  <div class="satir"><span class="etiket">(bool)$metin:</span> <?= $metinBool ? "true" : "false" ?></div>
</div>

<div class="kutu">
  <h2>5) intval / floatval / strval</h2>
  <div class="satir"><span class="etiket">intval("55"):</span> <?= htmlspecialchars((string)$intvalSonuc) ?></div>
  <div class="satir"><span class="etiket">floatval("9.99"):</span> <?= htmlspecialchars((string)$floatvalSonuc) ?></div>
  <div class="satir"><span class="etiket">strval(777):</span> <?= htmlspecialchars($strvalSonuc) ?></div>
</div>

<div class="kutu">
  <h2>6) GET ile Gelen Değeri Tür Güvenliğiyle Dönüştürme</h2>
  <div class="satir"><span class="etiket">Gelen ham değer (?yas=):</span> <?= htmlspecialchars($yasHam) ?></div>
  <div class="satir"><span class="etiket">Dönüştürülmüş $yas:</span> <?= is_null($yas) ? "null" : htmlspecialchars((string)$yas) ?></div>
  <div class="satir">Denemek için: <code>?yas=18</code> veya <code>?yas=abc</code></div>
</div>

</body>
</html>
