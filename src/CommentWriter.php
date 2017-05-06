<?php
require_once('Comment.php');

class CommentWriter
{
    public static function write($connection, $objArray) {

        if ($objArray) {
            foreach ($objArray as $key => $val) {
                $user = User::showUserById($connection, $val->getUserId());

                echo '<table class="table-style-two">';
                echo '<th colspan="2">Treść komentarza:</th>';
                echo '<tr><td colspan="2">' . $val->getContent() . '</td></tr>';
                echo '<tr><td width="320">Autor: <a href="main.php?page=userPage&userPage='.$user->getUserName() . '">' . $user->getUserName() . '</a></td><td align="right">Data: '.$val->getDatePosted().'</td></tr>';
                echo '</table>';
            }
        }
    }
}
