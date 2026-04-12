<?php
$orijinalMetin = '';
$temizMetin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orijinalMetin = $_POST['html_kodu'] ?? '';

    $temizMetin = $orijinalMetin;

    // HTML yorumlarını sil
    $temizMetin = preg_replace('/<!--.*?-->/s', '', $temizMetin);

    // Script etiketlerini içerikleriyle birlikte sil
    $temizMetin = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $temizMetin);

    // Style etiketlerini içerikleriyle birlikte sil
    $temizMetin = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $temizMetin);

    // Tüm HTML etiketlerini kaldır
    $temizMetin = preg_replace('/<[^>]+>/', ' ', $temizMetin);

    // HTML entity'lerini normal karaktere çevir
    $temizMetin = html_entity_decode($temizMetin, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Fazla boşlukları temizle
    $temizMetin = preg_replace('/\s+/', ' ', $temizMetin);

    // Baştaki ve sondaki boşlukları kaldır
    $temizMetin = trim($temizMetin);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Düzenli İfadeler ile HTML Kodlarını Temizleme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }
        .kapsayici {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            color: #555;
        }
        textarea {
            width: 100%;
            min-height: 180px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
            font-size: 15px;
            margin-top: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        button {
            background: #0078d7;
            color: #fff;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }
        button:hover {
            background: #005fa3;
        }
        .sonuc {
            margin-top: 25px;
            padding: 18px;
            background: #f9fafb;
            border-left: 5px solid #0078d7;
            border-radius: 8px;
        }
        .etiket {
            font-weight: bold;
            margin-bottom: 8px;
            color: #222;
        }
        .metin-kutusu {
            background: #fff;
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 8px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="kapsayici">
        <h1>Düzenli İfadeler ile HTML Kodlarını Temizleme</h1>
        <p>
            Aşağıdaki alana HTML kodunu yapıştır ve temizleme işlemini başlat.
        </p>

        <form method="post">
            <label for="html_kodu"><strong>HTML Kodu:</strong></label>
            <textarea name="html_kodu" id="html_kodu" placeholder="<h1>Merhaba</h1><p>Bu bir <b>örnek</b> yazıdır.</p><?php echo htmlspecialchars($orijinalMetin); ?></textarea>
            <button type="submit">HTML Kodunu Temizle</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="sonuc">
                <div class="etiket">Orijinal İçerik:</div>
                <div class="metin-kutusu"><?php echo htmlspecialchars($orijinalMetin); ?></div>
            </div>

            <div class="sonuc">
                <div class="etiket">Temizlenmiş Metin:</div>
                <div class="metin-kutusu"><?php echo htmlspecialchars($temizMetin); ?></div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>