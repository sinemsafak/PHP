<?php
$pageTitle = "PHP Include Files";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #16a085, #1f4068);
            color: white;
        }

        header {
            background: rgba(0, 0, 0, 0.25);
            padding: 25px;
            text-align: center;
        }

        nav {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            color: #333;
            padding: 35px;
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        h1 {
            color: #16a085;
            text-align: center;
        }

        .info-box {
            background: #eef9f6;
            border-left: 6px solid #16a085;
            padding: 18px;
            border-radius: 12px;
            margin: 20px 0;
        }

        code {
            background: #eee;
            padding: 4px 7px;
            border-radius: 5px;
            color: #1f4068;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.25);
            margin-top: 40px;
        }
    </style>
</head>

<body>

<?php
// Normalde bu alan ayrı bir dosyada olabilir:
// include "header.php";
?>

<header>
    <h2>PHP Include Files</h2>
    <p>Ortak kodları farklı sayfalarda kullanma örneği</p>
</header>

<?php
// Normalde bu alan ayrı bir dosyada olabilir:
// include "menu.php";
?>

<nav>
    <a href="#">Ana Sayfa</a>
    <a href="#">Hakkımızda</a>
    <a href="#">İletişim</a>
</nav>

<div class="container">
    <h1>Include ve Require Kullanımı</h1>

    <div class="info-box">
        <p>
            <code>include</code> veya <code>require</code>, başka bir PHP dosyasındaki
            kodları mevcut sayfaya eklemek için kullanılır.
        </p>
    </div>

    <p>
        Bir web sitesinde birden fazla sayfada aynı menü, header veya footer
        kullanılacaksa, bu bölümleri ayrı dosyalara ayırıp
        <code>include</code> ile çağırmak oldukça kullanışlıdır.
    </p>

    <div class="info-box">
        <p>
            <strong>require:</strong> Dosya bulunamazsa ölümcül hata verir ve sayfa durur.
        </p>
        <p>
            <strong>include:</strong> Dosya bulunamazsa uyarı verir ama sayfa çalışmaya devam eder.
        </p>
    </div>

    <p>
        Bu örnekte header, menü ve footer alanları tek sayfa içinde gösterildi.
        Gerçek projede bunlar <code>header.php</code>, <code>menu.php</code> ve
        <code>footer.php</code> dosyalarına ayrılabilir.
    </p>
</div>

<?php
// Normalde bu alan ayrı bir dosyada olabilir:
// include "footer.php";
?>

<footer>
    <p>&copy; <?php echo date("Y"); ?> PHP Include Örneği</p>
</footer>

</body>
</html>