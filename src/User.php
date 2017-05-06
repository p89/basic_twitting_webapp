<?php
require_once('PassHandler.php');
require_once('SessionChecker.php');

class User
{
    private $id;
    private $userName;
    private $hashPass;
    private $email;
    private $salt;

    public function __construct()
    {
        $this->setId(-1);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getHashPass()
    {
        return $this->hashPass;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setHashPass($hashPass)
    {
        $hashedPass = passHandler::hashPassword($hashPass);
        $this->hashPass = $hashedPass[0];
        $this->salt = $hashedPass[1];
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function save(PDO $pdo)
    {

        if ($this->id == -1)
        {
            $dupeCheck = $pdo->prepare('SELECT * FROM user WHERE username = :username');
            $dupeCheck->execute(['username'=> $this->getUserName()]);
            $dupeResult = $dupeCheck->fetchAll();

            if ($dupeResult) {
                SessionChecker::redirectWithMsg('Wybrana nazwa użytkownika jest już zajęta.', '?addUser=1');
            }

            $sql = "INSERT INTO user(username, email, hash_password, salt) VALUES (:username, :email, :hashPass, :salt)";

            $prepare = $pdo->prepare($sql);
            $result = $prepare->execute([
                'username' => $this->getUserName(),
                'email' => $this->getEmail(),
                'hashPass' => $this->getHashPass(),
                'salt' => $this->getSalt()
            ]);

            if (!$result) {
                SessionChecker::redirectWithMsg('Zapis się nie powiódł.', '?addUser=1');
            }

            $this->id = $pdo->lastInsertId();
            return (bool)$result;
        }
        else
        {
            $updateSql = "UPDATE user SET hash_password = :hashPass, salt = :salt WHERE user.id = :userId";

            $prepare = $pdo->prepare($updateSql);
            $result = $prepare->execute([
                'hashPass' => $this->getHashPass(),
                'userId' => $this->getId(),
                'salt' => $this->getSalt()
            ]);

            if (!$result) {
                die('Zapis się nie powiódł.');
            }
            return (bool)$result;
        }
    }

    static public function showUserById(PDO $connection, $id)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setUserName($row['username']);
            $loadedUser->hashPass = $row['hash_password'];
            $loadedUser->setEmail($row['email']);
            $loadedUser->salt = $row['salt'];
            return $loadedUser;
        }
        return null;
    }

    static public function showUserByEmail(PDO $connection, $email)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE email=:email');
        $result = $stmt->execute(['email'=> $email]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setUserName($row['username']);
            $loadedUser->hashPass = $row['hash_password'];
            $loadedUser->setEmail($row['email']);
            $loadedUser->salt = $row['salt'];
            return $loadedUser;
        }
        return null;
    }

    static public function showUserByUserName(PDO $connection, $userName)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE username=:userName');
        $result = $stmt->execute(['userName'=> $userName]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->userName = $row['username'];
            $loadedUser->hashPass = $row['hash_password'];
            $loadedUser->email = $row['email'];
            $loadedUser->salt = $row['salt'];
            return $loadedUser;
        }
        return null;
    }

    static public function deleteUserById(PDO $connection, $id)
    {
        $stmt = $connection->prepare('DELETE FROM user WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result) {
            echo "Konto usunięte.";
            $_SESSION['logged'] = false;
            session_unset();
            return true;
        }
        return null;
    }
}