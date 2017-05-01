<?php
require_once('bootstrap.php');
require_once('../src/Tweet.php');
require_once('../src/TweetWriter.php');
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
                <li><a onclick="scroll(0,0)" href="#">Homepage</a></li>
                <li><a href="#blog">Add Tweet</a></li>
                <li><a href="#portfolio">Your Tweets</a></li>
                <li><a href="#motorsports">Messages</a></li>
                <li><a href="admin/logout.php">Logout</a></li>

            </ul>
        </div>
    </div>
</nav>

</body>
</html>


