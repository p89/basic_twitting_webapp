<?php
require_once ('TweetWriter.php');

class Tweet
{
    private $id;
    private $title;
    private $text;
    private $author;
    private $date;

    public function __construct($title, $text, $author, $date)
    {
        $this->setTitle($title);
        $this->setText($text);
        $this->setAuthorId($author);
        $this->setDate($date);
    }

    public function getId()
    {
        return $this->id;
    }

        public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthorId($authorId)
    {
        $this->author = $authorId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function saveTweet (PDO $connection) {
        $insQuery = "INSERT INTO tweet (id, title, tweetText, tweetDate, author) VALUES (null, :title, :text, :tweetDate, :authorId)";
        $insStmt = $connection->prepare($insQuery);
        $insStmt->execute([
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'tweetDate' => $this->getDate(),
            'authorId' => $this->getAuthor()
        ]);
        $lastId = $connection->lastInsertId();
        $this->id = $lastId;
        echo "Dodano tweeta o id: " . $this->getId();
    }

    public static function loadTweetByUserId (INT $authorId, PDO $connection)
    {
        $readQuery = "SELECT * FROM tweet WHERE author = :authorId ORDER BY tweetDate DESC";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['authorId' => $authorId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
                $loadedTweet->id = $row['id'];

                $retRecords[] = $loadedTweet;
            }
            return $retRecords;
        }
        return null;
    }

    public static function loadTweetByTweetId (INT $tweetId, PDO $connection)
    {
        $readQuery = "SELECT * FROM tweet WHERE id = :tweetId";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['tweetId' => $tweetId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
                $loadedTweet->id = $row['id'];

                $retRecords[] = $loadedTweet;
            }
            return $retRecords;
        }
        return null;
    }

    public static function loadAllTweets(PDO $connection)
    {
        $readQuery = "SELECT * FROM tweet ORDER BY tweetDate DESC";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute();
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
                $loadedTweet->id = $row['id'];

                $retRecords[] = $loadedTweet;
            }
            return $retRecords;
        }
        return null;
    }

    public static function writeAllTweets(PDO $connection) {
        TweetWriter::write($connection, self::loadAllTweets($connection));
    }

    public static function writeTweetsByUserId(PDO $connection, $id) {
        TweetWriter::write($connection, self::loadTweetByUserId($id, $connection));
    }

    public static function writeTweetsByTweetId(PDO $connection, $id) {
        TweetWriter::write($connection, self::loadTweetByTweetId($id, $connection));
    }

    // to jest chyba niepotrzebne, bo można wykorzystać funkcję load user by id z klasy user
    static public function loadAuthorById(PDO $connection, $id)
    {
        $readQuery = "SELECT username FROM user INNER JOIN tweet on tweet.author = user.id WHERE user.id = :userId";

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['userId' => $id]);
        $userName = $readStmt->fetch(PDO::FETCH_ASSOC);

        return $userName['username'];
    }
}