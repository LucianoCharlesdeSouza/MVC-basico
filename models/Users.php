<?php

class Users extends Model {

    public function findAll() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
