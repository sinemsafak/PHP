<?php

// SABİTLER
define('APP_NAME', 'Örnek Uygulama');
define('VERSION', '1.0.0');
define('PI', 3.14);

// PHP 7+ dizi sabiti
define('DB', [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'testdb'
]);

// ÇIKTI
echo "APP_NAME: " . APP_NAME . "<br>";
echo "VERSION: " . VERSION . "<br>";
echo "PI: " . PI . "<br><br>";

echo "DB BİLGİLERİ:<br>";
echo "Host: " . DB['host'] . "<br>";
echo "User: " . DB['user'] . "<br>";
echo "Pass: " . DB['pass'] . "<br>";
echo "Name: " . DB['name'] . "<br><br>";

echo "constant() ile erişim: " . constant('APP_NAME') . "<br>";

function testScope() {
    echo "Fonksiyon içinden APP_NAME: " . APP_NAME . "<br>";
}

testScope();

?>
