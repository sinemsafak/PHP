<?php

?><!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <title>PHP Numbers — Tek Sayfa Örnekleri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root{--fg:#0b1220;--bg:#f7fafc;--card:#ffffff;--muted:#6b7280;--ok:#155e75}
    *{box-sizing:border-box}
    body{margin:0;background:var(--bg);color:var(--fg);font:16px/1.55 system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial}
    header{padding:24px 16px 8px;max-width:980px;margin:auto}
    h1{margin:0 0 8px;font-size:28px}
    p.lead{margin:0;color:var(--muted)}
    main{max-width:980px;margin:16px auto;padding:0 16px 48px;display:grid;gap:16px}
    section{background:var(--card);border-radius:14px;padding:18px 16px 14px;box-shadow:0 1px 2px rgba(0,0,0,.06)}
    h2{margin:0 0 10px;font-size:20px}
    details{margin-top:8px}
    summary{cursor:pointer;color:var(--ok)}
    pre{background:#0f172a;color:#e5e7eb;padding:12px;border-radius:10px;overflow:auto}
    code{font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace}
    .kv{display:grid;grid-template-columns:180px 1fr;gap:6px 12px;margin-top:8px}
    .pill{display:inline-block;background:#e2e8f0;color:#0f172a;border-radius:999px;padding:2px 8px;font-size:12px}
    hr{border:0;border-top:1px solid #e5e7eb;margin:14px 0}
  </style>
</head>
<main>

<?php
/***************
 * 1) PHP NUMBERS — otomatik tür dönüşümü
 ***************/
?>
<section>
  <h2>1 PHP Numbers — Otomatik Tür Dönüşümü</h2>
  <div class="kv">
    <div><span class="pill">Açıklama</span></div>
    <div>PHP, atanan değere göre değişken türünü otomatik değiştirir.</div>
  </div>
  <hr>
  <?php
    $deger = 10;               // integer
    $tip1  = gettype($deger);

    $deger = "10";             // string
    $tip2  = gettype($deger);

    $sonuc = $deger + 5;       // "10" + 5 -> 15 (string otomatik sayıya döner)
    $tip3  = gettype($sonuc);
  ?>
  <div class="kv">
    <div>İlk atama</div><div><?= htmlspecialchars($tip1) ?> (10)</div>
    <div>Sonraki atama</div><div><?= htmlspecialchars($tip2) ?> ("10")</div>
    <div>Toplama sonucu</div><div><?= $sonuc ?> — tür: <?= htmlspecialchars($tip3) ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$deger = 10;
echo gettype($deger);

$deger = "10";
echo gettype($deger);

$sonuc = $deger + 5;
echo $sonuc . " (" . gettype($sonuc) . ")";</code></pre></details>
</section>

<?php
/***************
 * 2) PHP INTEGERS
 ***************/
?>
<section>
  <h2>2 PHP Integers</h2>
  <?php
    $a = 123;     // decimal
    $b = -456;    // negative
    $c = 0x1A;    // hexadecimal -> 26
    $d = 0755;    // octal -> 493
    $isIntA = is_int($a);
    $aliases = ['is_int' => is_int($a), 'is_integer' => is_integer($a), 'is_long' => is_long($a)];
  ?>
  <div class="kv">
    <div>Decimal (a)</div><div><?= $a ?></div>
    <div>Negatif (b)</div><div><?= $b ?></div>
    <div>Hexadecimal (c)</div><div><?= $c ?> (0x1A)</div>
    <div>Octal (d)</div><div><?= $d ?> (0755)</div>
    <div>is_int($a)</div><div><?= $isIntA ? 'true' : 'false' ?></div>
    <div>Takma adlar</div>
    <div>is_integer → <?= $aliases['is_integer'] ? 'true' : 'false' ?>,
        is_long → <?= $aliases['is_long'] ? 'true' : 'false' ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$a = 123;
$b = -456;
$c = 0x1A;
$d = 0755;

is_int($a);      // true
is_integer($a);  // is_int takma adı
is_long($a);     // is_int takma adı</code></pre></details>
</section>

<?php
/***************
 * 3) PHP FLOATS
 ***************/
?>
<section>
  <h2>3 PHP Floats</h2>
  <?php
    $x = 10.5;
    $y = 2.3e3;        // 2300
    $z = 5.56E-5;      // 0.0000556
    $xIsFloat = is_float($x);
    $aliasDouble = is_double($x); // is_float takma adı
  ?>
  <div class="kv">
    <div>$x</div><div><?= $x ?></div>
    <div>$y</div><div><?= $y ?></div>
    <div>$z</div><div><?= $z ?></div>
    <div>is_float($x)</div><div><?= $xIsFloat ? 'true' : 'false' ?></div>
    <div>is_double($x)</div><div><?= $aliasDouble ? 'true' : 'false' ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$x = 10.5;
$y = 2.3e3;
$z = 5.56E-5;

is_float($x);   // true
is_double($x);  // is_float takma adı</code></pre></details>
</section>

<?php
/***************
 * 4) PHP INFINITY (sonsuzluk)
 ***************/
?>
<section>
  <h2>4 PHP Infinity (Sonsuzluk)</h2>
  <?php
    $beyond = PHP_FLOAT_MAX * 2;   // PHP_FLOAT_MAX'tan büyük -> sonsuz
    $isInf  = is_infinite($beyond);
    $isFin  = is_finite($beyond);
  ?>
  <div class="kv">
    <div>PHP_FLOAT_MAX × 2</div><div><?= $beyond ?></div>
    <div>is_infinite()</div><div><?= $isInf ? 'true' : 'false' ?></div>
    <div>is_finite()</div><div><?= $isFin ? 'true' : 'false' ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$beyond = PHP_FLOAT_MAX * 2;
is_infinite($beyond); // true
is_finite($beyond);   // false</code></pre></details>
</section>

<?php
/***************
 * 5) PHP NaN
 ***************/
?>
<section>
  <h2>5 PHP NaN (Not a Number)</h2>
  <?php
    $nan = acos(8);  // -1..1 dışı -> NAN
    $isNan = is_nan($nan);
  ?>
  <div class="kv">
    <div>acos(8)</div><div><?= $nan ?></div>
    <div>is_nan()</div><div><?= $isNan ? 'true' : 'false' ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$nan = acos(8);  // imkansız işlem
is_nan($nan);    // true</code></pre></details>
</section>

<?php
/***************
 * 6) PHP Numerical Strings
 ***************/
?>
<section>
  <h2>6 PHP Numerical Strings</h2>
  <?php
    $xs = "12345";
    $ys = "12.34";
    $zs = "merhaba";
    $hexString = "0xf4c3b00c";  // PHP 7+ için is_numeric -> false
  ?>
  <div class="kv">
    <div>$x = "12345"</div><div><?= is_numeric($xs) ? 'sayısal (true)' : 'false' ?></div>
    <div>$y = "12.34"</div><div><?= is_numeric($ys) ? 'sayısal (true)' : 'false' ?></div>
    <div>$z = "merhaba"</div><div><?= is_numeric($zs) ? 'sayısal (true)' : 'false' ?></div>
    <div>$hex = "0xf4c3b00c"</div><div><?= is_numeric($hexString) ? 'true' : 'false (PHP 7+)' ?></div>
  </div>
  <details><summary>Kullanılan Kod</summary><pre><code>$x = "12345";
$y = "12.34";
$z = "merhaba";
$hex = "0xf4c3b00c";

is_numeric($x);   // true
is_numeric($y);   // true
is_numeric($z);   // false
is_numeric($hex); // PHP 7.0+ -> false</code></pre></details>
</section>

</main>
</body>
</html>
