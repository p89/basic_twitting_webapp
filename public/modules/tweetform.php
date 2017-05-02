<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['tweetTitle'])
    && isset($_POST['tweetBody'])
    && isset($_SESSION['userId'])
    && $_SESSION['userId'] > 0

) {
    try {
        $tweet = new Tweet($_POST['tweetTitle'], $_POST['tweetBody'], $_SESSION['userId'], date('Y-m-d H:i:s'));
        $tweet->saveTweet($connection);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

?>

<form action="main.php?page=addTweet" method="POST" role="form">
    <div class="form-group tweetForm">
        <legend>Nowy tweet:</legend>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="">Tytuł</label>
            <input type="text" class="form-control tweetForm" name="tweetTitle" id="tweetTitle" placeholder="Tytuł...">
        </div>
        <div class="form-group">
            <label for="">Treść</label>
            <textarea class="form-control" maxlength="140" name="tweetBody" id="tweetBody"
                      placeholder="Treść - maksymalnie 140 znaków..."></textarea>
        </div>
        <button type="submit" name="submit" value="add" class="btn btn-success">DODAJ TWEETA</button>
    </div>
</form>

