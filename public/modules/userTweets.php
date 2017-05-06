<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {
    Tweet::writeTweetsById($connection, $_SESSION['userId']);
} else {
    SessionChecker::redirectWithMsg('Błędny identyfikator użytkownika.');
}



