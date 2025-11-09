<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

function out($label, $value) {
    if (is_bool($value)) $value = $value ? 'true' : 'false';
    elseif (is_array($value)) $value = var_export($value, true);
    echo $label . ' => ' . $value . PHP_EOL;
}
?><!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<title>PHP Operatörleri – Canlı Örnekler</title>
<style>
  body{font:16px/1.5 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin:24px; color:#111; background:#f7fafc}
  h1{margin:0 0 8px}
  h2{margin-top:28px; border-bottom:2px solid #e2e8f0; padding-bottom:6px}
  pre{background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:14px; overflow:auto}
  code{font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace}
  .note{color:#555}
</style>
</head>
<body>
<h1>PHP OPERATORS – Çıktılı Örnekler</h1>
<p class="note">Bu sayfa, her operatör grubuna ait küçük örnekler çalıştırıp sonuçlarını gösterir.</p>

<?php
/* ------------------------- Arithmetic operators ------------------------- */
echo "<h2>1) Arithmetic operators</h2><pre>";
$a = 10; $b = 3;
out('a + b', $a + $b);
out('a - b', $a - $b);
out('a * b', $a * $b);
out('a / b', $a / $b);
out('a % b (mod)', $a % $b);
out('a ** b (üs)', $a ** $b);
echo "</pre>";

/* ------------------------- Assignment operators ------------------------- */
echo "<h2>2) Assignment operators</h2><pre>";
$x = 5; out('$x = 5', $x);
$x += 2; out('$x += 2', $x);
$x -= 1; out('$x -= 1', $x);
$x *= 4; out('$x *= 4', $x);
$x /= 2; out('$x /= 2', $x);
$x %= 3; out('$x %= 3', $x);
$x = 2; $x **= 3; out('$x **= 3', $x);
echo "</pre>";

/* ------------------------- Comparison operators ------------------------- */
echo "<h2>3) Comparison operators</h2><pre>";
$c = 7; $d = '7';
out('7 == "7"', $c == $d);     // değer eşitliği
out('7 === "7"', $c === $d);   // tür + değer
out('7 != "7"', $c != $d);
out('7 !== "7"', $c !== $d);
out('7 < 10',  $c < 10);
out('7 >= 7',  $c >= 7);
out('7 <=> 10 (spaceship)', $c <=> 10); // -1:sol küçük, 0:eşit, 1:sol büyük
echo "</pre>";

/* ------------------------- Increment/Decrement operators ------------------------- */
echo "<h2>4) Increment / Decrement operators</h2><pre>";
$y = 10;
out('Başlangıç $y', $y);
out('++$y (ön ek artış)', ++$y); // önce artır sonra kullan
out('$y++ (son ek artış, önceki değer)', $y++); // önce kullan, sonra artır
out('Artış sonrası $y', $y);
out('--$y (ön ek azalış)', --$y);
out('$y-- (son ek azalış, önceki değer)', $y--);
out('Azalış sonrası $y', $y);
echo "</pre>";

/* ------------------------- Logical operators ------------------------- */
echo "<h2>5) Logical operators</h2><pre>";
$t = true; $f = false;
out('true && false', $t && $f);
out('true || false', $t || $f);
out('!false', !$f);
out('true xor true', $t xor true); // tam biri true ise
echo "</pre>";

/* ------------------------- String operators ------------------------- */
echo "<h2>6) String operators</h2><pre>";
$s = "Merhaba";
$s2 = " PHP";
out('"Merhaba" . " PHP"', $s . $s2);
$s3 = "Merhaba";
$s3 .= " Dünya"; // birleştir ve ata
out('$s3 .= " Dünya"', $s3);
echo "</pre>";

/* ------------------------- Array operators ------------------------- */
echo "<h2>7) Array operators</h2><pre>";
$arr1 = ['a' => 1, 'b' => 2];
$arr2 = ['b' => 9, 'c' => 3];

out('$arr1 + $arr2 (Birleşim / union)', $arr1 + $arr2); // soldaki anahtar baskın
out('$arr1 == ["a"=>1,"b"=>2]', $arr1 == ['a'=>1,'b'=>2]); // değer eşitliği, sıra önemsiz
out('$arr1 === ["a"=>1,"b"=>2]', $arr1 === ['a'=>1,'b'=>2]); // tür+sıra+anahtar
out('array_diff_assoc($arr2, $arr1)', array_diff_assoc($arr2, $arr1));
echo "</pre>";

/* ------------------------- Conditional assignment operators ------------------------- */
echo "<h2>8) Conditional assignment operators</h2><pre>";
$puan = 84;
$durum = ($puan >= 50) ? 'Geçti' : 'Kaldı';     // ternary
out('Ternary: $puan >= 50 ? "Geçti" : "Kaldı"', $durum);

$kullaniciAdi = null;
$gorunenAd = $kullaniciAdi ?? 'Misafir';        // null coalescing
out('Null coalescing: $kullaniciAdi ?? "Misafir"', $gorunenAd);
echo "</pre>";
?>

</body>
</html>
