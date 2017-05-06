<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if (isset($_GET['tweetId']) && $_GET['tweetId'] > 0) {
    Tweet::writeTweetsByTweetId($connection, $_GET['tweetId']);
}
