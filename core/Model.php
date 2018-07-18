<?php

class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = DB::getConn();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM " . $this->table;

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

    public function find($field, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :{$field} LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":{$field}", $value);

        try {

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public function insert(array $data)
    {
        $fields = implode(', ', array_keys($data));

        $keys = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$keys})";

        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {

            switch ($value) {

                case is_int($value):
                    $param = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $param = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $param = PDO::PARAM_NULL;
                    break;
                case is_string($value):
                    $param = PDO::PARAM_STR;
                    break;
            }

            $stmt->bindValue(":{$key}", $value, $param);
        }

        try {

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                return true;
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public function update(array $data, $field, $value_field)
    {
        $fields = [];

        foreach ($data as $key => $value) {

            $fields[] = "$key=:$key";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE {$field} = :id";

        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {

            switch ($value) {

                case is_int($value):
                    $param = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $param = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $param = PDO::PARAM_NULL;
                    break;
                case is_string($value):
                    $param = PDO::PARAM_STR;
                    break;
            }

            $stmt->bindValue(":{$key}", $value, $param);
        }

        $stmt->bindValue(":id", $value_field, (is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR);

        try {

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                return true;
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public function delete($field, $value_field)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$field} = :{$field}";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":{$field}", $value_field);

        try {

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                return true;
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public function lastId()
    {
        return $this->db->lastInsertId();
    }

    public function maxId($field)
    {
        $sql = "SELECT MAX({$field}) AS max_id FROM " . $this->table;

        $stmt = $this->db->prepare($sql);

        try {

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $db = database();

                $fetch_mode = $db['fetch_mode'];

                return ($fetch_mode == 5) ? $stmt->fetch()->max_id : $stmt->fetch()['max_id'];
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

}
