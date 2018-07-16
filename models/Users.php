<?php

class Users extends Model 
{
    private $table = 'usuarios';
    
    public function findAll() 
    {
        $sql = "SELECT * FROM ".$this->table;
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
