<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PHP | Lesson 1</title>	
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container-fluid">

	<div class="alert alert-primary mt-5">
		<?php
			// Örnek metinler
			$metin = "Merhaba Dünya! PHP öğreniyoruz.";
			$kisa  = "Merhaba";
			$ozel  = "O'reilly \"PHP\" \\ ders";

			echo "<h5 class='mb-3'>PHP String Fonksiyonları Örnekleri</h5>";
			echo "<ul class='mb-0'>";

			// strlen()
			echo "<li><strong>strlen()</strong> – Uzunluk: <code>" . strlen($metin) . "</code></li>";

			// str_word_count()
			// Not: Türkçe karakterler için ikinci parametre ile kelimeleri dizi olarak alıp sayıyoruz
			$kelimeler = str_word_count($metin, 1, "ÇĞİÖŞÜçğıöşü");
			echo "<li><strong>str_word_count()</strong> – Kelime sayısı: <code>" . count($kelimeler) . "</code></li>";

			// strrev()
			echo "<li><strong>strrev()</strong> – Ters çevrilmiş: <code>" . strrev($kisa) . "</code></li>";

			// strpos()
			$aranan = "PHP";
			$pos = strpos($metin, $aranan);
			$pozisyonYazi = ($pos !== false) ? $pos : "bulunamadı";
			echo "<li><strong>strpos()</strong> – \"{$aranan}\" konumu: <code>{$pozisyonYazi}</code></li>";

			// str_replace()
			echo "<li><strong>str_replace()</strong> – Değiştirilmiş: <code>" . str_replace("PHP", "JavaScript", $metin) . "</code></li>";

			// addslashes()
			echo "<li><strong>addslashes()</strong> – Kaçış eklenmiş: <code>" . addslashes($ozel) . "</code></li>";

			// bin2hex()
			echo "<li><strong>bin2hex()</strong> – \"ABC\" → <code>" . bin2hex("ABC") . "</code></li>";

			// chop() (rtrim)
			$sonuBosluklu = "Merhaba   ";
			echo "<li><strong>chop()</strong> – Sondaki boşluklar silinmiş: <code>\"" . chop($sonuBosluklu) . "\"</code></li>";

			// chr()
			echo "<li><strong>chr()</strong> – 65 → <code>" . chr(65) . "</code></li>";

			echo "</ul>";
		?>  
	</div> 
</div>

<script src="js/bootstrap.min.js"></script>
</body>	
</html>
