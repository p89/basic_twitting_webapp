<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php

class msgWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                $sender = User::showUserById($connection, $val->getSenderId());
                echo '<table class="table-style-three">';
                echo '<th colspan="2">Treść wiadomości:</th>';
                echo '<tr><td colspan="2">' . $val->getContent() . '</td></tr>';
                echo '<tr><td width="320">Wysłana przez: <a href="main.php?page=userPage&userPage='. $sender->getUserName() . '">' . $sender->getUserName() . '</a></td><td align="right"> Data: '. $val->getSendDate() .'</td></tr></table><br><br>';
            }
        }
    }

    public static function generateLinks($connection, $objArray, $showSender) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                if ($val->getWasRead() == 0) {
                    echo '<a class="msgUnread" href=main.php?page=messages&messageId=' . $val->getId() . '> Nieprzeczytana ';
                } elseif ($val->getWasRead() == 1) {
                    echo '<a class="msgRead" href=main.php?page=messages&messageId=' . $val->getId() . '> Przeczytana ';
                }
                if ($showSender == true) {
                    $user = User::showUserById($connection, $val->getSenderId());
                    echo " || Od: " .$user->getUserName() . ' (' . $val->getSendDate() . ')</a><br>';
                } else {
                    $user = User::showUserById($connection, $val->getReceiverId());
                    echo " || Do: " .$user->getUserName() . ' (' . $val->getSendDate() . ')</a><br>';
                }
            }
        }
    }
}