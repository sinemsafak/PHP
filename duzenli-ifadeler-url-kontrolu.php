<?php
$url = '';
$sonuc = '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = trim($_POST['url'] ?? '');

    /*
        URL regex:
        - http:// veya https:// ile başlayabilir
        - www olabilir
        - alan adı zorunlu
        - uzantı zorunlu
        - yol bilgisi opsiyonel
    */
    $pattern = '/^(https?:\/\/)?(www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}([\/\w\-.?=&%+]*)?$/';

    if (preg_match($pattern, $url)) {
        $sonuc = 'gecerli';
        $mesaj = '✅ Geçerli URL';
    } else {
        $sonuc = 'gecersiz';
        $mesaj = '❌ Geçersiz URL';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Düzenli İfadelerle URL Kontrolü</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }
        .kapsayici {
            max-width: 650px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0078d7;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
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
    <h1>URL Kontrolü</h1>

    <form method="post">
        <label for="url">URL Giriniz:</label>
        <input 
            type="text" 
            name="url" 
            id="url" 
            placeholder="Örn: https://www.ornek.com"
            value="<?php echo htmlspecialchars($url); ?>"
        >
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