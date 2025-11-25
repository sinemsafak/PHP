<?php
// --------------------------------------------
// 1) Basit if yapısı
// --------------------------------------------

// $sayi değişkenine 10 değerini atıyoruz
$sayi = 10;

// Eğer $sayi 0'dan büyükse bu kod çalışır
if ($sayi > 0) {
    // Şart doğru olduğu için ekrana bu yazı basılır
    echo "1) \$sayi pozitiftir.<br>";
}



// --------------------------------------------
// 2) if ... else yapısı
// --------------------------------------------

// $yas değişkenine 16 değerini atıyoruz
$yas = 16;

// Eğer yaş 18 veya daha büyükse bu blok çalışır
if ($yas >= 18) {
    echo "2) Reşitsiniz.<br>";
} else {
    // Eğer yukarıdaki şart sağlanmazsa (yani yaş < 18 ise) bu blok çalışır
    echo "2) Reşit değilsiniz.<br>";
}



// --------------------------------------------
// 3) if ... elseif ... else yapısı
// --------------------------------------------

// $not değişkenine 72 değerini atıyoruz
$not = 72;

// Eğer not 90 veya üzeriyse bu blok çalışır
if ($not >= 90) {
    echo "3) Notunuz: AA<br>";

// Eğer üstteki şart sağlanmazsa ve not 80 veya üzeriyse bu blok çalışır
} elseif ($not >= 80) {
    echo "3) Notunuz: BA<br>";

// Eğer ilk iki şart sağlanmadıysa ve not 70 veya üzeriyse bu blok çalışır
} elseif ($not >= 70) {
    echo "3) Notunuz: BB<br>";

// Yukarıdaki hiçbir şart sağlanmadıysa bu son blok çalışır
} else {
    echo "3) Dersten kaldınız.<br>";
}
?>
