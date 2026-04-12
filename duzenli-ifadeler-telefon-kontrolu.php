<?php
$telefon = '';
$sonuc = '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telefon = $_POST['telefon'] ?? '';

    // Boşlukları temizle
    $telefon = trim($telefon);

    /*
        Türkiye telefon numarası regex:
        - +905xxxxxxxxx
        - 905xxxxxxxxx
        - 05xxxxxxxxx
    */
    $pattern = '/^(?:\+90|90|0)?5\d{9}$/';

    if (preg_match($pattern, $telefon)) {
        $sonuc = 'gecerli';
        $mesaj = '✅ Geçerli telefon numarası';
    } else {
        $sonuc = 'gecersiz';
        $mesaj = '❌ Geçersiz telefon numarası';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Düzenli İfadeler ile Telefon Kontrolü</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }
        .kapsayici {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0078d7;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #005fa3;
        }
        .sonuc {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }
        .gecerli {
            background: #e6ffed;
            color: #1a7f37;
        }
        .gecersiz {
            background: #ffe6e6;
            color: #b30000;
        }
    </style>
</head>
<body>

<div class="kapsayici">
    <h1>Telefon Numarası Kontrolü</h1>

    <form method="post">
        <label>Telefon Numarası Gir:</label>
        <input type="text" name="telefon" placeholder="Örn: 05xxxxxxxxx" value="<?php echo htmlspecialchars($telefon); ?>">
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