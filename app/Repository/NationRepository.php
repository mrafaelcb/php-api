<?php


namespace App\Repository;

use Exception;
use PDO;

/**
 * Class NationRepository
 * @package App\Repository
 */
class NationRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por retornar todos os país
     *
     * @return array
     * @throws Exception
     */
    public function all()
    {
        try {
            $query = "SELECT * FROM pais";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * StateRepository constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    /**
     * Responsável pelo Singleton
     *
     * @return NationRepository
     */
    public static function getInstance(): NationRepository
    {
        if (self::$instance === null) {
            self::$instance = new NationRepository();
        }
        return self::$instance;
    }
}