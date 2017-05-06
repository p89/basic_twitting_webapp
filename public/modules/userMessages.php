<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {

    if (isset($_GET['messageId'])) {
        $clickedMsg = Message::loadMsgByMsgId($_GET['messageId'], $connection);
        msgWriter::write($connection, $clickedMsg);

        // if the receiver of the message matches currently logged user, set the status of the message as 'read'
        if ($clickedMsg[0]->getReceiverId() == $_SESSION['userId']) {
        $clickedMsg[0]->setReadStatus($connection, 1);
        }
        $user = User::showUserById($connection, $clickedMsg[0]->getSenderId());
        require_once ('msgForm.php');
    }
    $receivedMsgs = Message::loadMsgByReceiverId($_SESSION['userId'], $connection);


    if ($receivedMsgs) {
        echo 'Wiadomości otrzymane: <br>';
        msgWriter::generateLinks($connection, $receivedMsgs, true);
    } else {
        echo 'Nie otrzymałeś żadnych wiadomości.<br>';
    }

    $sentMsgs = Message::loadMsgBySenderId($_SESSION['userId'], $connection);

    if ($sentMsgs) {
        echo '<br><br>Wiadomości wysłane: <br>';
        msgWriter::generateLinks($connection, $sentMsgs, false);
    } else {
        echo '<br><br>Nie wysłałeś żadnych wiadomości.<br>';
    }

} else {
    SessionChecker::redirectWithMsg('Błędny identyfikator użytkownika.');
}

