<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("connect.php");
session_start();
function my_autoload($class)
{
    if(preg_match('/\A\w+\Z/', $class)) {
        require_once('classes/' . $class . '.class.php');
    }
}
spl_autoload_register('my_autoload');
require_once("functions.php");
global $conn;
Item::setDB($conn);
Category::setDB($conn);
Admin::setDB($conn);
Order::setDB($conn);
