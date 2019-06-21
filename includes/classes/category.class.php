<?php
class Category
{
    static public $table_name = "Categories";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['id', 'Name'];

    public $id;
    public $Name;

    /**
     * 
     * Category constructor
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? '';
        $this->Name = $data['Name'] ?? '';
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
     * @return Category
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

    static public function findAll()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::findByQuery($sql);
    }
}
