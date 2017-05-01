<?php
require_once('bootstrap.php');
require_once('../src/Tweet.php');
require_once('../src/TweetWriter.php');

if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
    echo '<br><br><br><div align="center"><h1><a href="index.php">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=index.php");
    die();
}

?>
<html>
<title>basic-tweet-app</title>
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>basic tweeting app</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">



<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="main.php">basic-tweet-app</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a onclick="scroll(0,0)" href="#">Strona główna</a></li>
                <li><a href="main.php?page=addTweet">Dodaj tweeta!</a></li>
                <li><a href="#portfolio">Twoje tweety</a></li>
                <li><a href="#motorsports">Wiadomości</a></li>
                <li><a href="admin/logout.php">Wyloguj się</a></li>

            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">

        <div class="col-lg-6 col-lg-offset-3"><br><br><br>

<!--            TO DO:
            1. Dodać sprawdzenia z GETów do wyświetlania poszczególnych podstron w main
            2. Do tweetform dodać pobieranie IDa użytkownika z sesji

            -->



            <?php

            if (isset($_SESSION['userName']) && isset($_SESSION['userId'])) {


                echo '<h1>Witaj, ' .  ucfirst($_SESSION['userName']) . '!</h1>';


                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page'])) {


                    require_once('modules/tweetform.php');

                }

                echo 'Lista wszystkich tweetów od najnowszych:<br>';
                require_once ('modules/allTweets.php');
            }
            ?>


        </div>
    </div>
</div>




</body>
</html>


