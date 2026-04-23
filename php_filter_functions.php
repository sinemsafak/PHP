<?php
// Örnek veri (formdan geliyormuş gibi simüle ediyoruz)
$_GET['email'] = "test@example.com";
$_POST['age'] = "25";

// 1. filter_has_var()
if (filter_has_var(INPUT_GET, 'email')) {
    echo "GET ile email değişkeni mevcut.<br>";
}

// 2. filter_input()
$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
if ($email) {
    echo "Geçerli Email: " . $email . "<br>";
} else {
    echo "Geçersiz Email<br>";
}

// 3. filter_input_array()
$args = array(
    'age' => FILTER_VALIDATE_INT
);
$inputArray = filter_input_array(INPUT_POST, $args);

if ($inputArray['age']) {
    echo "Geçerli yaş: " . $inputArray['age'] . "<br>";
} else {
    echo "Geçersiz yaş<br>";
}

// 4. filter_var()
$ip = "192.168.1.1";
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    echo "Geçerli IP adresi<br>";
}

// 5. filter_var_array()
$data = array(
    "email" => "ornek@mail.com",
    "url" => "https://example.com"
);

$filters = array(
    "email" => FILTER_VALIDATE_EMAIL,
    "url" => FILTER_VALIDATE_URL
);

$result = filter_var_array($data, $filters);

echo "Email doğrulama: " . ($result['email'] ? "OK" : "Hatalı") . "<br>";
echo "URL doğrulama: " . ($result['url'] ? "OK" : "Hatalı") . "<br>";

// 6. filter_list()
echo "<br>Desteklenen filtreler:<br>";
print_r(filter_list());

// 7. filter_id()
echo "<br>FILTER_VALIDATE_EMAIL ID: " . filter_id("validate_email");
?>