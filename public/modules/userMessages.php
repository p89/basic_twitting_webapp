<?php
if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
    echo '<br><br><br><div align="center"><h1><a href="index.php">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=../index.php");
    die();
} else {
    if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {



        $messages = Message::loadMsgByReceiverId($_SESSION['userId'], $connection);

        //Message::writeMsgByReceiverID($connection, $_SESSION['userId']);
        $message = msgWriter::generateLinks($connection, $messages);



        //Tweet::writeTweetsById($connection, $_SESSION['userId']);
    } else {
        echo '<br><br><br><div align="center"><h1><a href="index.php">Błędny identyfikator użytkownika.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
        header( "refresh:3;url=../index.php");
    }
}
