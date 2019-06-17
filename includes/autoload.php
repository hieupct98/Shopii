<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("connect.php");
require_once("item.class.php");
require_once("category.class.php");
require_once("functions.php");
global $conn;
Item::setDB($conn);
?>