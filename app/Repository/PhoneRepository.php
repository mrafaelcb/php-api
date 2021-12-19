<?php


namespace App\Repository;

use App\Models\Phone;
use Exception;
use PDO;

/**
 * Class PhoneRepository
 * @package App\Repository
 */
class PhoneRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por salvar telefone
     *
     * @param Phone $phone
     * @return bool
     * @throws Exception
     */
    public function save(Phone $phone): bool
    {
        try {
            $query = "INSERT INTO telefone (ddd, numero, fk_usuario) VALUES (?,?,?)";

            $stmt = $this->connection->prepare($query);

            return $stmt->execute([
                $phone->getDdd(),
                $phone->getNumero(),
                $phone->getFkUsuario(),
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por retornar usuário por id
     *
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function getByUserId(string $id)
    {
        try {
            $query = "SELECT * FROM telefone WHERE fk_usuario = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    /**
     * Responsável pelo Singleton
     *
     * @return PhoneRepository
     */
    public static function getInstance(): PhoneRepository
    {
        if (self::$instance === null) {
            self::$instance = new PhoneRepository();
        }
        return self::$instance;
    }
}