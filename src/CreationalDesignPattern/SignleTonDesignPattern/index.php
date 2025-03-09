<?php

use Zack\LaravelDesignPatterns\CreationalDesignPattern\SignleTonDesignPattern\DatabaseInstance;

require "vendor/autoload.php";

$db = DatabaseInstance::getInstance('localhost', 3306);
$db->connect();