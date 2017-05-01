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

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p id="main">
<?php

if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
    require_once('admin/login.php');
}
if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false && !isset($_POST['email'])) {
    require_once('admin/addUser.php');
}
?>
            </p>
        </div>
    </div>
</div>
</body>
</html>
