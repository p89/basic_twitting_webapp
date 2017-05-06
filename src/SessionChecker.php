<?php

class SessionChecker
{
    public static function checkSession() {
        global $ABS_PATH;
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {

            echo '<br><br><br><div align="center"><h1 class="sessionChecker"><a href="' . $ABS_PATH . '" style="font-size: 35px !important; color: #DB7093 !important;">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
            header( "refresh:3;url=" . $ABS_PATH);
            die();
        }
    }

    public static function redirectWithMsg($message, $parameter = null) {
        global $ABS_PATH;
        echo '<br><br><br><div align="center"><h1 class="sessionChecker"><a href="' . $ABS_PATH . '" style="font-size: 35px !important; color: #DB7093 !important;">' . $message . '</a></h1><h4>automatyczne przekierowanie...</h4></div>';
        header( "refresh:3;url=" . $ABS_PATH . $parameter);
        die();
    }
}