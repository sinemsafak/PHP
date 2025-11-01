<?php

// ---------- Yardımcılar ----------
function fmt($v) {
    // bool
    if (is_bool($v)) return $v ? 'true' : 'false';

    // float ise: NaN/INF kontrolleri + biçimlendirme
    if (is_float($v)) {
        if (is_nan($v))      return 'NAN';
        if (is_infinite($v)) return ($v > 0 ? 'INF' : '-INF');
        return rtrim(rtrim(number_format($v, 10, '.', ''), '0'), '.'); // 10 basamak, gereksiz sıfırlar atılır
    }

    // int
    if (is_int($v)) return (string)$v;

    // string
    if (is_string($v)) return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');

    // diğer (dizi/obje vs.)
    return htmlspecialchars(var_export($v, true), ENT_QUOTES, 'UTF-8');
}
function row($name, $desc, $value) {
    echo "<tr><td><code>$name</code></td><td>$desc</td><td><strong>".fmt($value)."</strong></td></tr>";
}
function section_start($title){
    echo "<h2>$title</h2><table><thead><tr><th>Fonksiyon</th><th>Ne yapar?</th><th>Değer</th></tr></thead><tbody>";
}
function section_end(){ echo "</tbody></table>"; }


// ---------- Sayfa başı / stil ----------
echo '<!doctype html><html lang="tr"><head><meta charset="utf-8"><title>PHP Math Functions </title>
<style>
body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif; line-height:1.45; padding:24px; background:#f7f7f8}
h1{margin:0 0 6px}
h2{margin:28px 0 8px; color:#222}
table{width:100%; border-collapse:separate; border-spacing:0; background:#fff; border:1px solid #e6e6e6; border-radius:12px; overflow:hidden}
th,td{padding:10px 12px; vertical-align:top}
thead th{background:#fafafa; font-weight:600; border-bottom:1px solid #eee; text-align:left}
tbody tr:nth-child(odd){background:#fcfcfc}
code{background:#f0f2f5; padding:2px 6px; border-radius:6px}
.small{color:#666; font-size:12px}
</style></head><body>';


// ---------- Temel & Yuvarlama ----------
section_start('Temel & Yuvarlama');
row('abs(-10)',      'Mutlak değer', abs(-10));
row('ceil(4.3)',     'Yukarı yuvarlama', ceil(4.3));
row('floor(4.9)',    'Aşağı yuvarlama', floor(4.9));
row('round(4.5)',    'En yakına yuvarlama', round(4.5));
row('fmod(7,3)',     'Ondalıklı mod (kalan)', fmod(7,3));
row('intdiv(7,3)',   'Tamsayı bölme', intdiv(7,3));
row('max(1,5,3)',    'En büyük', max(1,5,3));
row('min(1,5,3)',    'En küçük', min(1,5,3));
section_end();


// ---------- Trigonometri ----------
section_start('Trigonometri');
row('sin(pi()/2)',   'Sinüs', sin(pi()/2));
row('cos(pi()/3)',   'Kosinüs', cos(pi()/3));
row('tan(pi()/4)',   'Tanjant', tan(pi()/4));
row('asin(0.5)',     'Arksinüs (radyan)', asin(0.5));
row('acos(0.5)',     'Arkkosinüs (radyan)', acos(0.5));
row('atan(1)',       'Arktanjant (radyan)', atan(1));
row('atan2(1,1)',    'Y ve X’ten açı (radyan)', atan2(1,1));
row('deg2rad(180)',  'Derece → Radyan', deg2rad(180));
row('rad2deg(pi())', 'Radyan → Derece', rad2deg(pi()));
section_end();


// ---------- Hiperbolik ----------
section_start('Hiperbolik');
row('sinh(1)',   'Hiperbolik sinüs', sinh(1));
row('cosh(1)',   'Hiperbolik kosinüs', cosh(1));
row('tanh(1)',   'Hiperbolik tanjant', tanh(1));
row('asinh(1)',  'Ters hiperbolik sinüs', asinh(1));
row('acosh(2)',  'Ters hiperbolik kosinüs', acosh(2));
row('atanh(0.5)','Ters hiperbolik tanjant', atanh(0.5));
section_end();


// ---------- Üssel & Logaritma ----------
section_start('Üssel & Logaritma');
row('exp(1)',     'e^x', exp(1));
row('expm1(1)',   'e^x − 1 (hassas)', expm1(1));
row('log(10)',    'Doğal log (e tabanı)', log(10));
row('log10(1000)','10 taban log', log10(1000));
row('log1p(1)',   'log(1+x) (hassas)', log1p(1));
row('sqrt(16)',   'Karekök', sqrt(16));
row('hypot(3,4)', 'Hipotenüs √(x²+y²)', hypot(3,4));
row('pow(2,3)',   'Üs alma', pow(2,3));
row('pi()',       'Pi sabiti', pi());
section_end();


// ---------- Sayı Sistemi Dönüşümleri ----------
section_start('Sayı Dönüşümleri');
row('decbin(10)',          'Decimal → Binary', decbin(10));
row('dechex(255)',         'Decimal → Hex', dechex(255));
row('decoct(64)',          'Decimal → Octal', decoct(64));
row("bindec('1010')",      'Binary → Decimal', bindec('1010'));
row("hexdec('ff')",        'Hex → Decimal', hexdec('ff'));
row("octdec('10')",        'Octal → Decimal', octdec('10'));
row("base_convert('FF',16,2)", 'Taban çevir (16→2)', base_convert('FF',16,2));
section_end();


// ---------- Kontrol Fonksiyonları ----------
section_start('Kontrol Fonksiyonları');
row('is_finite(123.45)', 'Sonlu mu?', is_finite(123.45));
row('is_infinite(INF)',  'Sonsuz mu?', is_infinite(INF));         // 1/0 yerine INF kullanıldı
row('is_nan(acos(2))',   'NaN (tanımsız) mı?', is_nan(acos(2)));  // acos(2) → NAN
section_end();


// ---------- Rastgele Sayılar ----------
section_start('Rastgele Sayılar');
row('getrandmax()', 'rand() üst sınır', getrandmax());
srand(1234);
row('srand(1234); rand(1,10)', 'Klasik RNG (seedli)', rand(1,10));
row('rand(1,10)', 'Klasik RNG (ardışık)', rand(1,10));

row('mt_getrandmax()', 'mt_rand() üst sınır', mt_getrandmax());
mt_srand(1234);
row('mt_srand(1234); mt_rand(1,10)', 'Mersenne Twister (seedli)', mt_rand(1,10));
row('mt_rand(1,10)', 'Mersenne Twister (ardışık)', mt_rand(1,10));
section_end();


