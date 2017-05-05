<?php

class SessionChecker
{
    const ABS_PATH = '/warsztaty2304/basic_twitting_webapp/public/index.php';

    public static function checkSession() {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {

            echo '<br><br><br><div align="center"><h1 class="sessionChecker"><a href="' . self::ABS_PATH . '" style="font-size: 35px !important; color: #DB7093 !important;">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
            header( "refresh:3;url=" . self::ABS_PATH);
            die();
        }
    }

    public static function redirectWithMsg($message) {

        echo '<br><br><br><div align="center"><h1 class="sessionChecker"><a href="' . self::ABS_PATH . '" style="font-size: 35px !important; color: #DB7093 !important;">' . $message . '</a></h1><h4>automatyczne przekierowanie...</h4></div>';
        header( "refresh:3;url=" . self::ABS_PATH);
        die();
    }
}


//zmienić we wszystkich klasach na redirectWithMSG