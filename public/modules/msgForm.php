<?php
require_once ('../autoload.php');
SessionChecker::checkSession();

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['msgContent'])
) {
    try {
        if ($_SESSION['userId'] == $user->getId()) {
            die("Nie możesz wysłać wiadomości do samego siebie.");
        }
        $msg = new Message($_SESSION['userId'], $user->getId(), date('Y-m-d H:i:s'), $_POST['msgContent'], 0);
        $msg->sendMsg($connection);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

?>

<form action="" method="POST" role="form">
    <div class="form-group tweetForm">
        <legend>Nowa wiadomość:</legend>
    </div>
    <div class="form-group tweetForm">
        <div class="form-group">
            <label for="">Treść wiadomości</label>
            <textarea class="form-control" rows="8" name="msgContent" id="msgContent"
                      placeholder="Treść wiadomości..."></textarea>
        </div>
        <button type="submit" name="submit" value="add" class="btn btn-success">Wyślij wiadomość</button>
    </div>
</form>
