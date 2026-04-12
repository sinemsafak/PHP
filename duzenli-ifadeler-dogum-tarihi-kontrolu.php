<?php
$tarih = '';
$sonuc = '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarih = trim($_POST['tarih'] ?? '');

    // Format: GG/AA/YYYY
    $pattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/';

    if (preg_match($pattern, $tarih)) {

        // Gün, ay, yıl parçalama
        list($gun, $ay, $yil) = explode('/', $tarih);

        // Gerçek tarih kontrolü
        if (checkdate((int)$ay, (int)$gun, (int)$yil)) {
            $sonuc = 'gecerli';
            $mesaj = '✅ Geçerli doğum tarihi';
        } else {
            $sonuc = 'gecersiz';
            $mesaj = '❌ Geçersiz tarih (takvimde yok)';
        }

    } else {
        $sonuc = 'gecersiz';
        $mesaj = '❌ Hatalı format (GG/AA/YYYY olmalı)';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Doğum Tarihi Kontrolü</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 30px;
        }
        .kapsayici {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
        }
        button {
            background: #0078d7;
            color: white;
            border: none;
            border-radius: 6px;
        }
        .sonuc {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }
        .gecerli {
            background: #e6ffed;
            color: green;
        }
        .gecersiz {
            background: #ffe6e6;
            color: red;
        }
    </style>
</head>
<body>

<div class="kapsayici">
    <h2>Doğum Tarihi Kontrolü (Regex + PHP)</h2>

    <form method="post">
        <input type="text" name="tarih" placeholder="Örn: 25/12/2000" value="<?php echo htmlspecialchars($tarih); ?>">
        <button type="submit">Kontrol Et</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="sonuc <?php echo $sonuc; ?>">
            <?php echo $mesaj; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>