<?php


namespace App\Repository;


use App\Config\Constants;
use App\Models\User;
use Exception;
use PDO;

class UserRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por salvar usuário
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function save(User $user): User
    {
        try {
            $this->connection->beginTransaction();

            $query = "INSERT INTO usuario (nome, data_nascimento, cpf, rg) VALUES (?,?,?,?)";

            $stmt = $this->connection->prepare($query);

            $stmt->execute([
                $user->getNome(),
                $user->getDataNascimento()->format(Constants::DATA_FORMAT),
                $user->getCpf(),
                $user->getRg()
            ]);

            $this->connection->commit();

            return new User($this->getByCpf($user->getCpf()));
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    /**
     * Responsável por retornar usuário por cpf
     *
     * @param string $cpf
     * @return mixed
     * @throws Exception
     */
    public function getByCpf(string $cpf)
    {
        try {
            $query = "SELECT * FROM usuario WHERE cpf = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$cpf]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
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
     * @return UserRepository
     */
    public static function getInstance(): UserRepository
    {
        if (self::$instance === null) {
            self::$instance = new UserRepository();
        }
        return self::$instance;
    }
}