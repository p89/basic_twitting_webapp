<?php

class msgWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                $sender = Message::loadMsgBySenderId($val->getSenderId(), $connection);
                echo 'sender';
                //var_dump($sender);
                //echo "wiadomość od: " . $sender;
            }
        }
    }

    public static function generateLinks($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {
                //$sender = Message::loadMsgBySenderId($val->getSenderId(), $connection);


                $sender = User::showUserById($connection, $val->getSenderId());
                var_dump($sender);
                echo "<h4>Wiadomość nr: " . $val->getId() . " Nadawca: " .$sender->getUserName() . ' (' . $val->getSendDate() . ')</h4>';


            }
        }
    }
}