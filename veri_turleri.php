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
			// PHP Veri Tipleri Örnekleri
			
			// String
			$txt = "Merhaba Dünya!";
			echo "<b>String:</b> " . $txt . "<br>";

			// Integer
			$num = 2025;
			echo "<b>Integer:</b> " . $num . "<br>";

			// Float
			$floatNum = 19.99;
			echo "<b>Float:</b> " . $floatNum . "<br>";

			// Boolean
			$bool = true;
			echo "<b>Boolean:</b> " . ($bool ? "TRUE" : "FALSE") . "<br>";

			// Array
			$cars = array("BMW", "Mercedes", "Audi");
			echo "<b>Array:</b> " . $cars[0] . ", " . $cars[1] . ", " . $cars[2] . "<br>";

			// Object
			class Ogrenci {
				public $isim;
				public function __construct($isim) {
					$this->isim = $isim;
				}
			}
			$ogr = new Ogrenci("Ali");
			echo "<b>Object:</b> " . $ogr->isim . "<br>";

			// NULL
			$x = NULL;
			echo "<b>NULL:</b> ";
			var_dump($x); // NULL çıktısını göstermek için var_dump kullandım
		?>  
	</div> 
</div>

<script src="js/bootstrap.min.js"></script>
</body>	
</html>
