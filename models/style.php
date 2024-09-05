<?php

class Style extends Dbh {
     public function all() {
         $sql = "SELECT * FROM Style";
         $stmt = $this->connect()->query($sql);
         return $stmt->fetchAll();
     }

     public function add($newStyle) {
         $sql = "INSERT INTO Style(name) VALUES (?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$newStyle]);
     }

     public function update($id, $name) {
        $sql = "UPDATE `Style` SET `name` = ? WHERE `Style`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
       $sql = "DELETE FROM `Style` WHERE `Style`.`id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
   }
}