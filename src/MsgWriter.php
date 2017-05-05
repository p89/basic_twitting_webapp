<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php

class msgWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                $sender = User::showUserById($connection, $val->getSenderId());
                echo '<table class="table-style-one">';
                echo '<th colspan="2">Treść wiadomości:</th>';
                echo '<tr><td colspan="2">' . $val->getContent() . '</td></tr>';
                echo '<tr><td width="320">Wysłana przez: <a href="main.php?page=userPage&userPage='. $sender->getUserName() . '">' . $sender->getUserName() . '</a></td><td align="right"> Data: '. $val->getSendDate() .'</td></tr></table><br><br>';
            }
        }
    }

    public static function generateLinks($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                $sender = User::showUserById($connection, $val->getSenderId());
                if ($val->getWasRead() == 0) {
                    echo '<a class="msgUnread" href=main.php?page=messages&messageId=' . $val->getId() . '> Nieprzeczytana ';
                } elseif ($val->getWasRead() == 1) {
                    echo '<a class="msgRead" href=main.php?page=messages&messageId=' . $val->getId() . '> Przeczytana ';
                }
                echo " || Od: " .$sender->getUserName() . ' (' . $val->getSendDate() . ')</a><br>';

                // wygenerować linki z getem do poszczególnych wiadomości (tutaj sprawdzić i zmienić flagę wasRead)
                // wygenerować wiadomość plus formularz odpowiedzi
            }
        }
    }
}