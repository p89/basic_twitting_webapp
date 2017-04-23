<?php
require_once('../bootstrap.php');



if (isset($_SESSION['logged'] && $_SESSION['logged'] != false)) {

    die('użytkownik musi być zalogowany');
}


$user = new User();
$user->setEmail('test@email.com');
$user->setUserName('typowyseba');
$user->setHashPass('testpassword');

$result = $user->save($connection);

echo 'New user was born!';