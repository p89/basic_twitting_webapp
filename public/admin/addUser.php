<?php
require_once('bootstrap.php');

if (isset($_SESSION['logged']) && $_SESSION['logged'] != false) {

    die('użytkownik musi być zalogowany');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['newEmail'])
    && isset($_POST['newPassword'])
    && isset($_POST['userName'])) {

    $username = $_POST['userName'];
    $email = $_POST['newEmail'];
    $password = $_POST['newPassword'];

    $user = new User();
    $user->setEmail($email);
    $user->setUserName($username);
    $user->setHashPass($password);

    $result = $user->save($connection);
    echo '<div class="container" id="createAccForm"><div class="row"><div class="col-lg-6 col-lg-offset-1"><h1 style="font-size: 26px; color: #aaeeff;">Utworzono konto nowego użytkownika.</h1></div></div></div>';
}
?>
<br>
<div class="container" id="createAccForm">
    <div class="row">

        <div class="col-lg-6 col-lg-offset-1">
            <form action="" method="post" role="form">
                <?php echo join('<br>', $errors); ?>
                <div class="form-group">
                    <legend>Załóż nowe konto:</legend>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="">Nazwa użytkownika:</label>
                        <input type="text" class="form-control" name="userName" id="userName" placeholder="nazwa użytkownika..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Adres e-mail:</label>
                        <input type="text" class="form-control" name="newEmail" id="newEmail" placeholder="e-mail..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Hasło:</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" pattern="[0-9a-zA-Z]{5,100}"
                               title="Hasło musi zawierać minimum 5 znaków z zakresu [0-9a-zA-Z]" minlength="5" required>
                    </div>
                    <button type="submit" name="submit" value="add" class="btn btn-primary">Załóż nowe konto</button>
                </div>
            </form>
        </div>
    </div>
</div>