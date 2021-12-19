<?php


namespace App\Repository;


use App\Config\Constants;
use App\Models\Phone;
use App\Models\User;
use Exception;
use PDO;

class UserRepository
{
    private Connection $connection;
    private PhoneRepository $phoneRepository;
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
            $user->setId($this->connection->lastInsertId());

            foreach ($user->getTelefones() as $phone) {
                $phone = new Phone($phone);
                $phone->setFkUsuario($user->getId());
                $this->phoneRepository->save($phone);
            }

            $this->connection->commit();

            return $this->getByCpf($user->getCpf());
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    /**
     * Responsável por retornar usuário por cpf
     *
     * @param string $cpf
     * @return User
     * @throws Exception
     */
    public function getByCpf(string $cpf)
    {
        try {
            $query = "SELECT * FROM usuario WHERE cpf = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$cpf]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $this->returnUser($user);
            }

            throw new Exception(Constants::MSG_REGISTRO_NAO_ENCONTRADO, Constants::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por retornar usuário por id
     *
     * @param string $id
     * @return User
     * @throws Exception
     */
    public function getById(string $id)
    {
        try {
            $query = "SELECT * FROM usuario WHERE id = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$id]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $this->returnUser($user);
            }

            throw new Exception(Constants::MSG_REGISTRO_NAO_ENCONTRADO, Constants::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por deletar usuário por id
     *
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function deleteById(string $id): array
    {
        try {
            $query = "DELETE FROM usuario WHERE id = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$id]);

            return ["rows_affected" => $stmt->rowCount()];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por retornar usuário
     *
     * @param $user
     * @return User
     * @throws Exception
     */
    public function returnUser($user): User
    {
        $user = new User($user);
        $user->setTelefones($this->phoneRepository->getByUserId($user->getId()));
        return $user;
    }

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
        $this->phoneRepository = PhoneRepository::getInstance();
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