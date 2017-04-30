<?php

class User
{
    private $id;
    private $userName;
    private $hashPass;
    private $email;

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

    public function setHashPass($hashPass)
    {
        $this->hashPass = $hashPass;
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
            $sql = "INSERT INTO user(username, email, hash_password) VALUES (:username, :email, :hashPass)";


            $prepare = $pdo->prepare($sql);
            $result = $prepare->execute([
                'username' => $this->userName,
                'email' => $this->email,
                'hashPass' => $this->hashPass

            ]);

            if (!$result) {
                die('Zapis się nie powiódł.');
            }

            $this->id = $pdo->lastInsertId();

            return (bool)$result;

        }
        else
        {

        }
    }

    static public function showUserById(PDO $connection, $id)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPassword = $row['hash_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }

        return null;
    }




    static public function showUserByEmail(PDO $connection, $email)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE email=:email');
        $result = $stmt->execute(['email'=> $email]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPassword = $row['hash_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }

        return null;
    }




}