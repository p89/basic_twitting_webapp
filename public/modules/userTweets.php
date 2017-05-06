<?php
require_once (__DIR__ . '../../bootstrap.php');
require_once (__DIR__ . '/../../src/Tweet.php');

SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {
    $userTweets = Tweet::writeTweetsByUserId($connection, $_SESSION['userId']);
} else {
    SessionChecker::redirectWithMsg('Błędny identyfikator użytkownika.');
}



