<?php
$email = '';
$sonuc = '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    /*
        E-posta regex:
        - kullanıcı adı (harf, sayı, ., _, -)
        - @ zorunlu
        - domain adı
        - uzantı (.com, .net vs.)
    */
    $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($pattern, $email)) {
        $sonuc = 'gecerli';
        $mesaj = '✅ Geçerli e-posta adresi';
    } else {
        $sonuc = 'gecersiz';
        $mesaj = '❌ Geçersiz e-posta adresi';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>E-Posta Kontrolü</title>
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
    <h2>E-Posta Kontrolü (Regex)</h2>

    <form method="post">
        <input 
            type="text" 
            name="email" 
            placeholder="Örn: ornek@mail.com"
            value="<?php echo htmlspecialchars($email); ?>"
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