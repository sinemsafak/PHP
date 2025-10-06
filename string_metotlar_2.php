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
			echo "<h4 class='mb-3'>PHP String Fonksiyonları - Örnekler</h4>";
			echo "<ul>";

			// chunk_split()
			$metin = "MerhabaPHP";
			echo "<li><strong>chunk_split()</strong>: " . chunk_split($metin, 3, "-") . "</li>";

			// convert_uuencode()
			$ornek = "PHP Öğreniyorum";
			$encoded = convert_uuencode($ornek);
			echo "<li><strong>convert_uuencode()</strong>: " . $encoded . "</li>";

			// convert_uudecode()
			echo "<li><strong>convert_uudecode()</strong>: " . convert_uudecode($encoded) . "</li>";

			// crc32()
			$crc = crc32("PHP");
			echo "<li><strong>crc32()</strong>: " . $crc . "</li>";

			// crypt()
			$sifre = crypt("parola123", "xx");
			echo "<li><strong>crypt()</strong>: " . $sifre . "</li>";

			// echo()
			echo "<li><strong>echo()</strong>: "; 
			echo "Bu metin echo ile yazdırıldı.</li>";

			// explode()
			$metin2 = "elma,armut,çilek";
			$dizi = explode(",", $metin2);
			echo "<li><strong>explode()</strong>: ";
			print_r($dizi);
			echo "</li>";

			echo "</ul>";
		?>  
	</div> 
</div>

<script src="js/bootstrap.min.js"></script>
</body>	
</html>
