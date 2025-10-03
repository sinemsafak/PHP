<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PHP | Lesson 1</title>	
<link rel="stylesheet" href="css\bootstrap.min.css">
</head>

<body>
	<!--html için kullanılan yorum satırıdır-->
<div class="container-fluid">

	<div class="alert alert-primary mt-5">
		<?php

			/*$txt="php";
			$x=5;
			$y=7.5;
			$age=30;
			$Age=40;
			echo "$txt sevdim bak seni <br>";
			 $x=10 ;
			#echo $x;
			#echo $age. "<br>".$Age;
			echo $age + $x;*/

			#$x=5; //global veriable: global değerlere fonksiyon içinden ulaşamayız
			//php de kodlar yukarıdan aşağıya doğru okunur
			/*function Test(){
				$x=7; //local veriable: fonksiyonun içinde ulaştığımız değişkenlerdir. local değerlere fonksiyon dışından ulaşamayız
				echo "<p> x değişkenine fonksiyon içinden ulaştım:$x</p>"; //7 yazar
			}*/
			$x=5; //global veriable
			$y=15;//global veriable

			function Test(){
				static $z=45; //static veriable: fonksiyonun içinde tanımlanır ve fonksiyon her çağrıldığında değeri korunur
				echo $z;
				echo $z++;
				global $x,$y; //global değişkenleri fonksiyon içinde kullanmak için global olarak tanımlamamız gerekir
				//$GLOBALS ['y']= $GLOBALS['x'] + $GLOBALS['y']; // bu ifade $y=$x+$y; bu ifade ile aynı sonucu verir
				
				
			}
			/*function Deneme(){ 
				$x=7; //farklı fonksiyonlarda aynı isimde değişken tanımlayabiliriz
				//aynı fonksiyon içinde aynı isimde değişken tanımlayamayız
				echo "<p> x değişkenine fonksiyon içinden ulaştım:$x</p>"; //7 yazar
			}*/
			/*Test(); //run function
				echo "<p> x değişkenine fonksiyon dışından ulaştım:$x</p>"; //5 yazar*/
			Test(); //run function
				//echo $y;
				echo "<br>";
			Test(); //run function
				
				echo "<br>";

			 ?>  
	</div> 
</div>

<script src="js/bootstrap.min.js"></script>
</body>	
</html>