<?php


namespace App\Repository;

use Exception;
use PDO;

/**
 * Class StateRepository
 * @package App\Repository
 */
class StateRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por retornar estado por id do país
     *
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function getByFkPais(string $id)
    {
        try {
            $query = "SELECT * FROM estado WHERE fk_pais = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$id]);

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
     * @return StateRepository
     */
    public static function getInstance(): StateRepository
    {
        if (self::$instance === null) {
            self::$instance = new StateRepository();
        }
        return self::$instance;
    }
}