<?php
// Güvenli session ayarları
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false, // HTTPS varsa true yap
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

// Örnek kullanıcı (gerçek projede veritabanı kullanılır)
$validUser = "admin";
$validPass = "12345";

$message = "";

// CSRF token oluştur
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Çıkış işlemi
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // CSRF kontrolü
    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        die("Geçersiz istek!");
    }

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === "" || $password === "") {
        $message = "Alanlar boş bırakılamaz!";
    } else {

        if ($username === $validUser && $password === $validPass) {

            // Session fixation önleme
            session_regenerate_id(true);

            $_SESSION["user"] = $username;
            $_SESSION["login_time"] = time();

            header("Location: login.php");
            exit;

        } else {
            $message = "Hatalı kullanıcı adı veya şifre!";
        }
    }
}

// Session süresi kontrolü (10 dk)
if (isset($_SESSION["login_time"])) {
    if (time() - $_SESSION["login_time"] > 600) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Güvenli Login</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #11998e, #1f4068);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.card {
    background: white;
    padding: 35px;
    border-radius: 20px;
    width: 360px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
}

h2 {
    text-align: center;
    color: #11998e;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    background: #11998e;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #0d7f75;
}

.message {
    background: #ffe0e0;
    color: red;
    padding: 10px;
    border-radius: 8px;
    margin-top: 10px;
    text-align: center;
}

.success {
    text-align: center;
}

.logout {
    display: inline-block;
    margin-top: 15px;
    padding: 10px;
    background: red;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}
</style>
</head>

<body>

<div class="card">

<?php if (isset($_SESSION["user"])): ?>

    <div class="success">
        <h2>Hoş geldin</h2>
        <p><b><?php echo htmlspecialchars($_SESSION["user"]); ?></b></p>
        <p>Session güvenli şekilde başlatıldı.</p>

        <a class="logout" href="login.php?logout=1">Çıkış Yap</a>
    </div>

<?php else: ?>

    <h2>Giriş Yap</h2>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Kullanıcı adı">
        <input type="password" name="password" placeholder="Şifre">

        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        <button type="submit">Giriş</button>
    </form>

<?php endif; ?>

</div>

</body>
</html>