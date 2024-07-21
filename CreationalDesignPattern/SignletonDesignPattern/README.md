# Singleton Design Pattern in PHP

### Overview

This project demonstrates the Singleton Design Pattern in PHP. The Singleton Pattern ensures that a class has only one instance and provides a global point of access to it. This is particularly useful for managing shared resources like database connections.
### Implementation
1. DatabaseInstance Class : The DatabaseInstance class is designed to follow the Singleton Design Pattern. It ensures that only one instance of the database connection exists throughout the application's lifecycle.
```php
<?php

namespace Zack\SignletonDesignPattern;

class DatabaseInstance
{
    // The single instance of the class
    private static $instance = null;

    // Database connection parameters
    private string $host;
    private string $port;

    // Private constructor to prevent direct creation of object
    private function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }
    // Method to get the single instance of the class
    public static function getInstance($host, $port)
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $port);
        }

        return self::$instance;
    }
    // Prevent cloning of the instance
    protected function __clone()
    {
    }
    // Prevent unserializing of the instance
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    // Example method to demonstrate functionality
    public function connect()
    {
        // Code to connect to the database using $this->host and $this->port
        echo "Connected to the database at $this->host:$this->port." . "\n";
    }
}
```
### Client Code
```php
<?php

require 'vendor/autoload.php';

use Zack\SignletonDesignPattern\DatabaseInstance;

$db = DatabaseInstance::getInstance('localhost', 3306);
$db->connect();
```
### Explanation
- Private Constructor: The constructor is private to prevent direct creation of objects from outside the class.
- Static getInstance Method: This method checks if an instance of the class already exists. If not, it creates one and returns it. This ensures that only one instance exists.
- Cloning and Unserialization Prevention: The __clone method is protected to prevent cloning of the instance. The __wakeup method throws an exception to prevent unserialization of the instance.
