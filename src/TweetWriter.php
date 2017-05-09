<?php
require_once('../public/bootstrap.php');
require_once(__DIR__ . '/../src/Tweet.php');
require_once('Comment.php');

class TweetWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {

                $user = User::showUserById($connection, $val->getAuthor());

                echo '<table class="table-style-one" border="0">';
                echo '<th colspan="2"><a href="main.php?page=tweetPage&tweetId=' . $val->getId() . '">'  . $val->getTitle() . '</a></th>';
                echo '<tr><td colspan="2" class="maintd"><h5>' . $val->getText() . '</h5></td></tr>';
                echo '<tr><td width="320" class="maintd">Dodano przez: <a href="main.php?page=userPage&userPage='.$user->getUserName() . '">' . $user->getUserName() . '</a></td><td align="right" class="maintd"> Data: '.$val->getDate() . '</td></tr>';
                echo '<tr><td colspan="2">'.Comment::writeCommentsByTweetId($connection, $val->getId()) .'</td></tr>';
                echo '<tr><td colspan="2">';
                include (__DIR__ . '/../public/modules/commentForm.php');
                echo '</td></tr>';
                echo '</table><br><br>';
            }
        } else {
                echo "Brak tweetów.";
        }
    }
}