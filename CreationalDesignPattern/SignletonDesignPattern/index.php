<?php
require 'vendor/autoload.php';

use Zack\SignletonDesignPattern\DatabaseInstance;

$db = DatabaseInstance::getInstance('localhost', 3306);
$db->connect();
