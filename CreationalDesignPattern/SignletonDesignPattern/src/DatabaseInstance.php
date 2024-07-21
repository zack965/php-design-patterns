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
