<?php
require_once ('msgWriter.php');

class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $wasRead;
    private $content;
    private $sendDate;

    public function __construct($senderId, $receiverId, $sendDate, $content, $wasRead = 0)
    {
        $this->id = -1;
        $this->setSenderId($senderId);
        $this->setReceiverId($receiverId);
        $this->setWasRead($wasRead);
        $this->setContent($content);
        $this->setSendDate($sendDate);
    }

    public function getWasRead()
    {
        return $this->wasRead;
    }

    public function setWasRead($wasRead)
    {
        $this->wasRead = $wasRead;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
        return $this;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
        return $this;
    }


    public function getSendDate()
    {
        return $this->sendDate;
    }

    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function sendMsg (PDO $connection) {
        $insQuery = "INSERT INTO message (id, sender_id, receiver_id, was_read, content, date_sent) VALUES (null, :senderId, :receiverId, :was_read, :content, :date_sent)";
        $insStmt = $connection->prepare($insQuery);
        $insStmt->execute([
            'senderId' => $this->getSenderId(),
            'receiverId' => $this->getReceiverId(),
            'was_read' => $this->getWasRead(),
            'content' => $this->getContent(),
            'date_sent' => $this->getSendDate()
        ]);
        $lastId = $connection->lastInsertId();
        $this->id = $lastId;
        echo "Wysłano wiadomość o id: " . $this->getId();
    }

    public static function loadMsgBySenderId (INT $senderId, PDO $connection)
    {
        $readQuery = "SELECT * FROM message WHERE sender_id = :senderId ORDER BY date_sent DESC";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['senderId' => $senderId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedMsg = new Message($row['sender_id'], $row['receiver_id'], $row['date_sent'], $row['content'], $row['was_read']);
                $loadedMsg->id = $row['id'];

                $retRecords[] = $loadedMsg;
            }
            return $retRecords;
        }
        return null;
    }

    public static function loadMsgByReceiverId (INT $receiverId, PDO $connection)
    {
        $readQuery = "SELECT * FROM message WHERE receiver_id = :receiverId ORDER BY date_sent DESC";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['receiverId' => $receiverId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedMsg = new Message($row['sender_id'], $row['receiver_id'], $row['date_sent'], $row['content'], $row['was_read']);
                $loadedMsg->id = $row['id'];

                $retRecords[] = $loadedMsg;
            }
            return $retRecords;
        }
        return null;
    }

    static public function writeMsgByReceiverID(PDO $connection, $id) {
        msgWriter::write($connection, self::loadMsgByReceiverId($id, $connection));
    }
}


//
//
//class Tweet
//{
//    private $id;
//    private $title;
//    private $text;
//    private $author;
//    private $date;
//
//    public function __construct($title, $text, $author, $date)
//    {
//        $this->setTitle($title);
//        $this->setText($text);
//        $this->setAuthorId($author);
//        $this->setDate($date);
//    }
//
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    public function setTitle($title)
//    {
//        $this->title = $title;
//    }
//
//    public function getText()
//    {
//        return $this->text;
//    }
//
//    public function setText($text)
//    {
//        $this->text = $text;
//    }
//
//    public function getAuthor()
//    {
//        return $this->author;
//    }
//
//    public function setAuthorId($authorId)
//    {
//        $this->author = $authorId;
//    }
//
//    public function getDate()
//    {
//        return $this->date;
//    }
//
//    public function setDate($date)
//    {
//        $this->date = $date;
//    }
//
//    public function saveTweet (PDO $connection) {
//        $insQuery = "INSERT INTO tweet (id, title, tweetText, tweetDate, author) VALUES (null, :title, :text, :tweetDate, :authorId)";
//        $insStmt = $connection->prepare($insQuery);
//        $insStmt->execute([
//            'title' => $this->getTitle(),
//            'text' => $this->getText(),
//            'tweetDate' => $this->getDate(),
//            'authorId' => $this->getAuthor()
//        ]);
//        $lastId = $connection->lastInsertId();
//        $this->id = $lastId;
//        echo "Dodano tweeta o id: " . $this->getId();
//    }
//
//    public static function loadTweetByUserId (INT $authorId, PDO $connection)
//    {
//        $readQuery = "SELECT * FROM tweet WHERE author = :authorId ORDER BY tweetDate DESC";
//        $retRecords = [];
//
//        $readStmt = $connection->prepare($readQuery);
//        $readStmt->execute(['authorId' => $authorId]);
//        $finalResult = $readStmt->fetchAll();
//
//        if ($finalResult) {
//            foreach ($finalResult as $row) {
//
//                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
//
//
//                $retRecords[] = $loadedTweet;
//            }
//            return $retRecords;
//        }
//        return null;
//    }
//
//    static public function loadAllTweets(PDO $connection)
//    {
//        $readQuery = "SELECT * FROM tweet ORDER BY tweetDate DESC";
//        $retRecords = [];
//
//        $readStmt = $connection->prepare($readQuery);
//        $readStmt->execute();
//        $finalResult = $readStmt->fetchAll();
//
//        if ($finalResult) {
//            foreach ($finalResult as $row) {
//
//                $loadedTweet = new Tweet($row['title'], $row['tweetText'], $row['author'], $row['tweetDate']);
//
//                $retRecords[] = $loadedTweet;
//            }
//            return $retRecords;
//        }
//        return null;
//    }
//
//    static public function writeAllTweets(PDO $connection) {
//        TweetWriter::write($connection, self::loadAllTweets($connection));
//    }
//
//    static public function writeTweetsById(PDO $connection, $id) {
//        TweetWriter::write($connection, self::loadTweetByUserId($id, $connection));
//    }
//
//    static public function loadAuthorById(PDO $connection, $id)
//    {
//        $readQuery = "SELECT username FROM user INNER JOIN tweet on tweet.author = user.id WHERE user.id = :userId";
//
//        $readStmt = $connection->prepare($readQuery);
//        $readStmt->execute(['userId' => $id]);
//        $userName = $readStmt->fetch(PDO::FETCH_ASSOC);
//
//        return $userName['username'];
//    }
//}