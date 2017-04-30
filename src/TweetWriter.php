<?php

class TweetWriter
{
    public static function write($objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {
                echo '<div>' . $val->getTitle() . '</div><br>';
                echo '<div>' . $val->getText() . '</div><br>';
                echo '<div>Dodano przez: ' . $val->getAuthor() . '</div><br>';
                echo '<div>Data: ' . $val->getDate() . '</div><br><br>';
            }
        }
    }

}