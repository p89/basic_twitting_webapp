<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

Tweet::writeAllTweets($connection);




