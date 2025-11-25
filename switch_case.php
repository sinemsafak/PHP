<?php
// --------------------------------------------
// Switch–Case ile gün ismi belirleme
// --------------------------------------------

// $gun değişkenine bir sayı atıyoruz
// Bu sayı haftanın gününü temsil etsin
$gun = 3;

// switch ifadesi $gun değişkenini kontrol eder
switch ($gun) {

    case 1:
        // Eğer $gun = 1 ise bu satır çalışır
        echo "Bugün Pazartesi";
        break; // break ile switch'ten çıkılır

    case 2:
        // Eğer $gun = 2 ise bu satır çalışır
        echo "Bugün Salı";
        break;

    case 3:
        // Eğer $gun = 3 ise bu satır çalışır
        echo "Bugün Çarşamba";
        break;

    case 4:
        echo "Bugün Perşembe";
        break;

    case 5:
        echo "Bugün Cuma";
        break;

    case 6:
        echo "Bugün Cumartesi";
        break;

    case 7:
        echo "Bugün Pazar";
        break;

    default:
        // Hiçbir case uyuşmazsa burası çalışır
        echo "Geçersiz gün numarası!";
        break;
}
?>
