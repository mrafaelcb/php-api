<?php


namespace App\Repository;

use Exception;
use PDO;

/**
 * Class CityRepository
 * @package App\Repository
 */
class CityRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por retornar cidades por id do estado
     *
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function getByFkEstado(string $id)
    {
        try {
            $query = "SELECT * FROM cidade WHERE fk_estado = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * CityRepository constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    /**
     * Responsável pelo Singleton
     *
     * @return CityRepository
     */
    public static function getInstance(): CityRepository
    {
        if (self::$instance === null) {
            self::$instance = new CityRepository();
        }
        return self::$instance;
    }
}