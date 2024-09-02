<?php

class ApparelType extends Dbh {
     public function all() {
         $sql = "SELECT * FROM ApparelType";
         $stmt = $this->connect()->query($sql);
         while($row = $stmt->fetch()) {
            echo $row['name'] . '<br>';
         }
     }

     public function add($newApparelType) {
         $sql = "INSERT INTO ApparelType(name) VALUES (?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$newApparelType]);
     }

     public function update($id, $name) {
        $sql = "UPDATE `Apparel_Type` SET `name` = ? WHERE `ApparelType`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
       $sql = "DELETE FROM `Apparel_Type` WHERE `Apparel_Type`.`id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
   }
}