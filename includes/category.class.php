<?php
class Category
{
    static public $table_name = "Categories";
    static public $database;
    static protected $columns = [];
    static public $db_columns = ['ID', 'name'];

    public $ID;
    public $name;

    /**
     * 
     * Category constructor
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->ID = $data['ID'] ?? '';
        $this->name = $data['name'] ?? '';
    }

    /**
     * @param $db
     */
    static public function setDB($db)
    {
        self::$database = $db;
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
