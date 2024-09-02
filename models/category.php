<?php

class Category extends Dbh {
     public function all() {
         $sql = "SELECT * FROM category";
         $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
     }

     public function out() {
        $sql = "SELECT * FROM category WHERE in_out = 0";
        $stmt = $this->connect()->query($sql);
       return $stmt->fetchAll();
    }

    public function in() {
        $sql = "SELECT * FROM category WHERE in_out = 1";
        $stmt = $this->connect()->query($sql);
       return $stmt->fetchAll();
    }

     public function add($newCategory) {
         $sql = "INSERT INTO category(name) VALUES (?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$newCategory]);
     }

     public function update($id, $name, $in_out) {
         $sql = "UPDATE `category` SET `name` = ?, `in_out` = ? WHERE `category`.`id` = ?";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$name, $in_out, $id]);
     }

     public function delete($id) {
        $sql = "DELETE FROM `category` WHERE `category`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}