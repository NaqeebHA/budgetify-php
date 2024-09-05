<?php

class Apparel extends Dbh {
    protected function all() {
        $sql = "SELECT * FROM apparel";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function byType($id) {
        $sql = "SELECT * FROM apparel where type_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function one($id) {
       $sql = "SELECT * FROM apparel WHERE id = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$id]);
       return $stmt->fetch();
   }

    protected function byTypeStatsTimeframe($type_id, $from, $to) {
        $sql = "SELECT appType.name as type, COUNT(appType.name) as total FROM apparel app JOIN apparel_type appType 
                ON app.type_id = appType.id 
                WHERE DATE(app.purchased_date) BETWEEN ? AND ? 
                AND app.type_id = ? 
                GROUP BY 'type'
                ORDER BY total DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$from, $to, $type_id]);
        return $stmt->fetchAll();
    } 

    protected function add($note, $type, $color, $date, $qty, $price, $brand, $style, $desc, $attachment, $budget) {
        $sql = "INSERT INTO apparel(note, type_id, color, purchased_date, qty, price, brand_id, style_id, description, attachment, budget_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$note, $type, $color, $date, $qty, $price, $brand, $style, $desc, $attachment, $budget]);
    }

    protected function delete($id) {
       $sql = "DELETE FROM apparel WHERE id = ?";
       $stmt = $this->connect()->prepare($sql);
       return $stmt->execute([$id]);
   }

    protected function deleteAttachment($id) {
        $sql = "UPDATE `apparel` SET attachment = NULL WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected function update($id, $note, $type, $color, $purchased_date, $qty, $price, $brand, $style, $desc, $budget, $attachment) {
       $sql = "UPDATE `apparel` SET note = ?, type_id = ?, color = ?, purchased_date = ?, qty = ?, price = ?, brand_id = ?, style_id = ?, description = ?, attachment = ?, budget_id = ? WHERE `id` = ?";
       $stmt = $this->connect()->prepare($sql);
       $stmt->execute([$note, $type, $color, $purchased_date, $qty, $price, $brand, $style, $desc, $attachment, $budget, $id]);
    }

    protected function updateWithoutAttachment($id, $note, $type, $color, $purchased_date, $qty, $price, $brand, $style, $desc, $budget) {
        $sql = "UPDATE apparel SET note = ?, type_id = ?, color = ?, purchased_date = ?, qty = ?, price = ?, brand_id = ?, style_id = ?, description = ?, budget_id = ? WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$note, $type, $color, $purchased_date, $qty, $price, $brand, $style, $desc, $budget, $id]);
    }
}