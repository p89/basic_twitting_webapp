<?php
require_once('../public/bootstrap.php');
require_once('Tweet.php');

class TweetWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {
                $user = Tweet::loadAuthorById($connection, $val->getAuthor());

                echo '<table class="table-style-one">';
                echo '<th colspan="2"><a href="main.php?page=tweetPage&tweetId=' . $val->getId() . '">'  . $val->getTitle() . '</a></th>';
                echo '<tr><td colspan="2">' . $val->getText() . '</td></tr>';
                echo '<tr><td width="320">Dodano przez: <a href="main.php?page=userPage&userPage='.$user . '">' . $user . '</a></td><td align="right"> Data: '.$val->getDate() .'</td></tr></table><br><br>';
            }
        }
    }
}