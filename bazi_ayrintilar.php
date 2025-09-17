<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PHP | Lesson 1</title>	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>
	<!--html için kullanılan yorum satırıdır-->
<div class="container-fluid">

	<div class="alert alert-primary mt-5">
		<?php //yorum satırı bu şekilde eklenebilir
			# aynı şeklide kare işsareti de yorum satırı için kullanılabilir
			// biden fazla satırı aynı anda yorum satırı haline getirmek için /* */ işareti kullanılır
			$x=5 /*+15*/ +5;
			echo $x."<br>"; //"<br>" ifadesi ile bir alt satıra geçer br ifadesi break demektir sadece boşluk eklemek istersek ise içi boş bir şekilde çift tırnak işareti bırakmamız yeterlidir.
			// nokta ile bir şeyleri birleştirebiliyoruz php'de
			//php de büyük- küçük harf duyarlılığı yoktur anahtar kelimelerde. örneğin echo
			//değikenlerde büyük harf küçü harf duyarlılığı vardır. 
			$color="mavi";
			echo "evimizin rengi ".$color."<br>";
			echo " sayısı ile bu metin birlikte kullanıldı."
			 ?>  
	</div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>	
</html>