<?php
require_once('bootstrap.php');


$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::showUserByEmail($connection, $email);
    if ($user) {

        if ($user->getHashPass() == $password) {
            $_SESSION['logged'] = true;
            echo "ZALOGOWANY";

        } else {
            $errors[] = "Hasło niepoprawne.";
        }

    } else {
        $errors[] = "Nie ma takiego użytkownika.";
    }


} else {



}
?>


<html>
<body>
<form method="post">
    <?php echo join('<br>', $errors); ?>
    <br>
    Email: <input name="email">
    <br>
    Haslo: <input name="password" type="password">
    <br>
    <button type="submit">Loguj</button>
</form>
</body>
</html>
