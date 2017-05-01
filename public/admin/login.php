<?php
require_once 'bootstrap.php';
require_once('../src/passHandler.php');

$errors = [];



    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['email'])
        && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];


        $user = User::showUserByEmail($connection, $email);


        if ($user) {

            $passSalted = $password . $user->getSalt();

            if (passHandler::verifyPass($passSalted, $user->getHashPass())) {
                $_SESSION['logged'] = true;
                echo "ZALOGOWANY";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                $errors[] = 'Hasło niepoprawne.';
            }
        } else {
            $errors[] = 'Brak takiego użytkownika';
        }
}
?>

<div class="container" id="loginForm">
    <div class="row">

        <div class="col-lg-6 col-lg-offset-1">
            <form action="index.php" method="post" role="form">
                <?php echo join('<br>', $errors); ?>
                <div class="form-group">
                    <legend>Zaloguj się:</legend>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="">Adres e-mail:</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="e-mail..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Hasło:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" name="submit" value="add" class="btn btn-success">Zaloguj się</button>
                </div>
            </form>
        </div>
    </div>
</div>
