<?php
//require_once('bootstrap.php');
//require_once('../src/User.php');
//require_once('../src/TweetWriter.php');
//require_once('../src/Tweet.php');


if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
    echo '<br><br><br><div align="center"><h1><a href="index.php">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=../index.php");
    die();
} else {
    Tweet::writeAllTweets($connection);
}




