<?php
/**
 * 2. Создайте форму регистрации пользователя с полями
 * (login,  email, country, city). 
 * В файле обработчике данной формы сохраните данные формы в файл user.json
 */

$pathToFile = 'user.json';

$loginErr = $emailErr = $countryErr = $cityErr = false;

if (!isset($_POST['login']) || !isset($_POST['email'])) {
    header('Location: index.html'); 
}

$login = trim($_POST['login']);
if (strlen($login) == 0 || strlen($login) > 50) {
    $loginErr = true;
}

$email = trim($_POST['email']);
if (strlen($email) == 0 || strlen($email) > 50 || !preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
    $emailErr = true;
}

$country = "";
if (isset($_POST['country']) ) {
    $country = trim($_POST['country']);
    if (strlen($country) > 100) {
        $countryErr = true;
    }
}
$city = "";
if (isset($_POST['city']) ) {
    $city = trim($_POST['city']);
    if (strlen($city) > 100) {
        $cityErr = true;
    }
}

if ($loginErr || $emailErr || $countryErr || $cityErr) {
    require_once('errormsg.php');
} else {

    file_put_contents($pathToFile, json_encode(
        array(
            'login' => $login,
            'email' => $email,
            'country' => $country,
            'city' => $city,
        )
    ));

    require_once('okmsg.php');
}
?>
