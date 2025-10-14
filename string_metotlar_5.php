<?php

header('Content-Type: text/html; charset=utf-8');

// ---------- Yardımcılar ----------
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
function pretty($v){
    if ($v === true) return 'true';
    if ($v === false) return 'false';
    if (is_array($v)) return '['.implode(', ', array_map('e', $v)).']';
    return (string)$v;
}
function row($name,$input,$output){
    echo "<tr><td><code>".e($name)."</code></td><td>".e($input)."</td><td><pre>".e(pretty($output))."</pre></td></tr>";
}

// ---------- Demo girdileri ----------
$txt        = "Merhaba Dünya, PHP!";
$lower      = "php programlama";
$mixed      = "Php PROGRAMLAMA";
$alpha      = "abcdefg";
$html       = "<b>Merhaba</b> <i>PHP</i>!";
$escaped    = "Ben PHP\\'yi seviyorum"; // Ben PHP\'yi seviyorum
$needles    = "abcxyz";
$searchBase = "Merhaba php, ben PHP dilini seviyorum";
$subBase    = "Bugün hava çok güzel";

// ---------- HTML ----------
?><!doctype html>
<html lang="tr"><head>
<meta charset="utf-8">
<title>PHP String Metotları </title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
  :root { --bg:#101826; --card:#141c2e; --muted:#9aa4b2; --text:#e6e8f0; }
  body { margin:0; font:16px/1.55 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; color:var(--text);
         background:linear-gradient(135deg,#0b203a,#1c2b54); }
  header { padding:24px 16px 8px; text-align:center; }
  header h1 { margin:0; font-size:24px }
  .card { margin:18px auto 30px; max-width:1100px; border-radius:14px; overflow:hidden;
          background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1); }
  table { width:100%; border-collapse:collapse; }
  th,td { padding:12px 14px; vertical-align:top; }
  th { background:rgba(255,255,255,.08); text-align:left; }
  tr:nth-child(even) td { background:rgba(255,255,255,.03); }
  code { background:rgba(255,255,255,.08); padding:.1rem .35rem; border-radius:6px; }
  pre { margin:0; white-space:pre-wrap; word-break:break-word; }
  .note { color:var(--muted); text-align:center; margin:6px 0 18px; font-size:14px; }
</style>
</head><body>
<header>
  <h1>PHP String Metotları </h1>
  <div class="note">Aşağıda her satır: <em>Metot</em> • <em>Girdi</em> • <em>Çıktı/Not</em></div>
</header>

<div class="card">
<table>
  <thead><tr><th>Metot</th><th>Girdi</th><th>Çıktı / Not</th></tr></thead>
  <tbody>
<?php
// str_repeat
row('str_repeat', "'ha', 3", str_repeat('ha', 3));

// str_rot13
row('str_rot13', $txt, str_rot13($txt));

// str_shuffle
row('str_shuffle', $alpha, str_shuffle($alpha));

// str_split
row('str_split', "'Merhaba', 2", str_split('Merhaba', 2));

// strcasecmp (case-insensitive)
row('strcasecmp', "'$lower' vs '$mixed'", strcasecmp($lower, $mixed));

// strcmp (case-sensitive)
row('strcmp', "'PHP' vs 'Php'", strcmp('PHP','Php'));

// strcspn
row('strcspn', "'$txt' içinde \"$needles\"", strcspn($txt, $needles));

// strip_tags
row('strip_tags', $html, strip_tags($html));

// stripslashes
row('stripslashes', $escaped, stripslashes($escaped));

// stripos / strpos / strrpos
row('stripos', "'$searchBase' içinde 'php'", stripos($searchBase, 'php'));
row('strpos',  "'$searchBase' içinde 'PHP'", strpos($searchBase,  'PHP'));
row('strrpos', "'$searchBase' içinde 'PHP' (son)", strrpos($searchBase, 'PHP'));

// strstr / stristr
row('strstr',  "'$searchBase' , 'PHP'", strstr($searchBase, 'PHP'));      // duyarlı
row('stristr', "'$searchBase' , 'php'", stristr($searchBase, 'php'));     // duyarsız

// strpbrk
row('strpbrk', "'$txt' , 'xyz!'", strpbrk($txt, 'xyz!'));

// strtr – karakter eşleme ve alt dizge değişimi
row('strtr (char map)', "'merhaba', ['a'=>'@','e'=>'3']", strtr('merhaba',['a'=>'@','e'=>'3']));
row('strtr (substr map)', "'php çabuk', ['çabuk'=>'hızlı','php'=>'PHP']", strtr('php çabuk', ['çabuk'=>'hızlı','php'=>'PHP']));

// substr
row('substr', "'$subBase', 7, 4", substr($subBase, 7, 4));       // "hava"
row('substr (negatif)', "'$subBase', -5", substr($subBase, -5)); // "güzel"

// substr_compare
// 0: eşit; <0 soldaki küçüktür; >0 soldaki büyüktür
row('substr_compare', "'Merhaba', 'haba', 3, 4", substr_compare('Merhaba','haba',3,4));
row('substr_compare (CI)', "'Merhaba', 'HABA', 3, 4, true", substr_compare('Merhaba','HABA',3,4,true));
?>
  </tbody>
</table>
</div>
</body></html>
