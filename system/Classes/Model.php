<?php
/**
 * Class Model

 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class Model
{

    use Pagination;

    protected $db;
    protected $table;

    /**
     * Passa a instância do objeto PDO para o atributo $db
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = DB::getConn();
    }

    /**
     * Método que pode receber até 03 paramêtros
     * permitindo assim montar o SQL como desejado e
     * retorna um array se houver resultados
     * <b>Exemplo</b>
     * <p>$bindValue = ['id' => 5]</p>
     * <p>findAll("WHERE id > :id, $bindValue, 10)</p>
     * @param null $where
     * @param null $bindValue
     * @param int $limit
     * @return array|mixed
     */
    public function findAll($where = null, $bindValue = null, $limit = 0)
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }

        $stmt = $this->db->prepare($sql);

        if ($bindValue) {
            foreach ($bindValue as $key => $value) {

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
        }

        try {

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return ($limit == 1 || $stmt->rowCount() == 1) ? $stmt->fetch() : $stmt->fetchAll();
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    /**
     * Método que recebe 03 paramêtros para compor a instrução SQL
     * <b>Exemplo</b>
     * <p>find("id", '=', 5)</p>
     * @param $field
     * @param $condition
     * @param $value
     * @return array|mixed
     */
    public function find($field, $condition, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$condition} :{$field} LIMIT 1";

        $stmt = $this->db->prepare($sql);

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

        $stmt->bindValue(":{$field}", $value, $param);

        try {

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return $stmt->fetch();
            }
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    /**
     * Método que recebe um array de dados para a inserção
     * <b>Exemplo<b/>
     * <p>$dados_form = ['user_name' => 'Luciano Charles', 'user_genre' => 'M'] </p>
     * <p>$user->insert($dados_form)</p>
     * @param array $data
     * @return bool
     */
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

    /**
     * Método que recebe um array de dados, mais o campo referente e seu valor
     * e aplica o update na coluna
     * <b>Exemplo<b/>
     * <p>$dados_form = ['user_name' => 'Luciano Charles', 'user_genre' => 'M'] </p>
     * <p>$user->update($dados_form, 'user_id' , 5)</p>
     * @param array $data
     * @param $field
     * @param $value_field
     * @return bool
     */
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

    /**
     * Método que recebe um nome de coluna e seu valor e aplica o delete
     * <Exemplo</b>
     * <p>$user->delete('user_id', 5)</p>
     * @param $field
     * @param $value_field
     * @return bool
     */
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

    /**
     * Método que ser for executado logo após um insert,
     * retornará o último id inserido na tabela
     * @return int
     */
    public function lastId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * Método que recebe o nome da coluna autoincrement da tabela
     * e retorna seu maior valor
     * @param $field
     * @return mixed
     */
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
