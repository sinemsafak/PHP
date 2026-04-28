<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);

    if ($username === "") {
        $message = "Lütfen kullanıcı adınızı giriniz.";
    } else {
        $_SESSION["username"] = $username;
        header("Location: session.php");
        exit;
    }
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: session.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Session Örneği</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #16a085, #1f4068);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 420px;
            background: white;
            padding: 35px;
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        h1 {
            color: #16a085;
            margin-bottom: 10px;
        }

        p {
            color: #444;
            line-height: 1.6;
        }

        input {
            width: 100%;
            padding: 14px;
            margin: 18px 0;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        button,
        .logout {
            display: inline-block;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #16a085;
            color: white;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }

        button:hover,
        .logout:hover {
            background: #12836d;
        }

        .message {
            background: #ffe0e0;
            color: #b00020;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .info {
            background: #eef9f6;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="card">

    <?php if (isset($_SESSION["username"])): ?>

        <h1>Hoş Geldin</h1>

        <p>
            Merhaba,
            <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>
        </p>

        <div class="info">
            Bu kullanıcı adı session içinde saklandı.
            Tarayıcı açık kaldığı sürece bu bilgi farklı PHP sayfalarında da kullanılabilir.
        </div>

        <br>

        <a class="logout" href="session.php?logout=1">Oturumu Kapat</a>

    <?php else: ?>

        <h1>Session Giriş</h1>

        <p>
            Kullanıcı adınızı girerek session başlatabilirsiniz.
        </p>

        <?php if ($message !== ""): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Kullanıcı adınız">

            <button type="submit">Session Başlat</button>
        </form>

    <?php endif; ?>

</div>

</body>
</html>