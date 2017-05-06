<?php
require_once (__DIR__ . '/../bootstrap.php');
require_once (__DIR__ . '/../../src/Tweet.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if (isset($_GET['userPage'])) {

    echo '<h1>Profil użytkownika: ' . $_GET['userPage'] . '</h1>';
    $user = User::showUserByUserName($connection, $_GET['userPage']);
    echo 'adres e-mail: ' . $user->getEmail();
    echo '<br><br>';
    echo '<button onclick="location.href = \'main.php?page=userPage&sendMsg=true&userPage=' . $user->getUserName() . '\';" type="submit" name="page" value="" class="btn btn-primary">Wyślij wiadomość</button>';
    echo '<br><br>';

    if (isset($_GET['sendMsg']) && $_GET['sendMsg'] == true) {
        require_once('msgForm.php');
    }

    echo 'Tweety użytkownika:';
    Tweet::writeTweetsByTweetId($connection, $user->getId());
}
?>

