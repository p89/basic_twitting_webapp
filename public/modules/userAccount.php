<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_SESSION['userId'])
    && isset($_POST['submit'])
    && $_POST['submit'] === 'deleteUser') {

    User::deleteUserById($connection, $_SESSION['userId']);
    SessionChecker::redirectWithMsg('Konto usunięte.');
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

                    $_SESSION['logged'] = false;
                    session_unset();
                    $connection = null;
                    SessionChecker::redirectWithMsg('Hasło zmienione, zaloguj się ponownie.');

                } else {
                    $errors[] = 'Hasło niepoprawne.';
                }
            } else {
                $errors[] = 'Brak takiego użytkownika';
            }
        }
    }
}

if (isset($_SESSION['userId']) && $_SESSION['userName'] && $_SESSION['userMail']) {
echo '<h4>Nr id konta: ' . $_SESSION['userId'] . '</h4>';
echo '<h4>Nazwa użytkownika: ' . $_SESSION['userName'] . '</h4>';
echo '<h4>Adres e-mail: ' . $_SESSION['userMail'] . '</h4>';
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
            <input type="password" class="form-control tweetForm" name="oldPass" id="oldPass" placeholder="Podaj swoje aktualne hasło...">
        </div>
        <div class="form-group">
            <label for="">Nowe hasło:</label>
            <input type="password" class="form-control tweetForm" maxlength="100" name="newPass" id="newPass" placeholder="Podaj nowe hasło...">
        </div>
        <div class="form-group">
            <label for="">Powtórz nowe hasło:</label>
            <input type="password" class="form-control tweetForm" maxlength="100" name="newPass2" id="newPass2" placeholder="Powtórz nowe hasło...">
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