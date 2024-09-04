<?php

class Budget extends Dbh {
     protected function all() {
         $sql = "SELECT * FROM Budget ORDER BY date DESC";
         $stmt = $this->connect()->query($sql);
         return $stmt->fetchAll();
     }

     protected function one($id) {
        $sql = "SELECT * FROM Budget WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    protected function allTimeframe($from, $to) {
        $sql = "SELECT * FROM Budget b
                WHERE DATE(b.date) BETWEEN ? AND ? 
                ORDER BY b.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to]);
        return $stmt->fetchAll();
    }

    protected function categoricallyTimeframe($category, $from, $to) {
        $sql = "SELECT * FROM Budget b
                WHERE DATE(b.date) BETWEEN ? AND ? 
                AND b.category_id = ?
                ORDER BY b.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $category]);
        return $stmt->fetchAll();
    }

    protected function byAccountTimeframe($account, $from, $to) {
        $sql = "SELECT * FROM Budget b
                WHERE DATE(b.date) BETWEEN ? AND ? 
                AND b.account_id = ?
                ORDER BY b.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $account]);
        return $stmt->fetchAll();
    }

    protected function total($in_out) {
        $sql = "SELECT SUM(b.amount) as total FROM budget b
                WHERE b.in_out = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$in_out]);
        return $stmt->fetchAll();
    }

    protected function totalTimeframe($in_out, $from, $to) {
        $sql = "SELECT SUM(b.amount) as total FROM budget b
                AND b.in_out = ? 
                AND account_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $in_out]);
        return $stmt->fetchAll();
    }

    protected function totalByAccount($in_out, $account) {
        $sql = "SELECT SUM(b.amount) as total FROM budget b
                WHERE b.in_out = ? 
                AND account_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$in_out, $account]);
        return $stmt->fetch();
    }
    
    protected function totalByAccountTimeframe($in_out, $from, $to, $account) {
        $sql = "SELECT SUM(b.amount) as total FROM budget b
                WHERE DATE(b.date) BETWEEN ? AND ? 
                AND b.in_out = ? 
                AND account_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $in_out, $account]);
        return $stmt->fetch();
    }

    protected function listByAccountTimeframe($in_out, $from, $to) {
        $sql = "SELECT b.account_id as accountId, a.name as account, SUM(b.amount) as total FROM budget b
                JOIN account a ON b.account_id = a.id
                WHERE DATE(b.date) BETWEEN ? AND ? 
                AND b.in_out = ?
                GROUP BY accountId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $in_out]);
        return $stmt->fetchAll();
    }

    protected function statsTimeframe($in_out, $from, $to) {
        $sql = "SELECT c.id as categoryId, c.name as category, SUM(b.amount) as total FROM budget b JOIN category c 
                ON b.category_id = c.id 
                WHERE DATE(b.date) BETWEEN ? AND ? 
                AND c.in_out = ? 
                GROUP BY b.category_id
                ORDER BY total DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $in_out]);
        return $stmt->fetchAll();
    }

     protected function add($account, $in_out, $category, $amount, $date, $note, $desc, $attachment) {
         $sql = "INSERT INTO Budget(account_id, in_out, category_id, amount, date, note, description, attachment) VALUES (?,?,?,?,?,?,?,?)";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$account, $in_out, $category, $amount, $date, $note, $desc, $attachment]);
     }

     protected function delete($id) {
        $sql = "DELETE FROM Budget WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected function deleteAttachment($id) {
        $sql = "UPDATE `budget` SET attachment = NULL WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected function update($id, $account, $in_out, $category, $amount, $date, $note, $desc, $attachment) {
        $sql = "UPDATE `budget` SET account_id = ?, in_out = ?, category_id = ?, amount = ?, date = ?, note = ?, description = ?, attachment = ? WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$account, $in_out, $category, $amount, $date, $note, $desc, $attachment, $id]);
    }

    protected function updateWithoutAttachment($id, $account, $in_out, $category, $amount, $date, $note, $desc) {
        $sql = "UPDATE `budget` SET account_id = ?, in_out = ?, category_id = ?, amount = ?, date = ?, note = ?, description = ? WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$account, $in_out, $category, $amount, $date, $note, $desc, $id]);
    }
}