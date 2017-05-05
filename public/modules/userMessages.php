<?php
require_once ('../autoload.php');
SessionChecker::checkSession();

if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {

    if (isset($_GET['messageId'])) {
        $clickedMsg = Message::loadMsgByMsgId($_GET['messageId'], $connection);
        msgWriter::write($connection, $clickedMsg);
        $clickedMsg[0]->setReadStatus($connection, 1);
        $user = User::showUserById($connection, $clickedMsg[0]->getSenderId());
        require_once ('msgForm.php');
    }
    $messages = Message::loadMsgByReceiverId($_SESSION['userId'], $connection);
    $message = msgWriter::generateLinks($connection, $messages);
} else {
    echo '<br><br><br><div align="center"><h1><a href="index.php">Błędny identyfikator użytkownika.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=../index.php");
}

