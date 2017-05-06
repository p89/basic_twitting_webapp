<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['tweetTitle'])
    && isset($_POST['tweetBody'])
) {
    try {
        $tweet = new Tweet($_POST['tweetTitle'], $_POST['tweetBody'], $_SESSION['userId'], date('Y-m-d H:i:s'));
        $tweet->saveTweet($connection);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
?>

<form action="main.php?page=main" method="POST" role="form">

    <div class="form-group">
        <div class="form-group">
            <input type="text" class="form-control tweetForm" name="tweetTitle" id="tweetTitle" placeholder="Tytuł tweeta...">
        </div>
        <div class="form-group">
            <textarea class="form-control" maxlength="140" name="tweetBody" id="tweetBody" placeholder="Treść - maksymalnie 140 znaków..."></textarea>
        </div>
        <div class="text-right">
            <button type="submit" name="submit" value="add" class="btn btn-success submitButton">Dodaj Tweeta</button>
        </div>
    </div>

</form>

