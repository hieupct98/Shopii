<?php
class Item
{
    static public $table_name = "Products";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['ID', 'name', 'catID', 'price', 'image', 'description', 'stock', 'create_at'];

    public $ID;
    public $name;
    public $catID;
    public $price;
    public $image;
    public $descrpition;
    public $stock;
    public $create_at;

    public $userID;
    public $category;
    public $user;
    public $quantity;

    /**
     * Item constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->ID = $data['ID'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->catID = $data['catID'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->stock = $data['stock'] ?? '';
        $this->create_at = $data['create_at'] ?? '';
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
     * @return Item
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
    
    //Lấy tên danh mục khi có catID
    public function getCategory(): string
    {
        $catID = $this->catID;
        $query = "SELECT * FROM categories WHERE id = '$catID'";
        $result = Item::$database->query($query);
        $row = $result->fetch_assoc();
        $category = $row['Name'];
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

    public function getUserID()
    {
        $query = "SELECT * FROM user_product INNER JOIN products ON ";
        $query .= "user_product.productID = products.ID WHERE products.ID = '$this->ID'";
        $result = Item::$database->query($query);
        $row = $result->fetch_assoc();
        $user = $row['userID'];
        return $user;
    }

    /**
     * @return int
     */
    static public function count_all()
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }

    /**
     * @param $sql
     * @return array
     */
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

    /**
     * 
     *Hàm giúp tìm sản phẩm khi biết người bán
     * @param [type] $uid
     * @return Item
     */
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
    /**
     * Tìm sản phẩm theo hoá đơn
     *
     * @param int $oid
     * @return array
     */
    public static function findByOrder($oid)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN orderdetail ON products.ID = orderdetail.productID ";
        $sql .= "WHERE orderID = '" . self::$database->escape_string($oid) . "'";
        return static::findByQuery($sql);
    }

    public static function findByCategory($cat)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_product ON products.ID = user_product.productID";
        $sql .= " INNER JOIN categories ON products.catID = categories.id ";
        $sql .= "WHERE categories.Name='" . self::$database->escape_string($cat) . "'";
        return static::findByQuery($sql);
    }

    static public function topNewProducts($number)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_product ON products.ID = user_product.productID ORDER BY create_at DESC LIMIT $number";
        return static::findByQuery($sql);
    }

    static public function findAll()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_product ON products.ID = user_product.productID";
        return static::findByQuery($sql);
    }

    public function delete()
    {
        self::$database->autocommit(false);
        $sql = "DELETE FROM user_product WHERE productID = $this->ID";
        echo $sql;
        self::$database->query($sql);
        echo self::$database->affected_rows;
        if (self::$database->affected_rows < 0) {
            self::$database->rollback();
            return false;
        } else {
            $sql2 = "DELETE FROM " . static::$table_name . " ";
            $sql2 .= "WHERE ID='" . self::$database->escape_string($this->ID) . "' ";
            $sql2 .= "LIMIT 1";
            echo $sql2;
            self::$database->query($sql2);
            echo self::$database->affected_rows;
            if (self::$database->affected_rows < 0) {
                self::$database->rollback();
                return false;
            } else {
                self::$database->commit();
                self::$database->autocommit(true);
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
        if (self::$database->affected_rows <= 0) {
            self::$database->rollback();
            return false;
        } else {
            $this->userID = $_SESSION['ID'];
            $sql2 = "INSERT INTO user_product(userID,productID) VALUE ($this->userID,LAST_INSERT_ID())";
            self::$database->query($sql2);
            if (self::$database->affected_rows <= 0) {
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
