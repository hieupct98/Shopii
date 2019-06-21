<?php 
class Admin
{
    static public $table_name = "users";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['ID', 'email', 'password'];

    public $ID;
    public $email;
    public $password;

    /**
     * 
     * Category constructor
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->ID = $data['ID'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    /**
     * @param $db
     */
    static public function setDB($db)
    {
        self::$database = $db;
    }

    /**
     * Hàm giúp chuyển dữ liệu vào trong đối tượng
     * @param $record
     * @return Admin
     */
    static protected function instantiate($record)
    {
        $object = new static;
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column == 'ID') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    //chống SQL Injection
    protected function sanitized_attributes()
    {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->real_escape_string($value);
        }
        return $sanitized;
    }

    public function getRole()
    {
        $query = "SELECT * FROM users INNER JOIN user_role ON users.ID = user_role.userID ";
        $query .= "INNER JOIN roles ON user_role.roleID = roles.ID WHERE users.ID = '$this->ID'";
        $result = Admin::$database->query($query);
        $row = $result->fetch_assoc();
        $role = $row['name'];
        return $role;
    }

    static public function findByQuery($sql)
    {
        $result = static::$database->query($sql);
        if (!$result) {
            exit("Database query failed.");
        }

        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

    static public function findByID($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE ID='" . self::$database->escape_string($id) . "'";
        $obj_array = static::findByQuery($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static public function findAll()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::findByQuery($sql);
    }

    public function delete()
    {
        self::$database->autocommit(FALSE);
        $sql = "DELETE FROM user_product WHERE userID = $this->ID";
        self::$database->query($sql);
        if (self::$database->affected_rows < 0) {
            self::$database->rollback();
            return false;
        } else {
            $sql2 = "DELETE FROM user_role WHERE userID = $this->ID";
            self::$database->query($sql2);
            if (self::$database->affected_rows < 0) {
                self::$database->rollback();
                return false;
            } else {
                $sql3 = "DELETE FROM user_order WHERE userID = $this->ID";
                self::$database->query($sql3);
                if (self::$database->affected_rows < 0) {
                    self::$database->rollback();
                    return false;
                } else {    
                    $sql4 = "DELETE FROM " . static::$table_name . " ";
                    $sql4 .= "WHERE ID='" . self::$database->escape_string($this->ID) . "' ";
                    $sql4 .= "LIMIT 1";
                    self::$database->query($sql4);
                    if (self::$database->affected_rows < 0) {
                        self::$database->rollback();
                        return false;
                    } else {
                        self::$database->commit();
                        return true;
                    }
                }
            }
        }
    }

    public function update()
    {
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE ID='" . self::$database->escape_string($this->ID) . "' ";
        $result = self::$database->query($sql);
        return $result;
    }

    public function productsCount()
    {
        $sql = "SELECT COUNT(*) FROM user_product WHERE userID = $this->ID";
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
}
?>