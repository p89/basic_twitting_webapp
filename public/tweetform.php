<?php
//require_once('bootstrap.php');
require_once('../src/Tweet.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tweetTitle']) && isset($_POST['tweetBody'])) {

    try
    {
        $tweet = new Tweet($_POST['tweetTitle'], $_POST['tweetBody'], '1', date('Y-m-d H:i:s'));
        $tweet->saveTweet($connection);
    }

    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}


?>


<div class="container">
    <div class="row">

        <div class="col-lg-4 col-lg-offset-4">
            <form action="" method="post" role="form">
                <div class="form-group">
                    <legend>Add tweet:</legend>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="tweetTitle" id="tweetTitle" placeholder="Title...">
                    </div>
                    <div class="form-group">
                        <label for="">Text</label>
                        <textarea class="form-control" maxlength="140" name="tweetBody" id="tweetBody"
                                  placeholder="Text - max 140 characters..."></textarea>
                    </div>
                    <button type="submit" name="submit" value="add" class="btn btn-success">ADD TWEET</button>
                </div>
            </form>
        </div>
