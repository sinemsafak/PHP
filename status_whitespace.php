<?php
/***************************************************************
 * TEK SAYFA DEMO:
 * 1) HTTP Durum Kodları (Status Codes)
 * 2) White Space (boşluk/BOM) ve header() ilişkisi
 * 3) Output Buffering (ob_start) ile çözüm
 ***************************************************************/

/* -------------------------------------------------------------
   0) Ayarlar / parametreler
   ------------------------------------------------------------- */

/* GET ile gelen "code" parametresi (örn: ?code=404) */
$code = isset($_GET['code']) ? (int)$_GET['code'] : 200; // yoksa 200 varsay

/* GET ile buffering aç/kapat (örn: ?buffer=1) */
$bufferEnabled = isset($_GET['buffer']) && $_GET['buffer'] === '1'; // 1 ise true

/* GET ile "kasıtlı whitespace üret" (örn: ?ws=1) */
$forceWhitespace = isset($_GET['ws']) && $_GET['ws'] === '1'; // 1 ise true

/* -------------------------------------------------------------
   1) Output Buffering (White space sorununu önlemek için)
   ------------------------------------------------------------- */

/*
 ob_start() açılırsa, echo ile çıkan şeyler önce tamponda birikir.
 Bu sayede header() göndermeden önce istemeden çıktı basılsa bile,
 PHP çoğu durumda "headers already sent" hatasına düşmez.
*/
if ($bufferEnabled) {
    ob_start(); // Çıktıyı buffer'a al
}

/* -------------------------------------------------------------
   2) Durum kodları için kısa açıklama listesi
   ------------------------------------------------------------- */

$statusMap = [
    200 => 'OK (Başarılı)',
    301 => 'Moved Permanently (Kalıcı yönlendirme)',
    302 => 'Found (Geçici yönlendirme)',
    400 => 'Bad Request (Hatalı istek)',
    401 => 'Unauthorized (Yetkisiz)',
    403 => 'Forbidden (Erişim yasak)',
    404 => 'Not Found (Bulunamadı)',
    500 => 'Internal Server Error (Sunucu hatası)',
    503 => 'Service Unavailable (Servis kullanılamıyor)',
];

/* Seçilen kod listede yoksa 200'e çek */
if (!array_key_exists($code, $statusMap)) {
    $code = 200; // geçersiz kod gelirse 200 yap
}

/* -------------------------------------------------------------
   3) White space (boşluk) problemi demoları
   ------------------------------------------------------------- */

/*
 White space problemi şu şekilde olur:
 - PHP kapanır, araya boşluk/satır başı gelir, tekrar PHP açılır
 - ya da dosyanın en başında BOM/boşluk olur
 - ya da header() göndermeden önce echo yapılır
 Bunlar "headers already sent" hatasına sebep olabilir.
*/
if ($forceWhitespace) {
    echo "   \n"; // KASITLI boşluk + newline basıyoruz (white space)
    // Bu çıktı, header göndermeden önce gelirse sorun çıkarabilir.
}

/* -------------------------------------------------------------
   4) Durum kodunu gönderme
   ------------------------------------------------------------- */

/*
 http_response_code($code):
 - HTTP response status code'u ayarlar.
 - Tarayıcı / istemci bu kodu görür (Network tabında).
*/
http_response_code($code);

/*
 Bazı durum kodlarında tipik kullanım örnekleri:
 - 301/302 yönlendirme: Location header'ı
 - (Not: Location kullanırsan genelde exit; yapılır)
*/
if ($code === 301 || $code === 302) {
    /*
     header("Location: ...", true, $code):
     - Location başlığını gönderir
     - true: aynı header varsa replace et
     - $code: durum kodunu 301/302 yap
    */
    header("Location: ?code=200&buffer=" . ($bufferEnabled ? "1" : "0") . "&ws=0", true, $code);

    /*
     Yönlendirmelerde genelde exit kullanılır.
     Bu demo sayfasında, içerik de görünsün diye exit kullanmıyoruz.
     (Gerçek projede exit önerilir.)
    */
}

/* -------------------------------------------------------------
   5) Header gönderildi mi kontrolü (white space hatasını anlamak)
   ------------------------------------------------------------- */

/*
 headers_sent():
 - Header'lar zaten gönderildi mi? true/false döner
 - Eğer gönderildiyse artık header()/status code değiştirmek riskli
*/
$headersAlreadySent = headers_sent($sentFile, $sentLine); // nerede gönderildi bilgisini de al

/* -------------------------------------------------------------
   6) Demo amaçlı "header() gönderme denemesi"
   ------------------------------------------------------------- */

/*
 Eğer white space yüzünden header'lar erken gönderildiyse,
 aşağıdaki header() çağrısı uyarı üretebilir (ortama göre).
 Biz yine de durumu sayfada göstereceğiz.
*/
$testHeaderResult = "Deneme yapılmadı";

/* Sadece kullanıcı isterse deneme yapalım: ?test=1 */
if (isset($_GET['test']) && $_GET['test'] === '1') {

    /*
     Bu header örnek amaçlıdır:
     X-Demo: 1 şeklinde özel bir header ekler.
    */
    if (!$headersAlreadySent) {
        header("X-Demo-Header: 1"); // Header gönder
        $testHeaderResult = "Başarılı: Header gönderildi (X-Demo-Header: 1)";
    } else {
        $testHeaderResult = "Başarısız: Header'lar zaten gönderilmiş (white space/echo yüzünden olabilir)";
    }
}

/* -------------------------------------------------------------
   7) Buffer açıksa çıktıyı flush etme
   ------------------------------------------------------------- */

/*
 ob_get_level() > 0 ise buffer açık demektir.
 ob_end_flush(): buffer'daki çıktıyı tarayıcıya gönderir ve buffer'ı kapatır.
*/
$willFlushBuffer = ($bufferEnabled && ob_get_level() > 0);

/* HTML çıktısı aşağıda başlayacak */
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Status Codes & White Space Demo</title>
    <style>
        body { font-family: Arial, sans-serif; background:#0f172a; color:#e2e8f0; padding:20px; }
        .box { background:#111827; border:1px solid #1f2937; border-radius:10px; padding:15px; margin-bottom:14px; }
        a, button { color:#93c5fd; }
        .row { display:flex; gap:10px; flex-wrap:wrap; }
        .pill { padding:6px 10px; background:#1f2937; border-radius:999px; display:inline-block; }
        code { background:#1f2937; padding:2px 6px; border-radius:6px; }
        .ok { color:#86efac; }
        .bad { color:#fca5a5; }
        select, input[type="checkbox"] { transform: translateY(1px); }
    </style>
</head>
<body>

<div class="box">
    <h2>HTTP Durum Kodları (Status Codes) + White Space Demo</h2>

    <div class="row">
        <span class="pill">Aktif Durum Kodu: <strong><?= (int)$code ?></strong></span>
        <span class="pill">Açıklama: <strong><?= htmlspecialchars($statusMap[$code]) ?></strong></span>
        <span class="pill">Buffer: <strong><?= $bufferEnabled ? "Açık" : "Kapalı" ?></strong></span>
        <span class="pill">White Space: <strong><?= $forceWhitespace ? "Kasıtlı Üretildi" : "Yok" ?></strong></span>
    </div>
</div>

<div class="box">
    <h3>1) Durum kodunu değiştir</h3>

    <form method="get">
        <!-- Durum kodu seçimi -->
        <label>Durum Kodu:</label>
        <select name="code">
            <?php foreach ($statusMap as $k => $v): ?>
                <option value="<?= (int)$k ?>" <?= $k === $code ? "selected" : "" ?>>
                    <?= (int)$k ?> - <?= htmlspecialchars($v) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Buffer aç/kapat -->
        <label style="margin-left:12px;">
            <input type="checkbox" name="buffer" value="1" <?= $bufferEnabled ? "checked" : "" ?>>
            ob_start (buffer) açık
        </label>

        <!-- White space üret -->
        <label style="margin-left:12px;">
            <input type="checkbox" name="ws" value="1" <?= $forceWhitespace ? "checked" : "" ?>>
            header öncesi white space üret
        </label>

        <!-- Header testini aç -->
        <label style="margin-left:12px;">
            <input type="checkbox" name="test" value="1" <?= (isset($_GET['test']) && $_GET['test'] === '1') ? "checked" : "" ?>>
            Header gönderimini test et
        </label>

        <button type="submit" style="margin-left:12px;">Uygula</button>
    </form>

    <p>
        Not: 301/302 seçersen <code>Location</code> header'ı örnek olarak set edilir.
        (Demo olduğu için <code>exit;</code> kullanılmadı.)
    </p>
</div>

<div class="box">
    <h3>2) Header'lar gönderildi mi?</h3>

    <?php if ($headersAlreadySent): ?>
        <p class="bad"><strong>headers_sent(): Evet</strong> — Header'lar şu noktada gönderilmiş:</p>
        <p><code><?= htmlspecialchars($sentFile) ?></code> dosyası, satır <code><?= (int)$sentLine ?></code></p>
        <p>
            Sebep genelde: dosya başında boşluk/BOM, PHP kapanış etiketi sonrası boşluk,
            ya da <code>header()</code> öncesi <code>echo</code>.
        </p>
    <?php else: ?>
        <p class="ok"><strong>headers_sent(): Hayır</strong> — Header göndermek için hâlâ güvenli.</p>
    <?php endif; ?>

    <p><strong>Header test sonucu:</strong> <?= htmlspecialchars($testHeaderResult) ?></p>
</div>

<div class="box">
    <h3>3) White Space (Boşluk) nedir, neden sorun çıkarır?</h3>
    <ul>
        <li><code>header()</code> ve durum kodu, HTTP header bölümüne yazılır.</li>
        <li>Tarayıcıya <strong>en ufak çıktı</strong> (boşluk bile) giderse header bölümü kapanabilir.</li>
        <li>Bu durumda PHP: <code>Cannot modify header information - headers already sent</code> uyarısı verebilir.</li>
        <li>Çözüm: Dosya en üstünde boşluk bırakma + gerekirse <code>ob_start()</code> kullan.</li>
    </ul>
</div>

<div class="box">
    <h3>4) Bu sayfada ne yaptık?</h3>
    <ul>
        <li><code>http_response_code(<?= (int)$code ?>)</code> ile durum kodunu ayarladık.</li>
        <li><code>?ws=1</code> ile header öncesi kasıtlı boşluk bastık (white space).</li>
        <li><code>headers_sent()</code> ile header’ların erken gidip gitmediğini kontrol ettik.</li>
        <li><code>?buffer=1</code> ile <code>ob_start()</code> açıp sorunu önlemeyi gösterdik.</li>
    </ul>
</div>

<?php
/* Sayfa sonunda buffer açık ise flush edip kapatıyoruz */
if ($willFlushBuffer) {
    ob_end_flush(); // Buffer'daki çıktıyı gönder ve buffer'ı kapat
}
?>
</body>
</html>
