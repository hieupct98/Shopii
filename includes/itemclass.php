<?php
class Item
{
    static public $table_name = "Products";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['ID', 'name', 'catID', 'price', 'image', 'description', 'quantity'];

    public $ID;
    public $name;
    public $catID;
    public $price;
    public $image;
    public $descrpition;
    public $quantity;

    public $userID;
    public $category;
    public $user;

    public function __construct($data = [])
    {
        $this->ID = $data['ID'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->catID = $data['catID'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->quantity = $data['quantity'] ?? '';
    }

    static public function setDB($db)
    {
        self::$database = $db;
    }

    //Hàm giúp chuyển dữ liệu vào trong đối tượng
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

    static public function count_all()
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }


    //Lấy tên danh mục khi có catID
    public function getCategory(): string
    {
        $catID = $this->catID;
        $query = "SELECT * FROM categories WHERE ID = '$catID'";
        $result = Item::$database->query($query);
        $row = $result->fetch_assoc();
        $category = $row['name'];
        return $category;
    }


    //Lấy tên người bán khi có productID
    public function getUser()
    {
        $query = "SELECT * FROM users INNER JOIN user_product ON users.ID = user_product.userID ";
        $query .= "INNER JOIN products ON user_product.productID = products.ID WHERE products.ID = '$this->ID'";
        $result = Item::$database->query($query);
        $row = $result->fetch_assoc();
        $user = $row['email'];
        return $user;
    }

    public static function findByUser($uid)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_product ON products.ID = user_product.productID ";
        $sql .= "WHERE userID='" . self::$database->escape_string($uid) . "'";
        return static::findByQuery($sql);
    }

    static public function findByID($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_product ON products.ID = user_product.productID ";
        $sql .= "WHERE productID='" . self::$database->escape_string($id) . "'";
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
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE ID='" . self::$database->escape_string($this->ID) . "' ";
        $sql .= "LIMIT 1";
        self::$database->query($sql);
        if (!self::$database->affected_rows) {
            self::$database->rollback();
            return false;
        } else {
            $this->userID = $_SESSION['ID'];
            $sql2 = "DELETE FROM user_product(userID,productID) WHERE productID = $this->ID";
            self::$database->query($sql2);
            if (!self::$database->affected_rows) {
                self::$database->rollback();
                return false;
            } else {
                self::$database->commit();
                return true;
            }
        }
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

    /**
     * @return bool
     */
    public function create()
    {
        self::$database->autocommit(FALSE);
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        self::$database->query($sql);
        if (!self::$database->affected_rows) {
            self::$database->rollback();
            return false;
        } else {
            $this->userID = $_SESSION['ID'];
            $sql2 = "INSERT INTO user_product(userID,productID) VALUE ($this->userID,LAST_INSERT_ID())";
            self::$database->query($sql2);
            if (!self::$database->affected_rows) {
                self::$database->rollback();
                return false;
            } else {
                self::$database->commit();
                return true;
            }
        }
    }

    public function merge_attributes($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
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
}
