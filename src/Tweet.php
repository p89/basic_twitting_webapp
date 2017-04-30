<?php

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

    public function setId($id)
    {
        $this->id = $id;
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
        $insQuery = "INSERT INTO tweet (title, tweetText, tweetDate, author) VALUES (:title, :text, :date, :authorId)";
        $insStmt = $connection->prepare($insQuery);
        $insStmt->execute(['title' => $this->getTitle(), 'text' => $this->getText(), 'date' => $this->getDate(), 'authorId' => $this->getAuthor()]);
        $lastId = $connection->lastInsertId();
        $this->setId($lastId);
        echo "Dodano tweeta o id: " . $lastId;

    }

    public static function loadTweetByUserId () {

    }

    static public function loadAllTweets(PDO $connection)
    {
        $readQuery = "SELECT * FROM tweet ORDER BY tweetDate DESC";
        $retRecords = []; // pusta tablica w której przechowamy wyniki zapytania

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute();
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
                $loadedTweet->setId($row['id']);

                $retRecords[] = $loadedTweet;
            }
            return $retRecords;
        }
        return null;
    }





}