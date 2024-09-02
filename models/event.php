<?php

class Event extends Dbh {
    protected function all() {
        $sql = "SELECT * FROM 'event'";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function one($id) {
       $sql = "SELECT * FROM 'event' WHERE id = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
       return $stmt->fetch();
   }

    protected function add($date, $title, $location, $desc, $attachment, $budget) {
        $sql = "INSERT INTO 'event'('date', 'title', 'location' ,'description', 'attachment', 'budget_id') VALUES (?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date, $title, $location, $desc, $attachment, $budget]);
    }

    protected function delete($id) {
       $sql = "DELETE FROM 'event' WHERE id = ?";
       $stmt = $this->connect()->prepare($sql);
       return $stmt->execute([$id]);
   }

   protected function update($id, $date, $title, $location, $desc, $attachment, $budget) {
       $sql = "UPDATE `event` SET 'date' = ?, 'title' = ?, 'location' = ?,'description' = ?, 'attachment' =?, 'budget_id' = ? WHERE `id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$date, $title, $location, $desc, $attachment, $budget, $id]);
   }
}