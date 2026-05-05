<?php
date_default_timezone_set("Europe/Istanbul");

// Örnek tarih
$year = 2026;
$month = 5;
$day = 5;

// Ayın gün sayısı
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Julian Day hesapla
$jd = gregoriantojd($month, $day, $year);

// Haftanın günü
$dayOfWeek = jddayofweek($jd, 1);

// Ay adı
$monthName = jdmonthname($jd, 1);

// Paskalya tarihi
$easter = date("d-m-Y", easter_date($year));

// 21 Mart sonrası Paskalya günü farkı
$easterDays = easter_days($year);

// Takvim bilgisi
$calendarInfo = cal_info(CAL_GREGORIAN);

// Dönüşümler
$gregorian = jdtogregorian($jd);
$julian = jdtojulian($jd);
$jewish = jdtojewish($jd);

// Liste
$data = [
    ["Ayın Gün Sayısı", $daysInMonth],
    ["Julian Day", $jd],
    ["Haftanın Günü", $dayOfWeek],
    ["Ay Adı", $monthName],
    ["Paskalya Tarihi", $easter],
    ["Paskalya Gün Farkı", $easterDays],
    ["Gregorian Tarih", $gregorian],
    ["Julian Tarih", $julian],
    ["Jewish Tarih", $jewish],
    ["Takvim Adı", $calendarInfo["calname"]]
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>PHP Calendar Functions</title>

<style>
body {
    margin: 0;
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #1d4350, #a43931);
    color: white;
}

.container {
    max-width: 950px;
    margin: 60px auto;
    padding: 20px;
}

.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h1 {
    font-size: 40px;
    letter-spacing: 1px;
}

.card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    padding: 15px;
    background: rgba(255,255,255,0.2);
    font-size: 18px;
}

td {
    padding: 14px;
    border-bottom: 1px solid rgba(255,255,255,0.15);
}

tr:hover {
    background: rgba(255,255,255,0.15);
}

.badge {
    background: #00ffc3;
    color: #003333;
    padding: 6px 12px;
    border-radius: 15px;
    font-weight: bold;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #ddd;
}
</style>

</head>

<body>

<div class="container">

    <div class="header">
        <h1>PHP Calendar Functions</h1>
        <p>Takvim fonksiyonları örnek kullanımı</p>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Fonksiyon</th>
                <th>Sonuç</th>
            </tr>

            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= $item[0] ?></td>
                    <td><span class="badge"><?= $item[1] ?></span></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <div class="footer">
        cal_days_in_month, gregoriantojd, jddayofweek, jdmonthname, easter_date, easter_days
    </div>

</div>

</body>
</html>