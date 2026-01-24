<?php
/**************************************************************
 * PHP RECURSIVE (KENDİNİ ÇAĞIRAN) FONKSİYON DEMOSU
 * İç içe recursive örnekler - tek sayfa
 **************************************************************/

/* ------------------------------------------------------------
   1) En basit recursive örnek: Faktöriyel
   ------------------------------------------------------------ */

/*
 factorial(5) =
 5 * factorial(4)
 4 * factorial(3)
 3 * factorial(2)
 2 * factorial(1)
 1 -> DURMA NOKTASI (base case)
*/
function factorial($n)
{
    // Base case (durma noktası)
    if ($n <= 1) {
        return 1;
    }

    // Fonksiyon kendi kendini çağırıyor
    return $n * factorial($n - 1);
}

$faktoriyelSonuc = factorial(5);


/* ------------------------------------------------------------
   2) Recursive sayı toplama
   ------------------------------------------------------------ */

/*
 sumRecursive(4) =
 4 + sumRecursive(3)
 3 + sumRecursive(2)
 2 + sumRecursive(1)
 1 -> DUR
*/
function sumRecursive($n)
{
    if ($n <= 1) {
        return 1;
    }

    return $n + sumRecursive($n - 1);
}

$toplamSonuc = sumRecursive(6);


/* ------------------------------------------------------------
   3) İç içe recursive örnek (dizi içinde dizi gezme)
   ------------------------------------------------------------ */

/*
 Çok katmanlı dizi (klasör yapısı gibi düşün)
*/
$dosyalar = [
    "index.php",
    "assets" => [
        "css" => [
            "style.css",
            "theme.css"
        ],
        "js" => [
            "app.js",
            "main.js"
        ]
    ],
    "readme.txt"
];

/*
 Bu fonksiyon dizinin içi içe kaç kat olursa olsun
 tüm elemanları yazdırır.
*/
function diziyiGez($dizi, $seviye = 0)
{
    foreach ($dizi as $key => $value) {

        // Girinti için boşluk üret (görsel amaçlı)
        echo str_repeat("&nbsp;", $seviye * 6);

        // Eğer eleman da bir dizi ise
        if (is_array($value)) {

            // Klasör ismini yaz
            echo "<b>$key/</b><br>";

            // Fonksiyon KENDİNİ tekrar çağırıyor
            diziyiGez($value, $seviye + 1);

        } else {

            // Normal dosya ise direkt yaz
            echo $value . "<br>";
        }
    }
}


/* ------------------------------------------------------------
   4) İç içe recursive fonksiyon (bir fonksiyon diğerini çağırıyor)
   ------------------------------------------------------------ */

function A($n)
{
    if ($n <= 0) return;

    echo "A($n)<br>";

    // A fonksiyonu B'yi çağırıyor
    B($n - 1);
}

function B($n)
{
    if ($n <= 0) return;

    echo "B($n)<br>";

    // B tekrar A'yı çağırıyor
    A($n - 1);
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Recursive Fonksiyon Demo</title>
    <style>
        body { font-family: Arial; background:#0f172a; color:#e2e8f0; padding:20px; }
        .kutu { background:#111827; padding:15px; border-radius:10px; margin-bottom:15px; }
        code { background:#1f2937; padding:3px 6px; border-radius:6px; }
    </style>
</head>
<body>

<div class="kutu">
    <h2>1) Faktöriyel Recursive</h2>
    <p><code>factorial(5)</code></p>
    <p><b>Sonuç:</b> <?= $faktoriyelSonuc ?></p>
</div>

<div class="kutu">
    <h2>2) Recursive Toplama</h2>
    <p><code>sumRecursive(6)</code></p>
    <p><b>Sonuç:</b> <?= $toplamSonuc ?></p>
</div>

<div class="kutu">
    <h2>3) İç İçe Dizi Recursive Gezinme</h2>
    <?php diziyiGez($dosyalar); ?>
</div>

<div class="kutu">
    <h2>4) İç İçe Recursive Fonksiyonlar (A ↔ B)</h2>
    <?php A(5); ?>
</div>

</body>
</html>
