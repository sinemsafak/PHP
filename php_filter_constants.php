<?php

echo "<h3>VALIDATE Örnekleri</h3>";

// BOOLEAN
$bool = "true";
var_dump(filter_var($bool, FILTER_VALIDATE_BOOLEAN));

// EMAIL
$email = "test@mail.com";
echo "Email: " . (filter_var($email, FILTER_VALIDATE_EMAIL) ? "Geçerli" : "Geçersiz") . "<br>";

// FLOAT
$float = "12.5";
echo "Float: " . (filter_var($float, FILTER_VALIDATE_FLOAT) ? "Geçerli" : "Geçersiz") . "<br>";

// INT
$int = "100";
echo "Integer: " . (filter_var($int, FILTER_VALIDATE_INT) ? "Geçerli" : "Geçersiz") . "<br>";

// IP
$ip = "192.168.1.1";
echo "IP: " . (filter_var($ip, FILTER_VALIDATE_IP) ? "Geçerli" : "Geçersiz") . "<br>";

// MAC
$mac = "00:1B:44:11:3A:B7";
echo "MAC: " . (filter_var($mac, FILTER_VALIDATE_MAC) ? "Geçerli" : "Geçersiz") . "<br>";

// URL
$url = "https://example.com";
echo "URL: " . (filter_var($url, FILTER_VALIDATE_URL) ? "Geçerli" : "Geçersiz") . "<br>";

// REGEX
$regex = "abc123";
echo "Regex (sadece harf): " . (filter_var($regex, FILTER_VALIDATE_REGEXP, [
    "options" => ["regexp" => "/^[a-zA-Z]+$/"]
]) ? "Geçerli" : "Geçersiz") . "<br>";

echo "<hr><h3>SANITIZE Örnekleri</h3>";

// EMAIL temizleme
$dirtyEmail = "test<>@mail.com";
echo "Temiz Email: " . filter_var($dirtyEmail, FILTER_SANITIZE_EMAIL) . "<br>";

// NUMBER INT temizleme
$dirtyNumber = "12abc+34";
echo "Temiz Number: " . filter_var($dirtyNumber, FILTER_SANITIZE_NUMBER_INT) . "<br>";

// SPECIAL CHARS
$dirtyString = "<h1>Merhaba</h1>";
echo "Special Chars: " . filter_var($dirtyString, FILTER_SANITIZE_SPECIAL_CHARS) . "<br>";

// STRING (deprecated ama eğitim için gösteriyoruz)
$dirtyStr = "<b>Test</b>";
echo "Sanitize String: " . filter_var($dirtyStr, FILTER_SANITIZE_STRING) . "<br>";

// URL temizleme
$dirtyUrl = "https://example.com/<script>";
echo "Temiz URL: " . filter_var($dirtyUrl, FILTER_SANITIZE_URL) . "<br>";

?>