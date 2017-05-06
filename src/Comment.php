<?php
require_once ('CommentWriter.php');

class Comment
{
    private $id;
    private $userId;
    private $tweetId;
    private $content;
    private $datePosted;

    public function __construct($userId, $tweetId, $content, $datePosted)
    {
        $this->setUserId($userId);
        $this->setTweetId($tweetId);
        $this->setContent($content);
        $this->setDatePosted($datePosted);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getTweetId()
    {
        return $this->tweetId;
    }

    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDatePosted()
    {
        return $this->datePosted;
    }

    public function setDatePosted($datePosted)
    {
        $this->datePosted = $datePosted;
    }

    public function saveToDB(PDO $connection) {
        $insQuery = "INSERT INTO comment (id, user_id, tweet_id, content, date_posted) VALUES (null, :user_id, :tweet_id, :content, :date_posted)";
        $insStmt = $connection->prepare($insQuery);
        $insStmt->execute([
            'user_id' => $this->getUserId(),
            'tweet_id' => $this->getTweetId(),
            'content' => $this->getContent(),
            'date_posted' => $this->getDatePosted()
        ]);
        $lastId = $connection->lastInsertId();
        $this->id = $lastId;
        echo "Dodano komentarz o: " . $this->getId();
    }

    public static function loadCommentByPostId (INT $tweetId, PDO $connection)
    {
        $readQuery = "SELECT * FROM comment WHERE tweet_id = :tweetId";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['tweetId' => $tweetId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedComment = new Comment($row['user_id'], $row['tweet_id'], $row['content'], $row['date_posted']);
                $loadedComment->id = $row['id'];

                $retRecords[] = $loadedComment;
            }
            return $retRecords;
        }
        return null;
    }

    public static function loadCommentByCommentId (INT $commentId, PDO $connection)
    {
        $readQuery = "SELECT * FROM comment WHERE id = :commentId ORDER BY date_posted DESC";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['commentId' => $commentId]);
        $finalResult = $readStmt->fetchAll();

        if ($finalResult) {
            foreach ($finalResult as $row) {

                $loadedComment = new Comment($row['userId'], $row['tweetId'], $row['content'], $row['datePosted']);
                $loadedComment->id = $row['id'];

                $retRecords[] = $loadedComment;
            }
            return $retRecords;
        }
        return null;
    }

    public static function writeCommentsById(PDO $connection, $id) {
        CommentWriter::write($connection, self::loadCommentByCommentId($id, $connection));
    }

    public static function writeCommentsByTweetId(PDO $connection, $id) {
        CommentWriter::write($connection, self::loadCommentByPostId($id, $connection));
    }
}