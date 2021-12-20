<?php

namespace App\Repository;

use PDO;

class Connection extends PDO
{
    public static $instance;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';port=' . $_ENV['DB_PORT'] . ';charset=utf8';

        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $options = null;

        parent::__construct($dsn, $username, $password, $options);
    }

    /**
     * Responsável pelo Singleton
     *
     * @return Connection
     */
    public static function getInstance(): Connection
    {
        if (!isset(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
}