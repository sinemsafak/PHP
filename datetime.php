<?php
date_default_timezone_set("Europe/Istanbul");

$date = date_create("2026-05-05 12:00:00");

$formattedDate = date_format($date, "d.m.Y H:i:s");

date_add($date, date_interval_create_from_date_string("5 days"));
$addedDate = date_format($date, "d.m.Y H:i:s");

date_sub($date, date_interval_create_from_date_string("2 days"));
$subtractedDate = date_format($date, "d.m.Y H:i:s");

$date1 = date_create("2026-05-01");
$date2 = date_create("2026-05-10");
$diff = date_diff($date1, $date2);

$timestamp = date_timestamp_get($date);

$sunInfo = date_sun_info(time(), 41.0082, 28.9784);
$sunrise = date("H:i:s", $sunInfo["sunrise"]);
$sunset = date("H:i:s", $sunInfo["sunset"]);

$items = [
    ["Formatlanmış Tarih", $formattedDate],
    ["5 Gün Eklenmiş Tarih", $addedDate],
    ["2 Gün Çıkarılmış Tarih", $subtractedDate],
    ["İki Tarih Arasındaki Fark", $diff->format("%a gün")],
    ["Unix Zaman Damgası", $timestamp],
    ["Gün Doğumu", $sunrise],
    ["Gün Batımı", $sunset],
    ["Zaman Dilimi", date_default_timezone_get()]
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Date Time</title>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
        }

        .container {
            width: 85%;
            max-width: 900px;
            margin: 50px auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 42px;
            margin-bottom: 8px;
        }

        .header p {
            color: #cfe9f1;
            font-size: 18px;
        }

        .card {
            background: rgba(255, 255, 255, 0.13);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 14px;
        }

        th {
            background: rgba(255, 255, 255, 0.22);
            padding: 16px;
            text-align: left;
            font-size: 18px;
        }

        td {
            padding: 15px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            font-size: 17px;
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .badge {
            display: inline-block;
            background: #00d4ff;
            color: #102027;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #cfe9f1;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="header">
        <h1>PHP Date & Time</h1>
        <p>PHP tarih ve zaman fonksiyonları demo ekranı</p>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>İşlem</th>
                <th>Sonuç</th>
            </tr>

            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item[0] ?></td>
                    <td><span class="badge"><?= $item[1] ?></span></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <div class="footer">
        checkdate, date_add, date_sub, date_diff, date_format, date_sun_info
    </div>
</div>

</body>
</html>