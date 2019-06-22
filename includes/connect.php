<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "shopii");
$conn=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$conn->set_charset('utf8mb4');
    