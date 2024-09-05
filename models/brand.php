<?php

class Brand extends Dbh {
     public function all() {
         $sql = "SELECT * FROM Brand";
         $stmt = $this->connect()->query($sql);
         return $stmt->fetchAll();
     }

     public function add($newBrand) {
         $sql = "INSERT INTO Brand(name) VALUES (?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$newBrand]);
     }

     public function update($id, $name) {
        $sql = "UPDATE `Brand` SET `name` = ? WHERE `Brand`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
       $sql = "DELETE FROM `Brand` WHERE `Brand`.`id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
   }
}