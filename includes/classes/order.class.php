<?php
require_once("item.class.php");
class Order
{
    static public $table_name = "orders";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['ID', 'total', 'create_at'];

    public $ID;
    public $total;
    public $create_at;

    public $userID;
    public $category;
    public $user;

    /**
     * constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->ID = $data['ID'] ?? '';
        $this->total = $data['total'] ?? '';
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
     *Hàm giúp tìm hoá đơn khi biết người bán
     * @param [type] $uid
     * @return array
     */
    public static function findByUser($uid)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " INNER JOIN user_order ON orders.ID = user_order.orderID ";
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
    public function create($arr = [])
    {
        self::$database->autocommit(FALSE);
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        self::$database->query($sql);
        echo $sql . "<br/>";
        echo self::$database->affected_rows;
        if (self::$database->affected_rows < 0) {
            self::$database->rollback();
            return false;
        } else {
            $orderID = self::$database->insert_id;
            $this->userID = $_SESSION['ID'];
            $sql2 = "INSERT INTO user_order(userID,orderID) VALUE ($this->userID,$orderID)";
            self::$database->query($sql2);
            echo $sql2 . "<br/>";
            echo self::$database->affected_rows;
            if (self::$database->affected_rows < 0) {
                self::$database->rollback();
                return false;
            } else {
                $sql3 = "INSERT INTO orderdetail(orderID,productID,quantity) VALUE ";
                foreach ($arr as $item) {
                    $sql3 .= "('" . $orderID . "', '";
                    $sql3 .= join("', '", array_values($item));
                    $sql3 .= "'), ";
                }
                $sql3 = substr($sql3,0,-2);
                self::$database->query($sql3);
                echo $sql3 . "<br/>";
                echo self::$database->affected_rows;
                if (self::$database->affected_rows < 0) {
                    self::$database->rollback();
                    return false;
                } else {
                    foreach ($arr as $item) {
                        $id = $item['id'];
                        $quantity = $item['quantity'];
                        $sp = Item::findByID($id);
                        $sql4 = "UPDATE products SET stock = $sp->stock-$quantity WHERE ID = $id";
                        self::$database->query($sql4);
                        echo $sql4 . "<br/>";
                        echo self::$database->affected_rows;
                        if (self::$database->affected_rows < 0) {
                            self::$database->rollback();
                            return false;
                        }
                    }
                    self::$database->commit();
                    return true; 
                }
            }
        }
    }
}
?>