<?php

header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'C');

// Yardımcılar
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function row($name, $input, $output) {
    echo "<tr><td><code>".e($name)."</code></td><td>".e($input)."</td><td><pre>".e($output)."</pre></td></tr>";
}

// printf/print gibi ekrana yazanların çıktısını yakalamak için
function capture(callable $fn) { ob_start(); $fn(); return ob_get_clean(); }

// money_format alternatifi (Intl varsa onu, yoksa number_format)
function format_money_alt($amount, string $currency='TRY', string $locale='tr_TR'): string {
    if (class_exists('NumberFormatter')) {
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($amount, $currency);
    }
    $symbols = ['TRY'=>'₺','USD'=>'$','EUR'=>'€','GBP'=>'£'];
    $sym = $symbols[$currency] ?? $currency;
    $formatted = number_format((float)$amount, 2, ',', '.'); // 1.234,56
    return $currency==='TRY' ? "$formatted $sym" : "$sym $formatted";
}

// DEMO girdileri
$demoText    = "Merhaba Dünya php";
$demoUpper   = "TÜRKÇE ÇĞIŞÖÜ";
$demoLower   = "Türkçe çğışöü";
$trimText    = "   \t  merhaba  ";
$amount      = 12345.67;
$sampleQuery = "ad=Ali&yas=20";
$twoTexts    = ["merhaba","merhabo"];

?><!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<title>PHP String Metotları – Okunaklı Çıktı</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
  :root { --bg:#0e1320; --card:#141a2a; --text:#e6e8f0; --muted:#93a1b3; --accent:#5eead4; }
  body { margin:0; font:16px/1.5 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; color:var(--text); background:linear-gradient(135deg,#0b344f,#1e2c5a);}
  header { padding:24px 20px 10px; text-align:center; }
  header h1 { margin:0; font-size:24px; letter-spacing:.3px; }
  .card { background:rgba(0,0,0,.25); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,.08); margin:20px auto; max-width:1100px; border-radius:14px; overflow:hidden; }
  table { width:100%; border-collapse:collapse; }
  th, td { padding:12px 14px; vertical-align:top; }
  th { background:rgba(255,255,255,.06); text-align:left; font-weight:600; }
  tr:nth-child(even) td { background:rgba(255,255,255,.03); }
  code { background:rgba(255,255,255,.08); padding:.1rem .35rem; border-radius:6px; }
  pre { margin:0; white-space:pre-wrap; word-break:break-word; }
  .note { color:var(--muted); font-size:14px; margin:10px 0 0; }
  footer { text-align:center; color:var(--muted); padding:16px 0 28px; font-size:13px; }
</style>
</head>
<body>
<header>
  <h1>PHP String Metotları </h1>
  <p class="note">Tüm örnekler tek sayfada 
</header>

<div class="card">
<table>
  <thead>
    <tr><th>Metot</th><th>Girdi</th><th>Çıktı / Not</th></tr>
  </thead>
  <tbody>
<?php
row('join', "['a','b','c'] + '-'", join('-', ['a','b','c']));
row('lcfirst', $demoText, lcfirst($demoText));
row('ucfirst', strtolower($demoText), ucfirst(strtolower($demoText)));
row('ucwords', strtolower($demoText), ucwords(strtolower($demoText)));

row('strtoupper', $demoLower, strtoupper($demoLower));
row('strtolower', $demoUpper, strtolower($demoUpper));

row('ltrim', "␣␣␣\\t␣␣merhaba␣␣", "'".ltrim($trimText)."'");

row('md5', "gizli", md5("gizli"));
row('md5_file', '__FILE__', md5_file(__FILE__));

row('Intl para formatı (money_format alternatifi)', (string)$amount, format_money_alt($amount));

if (function_exists('nl_langinfo')) {
  row('nl_langinfo(ABDAY_1)', '-', nl_langinfo(ABDAY_1));
} else {
  row('nl_langinfo', '-', 'Bu ortamda mevcut değil.');
}

// nl2br - hem düz metin hem de HTML
$nlText = "satir1\nsatir2";
row('nl2br (HTML görünümlü)', str_replace("\n","\\n",$nlText), nl2br($nlText));

row('number_format', '1234567.891, 2, ",", "."', number_format(1234567.891, 2, ',', '.'));

row('ord', "'A'", ord('A'));

parse_str($sampleQuery, $parsed);
row('parse_str', $sampleQuery, 'ad='.$parsed['ad'].', yas='.$parsed['yas']);

// print / printf / sprintf yakalama
$printOut  = capture(function(){ print "Merhaba!"; });
$printfOut = capture(function(){ printf("%d + %d = %d", 2, 3, 2+3); });
$sprintfOut= sprintf("%s-%02d", "No", 7);

row('print', '"Merhaba!"', $printOut);
row('printf', '"%d + %d = %d", 2, 3, 5', $printfOut);
row('sprintf', '"%s-%02d","No",7', $sprintfOut);

row('quotemeta', ".+?[]^$()", quotemeta(".+?[]^$()"));

row('sha1', 'merhaba', sha1("merhaba"));
row('sha1_file', '__FILE__', sha1_file(__FILE__));

$yuzde = 0.0;
$ortak = similar_text($twoTexts[0], $twoTexts[1], $yuzde);
row('similar_text', $twoTexts[0].' vs '.$twoTexts[1], "ortak=$ortak, benzerlik=".round($yuzde,2)."%" );

row('soundex', 'Robert vs Rupert', soundex('Robert').' vs '.soundex('Rupert'));

sscanf("12-34-56", "%d-%d-%d", $h,$m,$s);
row('sscanf', '"12-34-56","%d-%d-%d"', "saat=$h, dk=$m, sn=$s");

row('str_ireplace', '"PHP"→"php" içinde "Ben PHP dilini seviyorum"', str_ireplace("PHP", "php", "Ben PHP dilini seviyorum"));

row('str_pad', '"7", 4, "0", STR_PAD_LEFT', str_pad("7", 4, "0", STR_PAD_LEFT));
?>
  </tbody>
</table>
</div>

<footer>WampServer’da direkt aç – tek dosya, temiz tablo.</footer>
</body>
</html>
