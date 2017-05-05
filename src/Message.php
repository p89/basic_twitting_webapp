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
        echo "Wiadomość wysłana poprawnie.";
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

    public static function loadMsgByMsgId (INT $msgId, PDO $connection)
    {
        $readQuery = "SELECT * FROM message WHERE id = :msgId";
        $retRecords = [];

        $readStmt = $connection->prepare($readQuery);
        $readStmt->execute(['msgId' => $msgId]);
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

    public static function writeMsgByReceiverID(PDO $connection, $id) {
        msgWriter::write($connection, self::loadMsgByReceiverId($id, $connection));
    }

    public function setReadStatus (PDO $connection, $status) {
        $updQuery = "UPDATE message SET was_read = :was_read WHERE id = :msgId";
        $updStmt = $connection->prepare($updQuery);
        $updStmt->execute([
            'was_read' => $status,
            'msgId' => $this->getId()
        ]);
    }
}