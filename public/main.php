<?php
require_once('bootstrap.php');
require_once('../src/Tweet.php');
require_once('../src/TweetWriter.php');
require_once('../src/Message.php');

SessionChecker::checkSession();

if (isset($_POST['commentContent']) && isset($_POST['tweetId']) && isset($_SESSION['userId']))
{
    try {
        $comment = new Comment($_SESSION['userId'], $_POST['tweetId'], $_POST['commentContent'], date('Y-m-d H:i:s'));
        $comment->saveToDB($connection);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

?>
<html>
<title>basic-tweet-app</title>
<head>
    <title>basic tweeting app</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="main.php?page=profile">
                <?php
                if (isset($_SESSION['userName']) && isset($_SESSION['userId'])) {
                    echo 'Witaj, ' . ucfirst($_SESSION['userName']) . '!';
                }
                ?>
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="main.php?page=main">Strona główna</a></li>
                <li><a href="main.php?page=userTweets">Twoje tweety</a></li>
                <li><a href="main.php?page=messages">Wiadomości</a></li>
                <li><a href="main.php?page=profile">Profil</a></li>
                <li><a href="admin/logout.php">Wyloguj się</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3"><br><br><br><br>

            <?php

            if (isset($_SESSION['userName']) && isset($_SESSION['userId']) && isset($_GET['page'])) {
                switch ($_GET['page']) {

                    case 'userTweets':
                        require_once('modules/userTweets.php');
                        break;
                    case 'main':
                        echo '<div id="tweetsHeader">Oto najnowsze tweety!</div><br>';
                        require_once ('modules/tweetForm.php');
                        require_once ('modules/allTweets.php');
                        break;
                    case 'profile':
                        require_once ('modules/userAccount.php');
                        break;
                    case 'messages':
                        require_once ('modules/userMessages.php');
                        break;
                    case 'userPage':
                        require_once ('modules/userPage.php');
                        break;
                    case 'tweetPage':
                        require_once ('modules/tweetPage.php');
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>


