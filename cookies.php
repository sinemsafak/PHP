<?php
session_start();

$cookieName = "remember_user";
$message = "";

// Çıkış işlemi
if (isset($_GET["logout"])) {
    session_destroy();

    setcookie($cookieName, "", time() - 3600, "/", "", false, true);

    header("Location: index.php");
    exit;
}

// Daha önce cookie varsa otomatik hatırla
if (!isset($_SESSION["username"]) && isset($_COOKIE[$cookieName])) {
    $_SESSION["username"] = $_COOKIE[$cookieName];
}

// Form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $remember = isset($_POST["remember"]);

    if ($username === "" || $password === "") {
        $message = "Kullanıcı adı ve şifre boş bırakılamaz.";
    } else {
        $_SESSION["username"] = $username;

        if ($remember) {
            setcookie(
                $cookieName,
                $username,
                time() + (60 * 60 * 24 * 7),
                "/",
                "",
                false,
                true
            );
        }

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Sayfası</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .container {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #11998e;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: #444;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #11998e;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0c7c72;
        }

        .message {
            background: #ffe0e0;
            color: #b00020;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }

        .welcome {
            text-align: center;
        }

        .welcome h2 {
            color: #11998e;
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #ff4d4d;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <?php if (isset($_SESSION["username"])): ?>

        <div class="welcome">
            <h2>Hoş geldin, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
            <p>Seni hatırladık.</p>
            <a class="logout" href="index.php?logout=1">Çıkış Yap</a>
        </div>

    <?php else: ?>

        <h2>Kullanıcı Girişi</h2>

        <?php if ($message !== ""): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Kullanıcı adı">
            <input type="password" name="password" placeholder="Şifre">

            <label class="remember">
                <input type="checkbox" name="remember">
                Beni hatırla
            </label>

            <button type="submit">Giriş Yap</button>
        </form>

    <?php endif; ?>

</div>

</body>
</html>