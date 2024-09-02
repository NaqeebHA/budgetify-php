<?php

class Account extends Dbh {
     public function all() {
         $sql = "SELECT * FROM account";
         $stmt = $this->connect()->query($sql);
         return $stmt->fetchAll();
     }

     public function add($newAccount) {
         $sql = "INSERT INTO account(name) VALUES (?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$newAccount]);
     }

    //  public function addExpense($id, $minusTotal) {
    //     $sql = "UPDATE `Account` SET `total` = total - ? WHERE `id` = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$minusTotal, $id]);
    // }

    // public function addIncome($id, $addTotal) {
    //     $sql = "UPDATE `Account` SET `total` = total + ? WHERE `id` = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$addTotal, $id]);
    // }

     public function update($id, $name) {
        $sql = "UPDATE `Account` SET `name` = ? WHERE `Account`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
       $sql = "DELETE FROM `Account` WHERE `Account`.`id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
   }
}