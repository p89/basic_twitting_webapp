<?php

if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
    echo '<br><br><br><div align="center"><h1><a href="index.php">Prosimy o zalogowanie się.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=index.php");
    die();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_SESSION['logged'])
    && isset($_SESSION['userId'])
    && isset($_SESSION['logged']) === true
    && isset($_POST['submit'])
    && $_POST['submit'] === 'deleteUser') {

    User::deleteUserById($connection, $_SESSION['userId']);
    echo '<br><br><br><div align="center"><h1><a href="index.php">Konto usunięte.</a></h1><h4>automatyczne przekierowanie...</h4></div>';
    header( "refresh:3;url=index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPass']) && isset($_POST['newPass2']) && isset($_POST['submit']) && $_POST['submit'] === 'changePassword') {

    if ($_POST['newPass'] !== $_POST['newPass2']) {
        echo 'Nowe hasła nie zgadzają się, wprowadź ponownie.';
    } else {

        if (isset($_SESSION['logged'])
            && isset($_SESSION['userMail'])
            && isset($_SESSION['logged']) === true
            && isset($_POST['oldPass'])) {

            $email = $_SESSION['userMail'];
            $oldPassword = $_POST['oldPass'];
            $newPassword = $_POST['newPass'];

            $user = User::showUserByEmail($connection, $email);

            if ($user) {

                $passSalted = $oldPassword . $user->getSalt();

                if (passHandler::verifyPass($passSalted, $user->getHashPass())) {


                    $user->setHashPass($newPassword);
                    $result = $user->save($connection);


                    echo '<br><br><br><div align="center"><h1><a href="index.php">Hasło zmienione.</a></h1><h4>Zaloguj się ponownie...</h4></div>';
                    $_SESSION['logged'] = false;
                    session_unset();
                    $connection = null;
                    header( "refresh:3;url=index.php");

                } else {
                    $errors[] = 'Hasło niepoprawne.';
                }
            } else {
                $errors[] = 'Brak takiego użytkownika';
            }
        }
    }
}



?>

<form action="main.php?page=profile" method="POST" role="form">
    <div class="form-group tweetForm">
        <?php echo join('<br>', $errors); ?>
        <legend>Zmień hasło:</legend>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="">Aktualne hasło:</label>
            <input type="text" class="form-control tweetForm" name="oldPass" id="oldPass" placeholder="Podaj swoje aktualne hasło...">
        </div>
        <div class="form-group">
            <label for="">Nowe hasło:</label>
            <input class="form-control tweetForm" maxlength="100" name="newPass" id="newPass" placeholder="Podaj nowe hasło...">
        </div>
        <div class="form-group">
            <label for="">Powtórz nowe hasło:</label>
            <input class="form-control tweetForm" maxlength="100" name="newPass2" id="newPass2" placeholder="Powtórz nowe hasło...">
        </div>
        <button type="submit" name="submit" value="changePassword" class="btn btn-primary">Zmień hasło</button>
    </div>
</form>
<br><br>
<form action="main.php?page=profile" method="POST" role="form">
    <div class="form-group tweetForm">

        <legend>Twoje konto:</legend>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="">Chcesz usunąć konto?</label><br>
            <button type="submit" name="submit" value="deleteUser" class="btn btn-danger">Usuń konto</button>
        </div>
    </div>
</form>