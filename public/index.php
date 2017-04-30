<?php
require_once('bootstrap.php');
require_once('../src/Tweet.php');
?>

<html>
<title>Tweet adding form</title>
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
<?php
require_once('tweetform.php');

?>

<br><br>
<div>Wyniki:
<br>
<?php
    $result = Tweet::loadAllTweets($connection);
    var_dump($result);

    foreach ($result as $key => $val) {
       echo '<div>' . $val->getTitle() . '</div><br>';
       echo '<div>' . $val->getText() . '</div><br>';
       echo '<div>Dodano przez: ' . $val->getAuthor() . '</div><br>';
       echo '<div>Data: ' . $val->getDate() . '</div><br><br>';
    }
?>

</div>
</body>
</html>
