<?php
class Calendar {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getEvents($start,$end) {
        $sql = "SELECT * FROM events WHERE start BETWEEN :start AND :end OR end BETWEEN :start AND :end";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->execute(); 
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    }

    public function addEvent($title, $start, $end) {
        $sql = "INSERT INTO events (title, start, end) VALUES (:title, :start, :end)";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end); 
        $stmt->execute();
    }

    public function updateEvent($id, $title) {
        $sql = "UPDATE events SET title = :title WHERE id = :id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'id' => $id]);
    }


    public function dropEvent($id, $start, $end) {
        $sql = "UPDATE events SET start = :start, end = :end WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['start' => $start, 'end' => $end, 'id' => $id]);
    }

    public function deleteEvent($id) {
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

}