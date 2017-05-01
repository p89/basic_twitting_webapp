<?php
require_once('../public/bootstrap.php');
require_once('Tweet.php');

class TweetWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                echo '<table class="table-style-one">';
                echo '<th colspan="2">' . $val->getTitle() . '</th>';
                echo '<tr><td colspan="2">' . $val->getText() . '</td></tr>';
                echo '<tr><td width="320">Dodano przez: ' . Tweet::loadAuthorById($connection, $val->getAuthor()) . '</td><td align="right"> Data: '.$val->getDate() .'</td></tr></table><br><br>';
            }
        }
    }
}