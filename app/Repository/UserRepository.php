<?php


namespace App\Repository;


use App\Config\Constants;
use App\Exceptions\CustomException;
use App\Models\Address;
use App\Models\Phone;
use App\Models\User;
use Exception;
use PDO;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository
{
    private Connection $connection;
    private PhoneRepository $phoneRepository;
    private AddressRepository $addressRepository;
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

            $query = "INSERT INTO usuario (nome, data_nascimento, cpf, rg, password) VALUES (?,?,?,?,?)";

            $stmt = $this->connection->prepare($query);

            $stmt->execute([
                $user->getNome(),
                $user->getDataNascimento()->format(Constants::DATA_FORMAT),
                $user->getCpf(),
                $user->getRg(),
                password_hash($user->getPassword(), PASSWORD_DEFAULT),
            ]);

            $user->setId($this->connection->lastInsertId());

            $this->savePhone($user);
            $this->saveAddress($user);

            $this->connection->commit();

            return $this->getByCpf($user->getCpf());
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    /**
     * Responsável por salvar usuário
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function edit(User $user): User
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE usuario SET nome = :nome, data_nascimento = :data_nascimento, rg = :rg, data_alteracao = :data_alteracao, password = :password WHERE id = :id";

            $stmt = $this->connection->prepare($query);

            $stmt->execute([
                'nome' => $user->getNome(),
                'data_nascimento' => $user->getDataNascimento()->format(Constants::DATA_FORMAT),
                'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                'rg' => $user->getRg(),
                'id' => $user->getId(),
                'data_alteracao' => date(Constants::DATA_FORMAT),
            ]);

            $this->savePhone($user, true);
            $this->saveAddress($user, true);


            $this->connection->commit();

            return $this->getById($user->getId());
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    /**
     * Responsável por salvar ou editar endereço
     *
     * @param $user
     * @param $isEdit
     * @throws Exception
     */
    public function saveAddress($user, $isEdit = false)
    {
        foreach ($user->getEnderecos() as $address) {
            $address = new Address($address);

            if ($isEdit && $address->getId()) {
                $this->addressRepository->edit($address);
            } else {
                $address->setFkUsuario($user->getId());
                $this->addressRepository->save($address);
            }
        }
    }

    /**
     * Responsável por salvar ou editar telefone
     *
     * @param $user
     * @param $isEdit
     * @throws Exception
     */
    public function savePhone($user, $isEdit = false)
    {
        foreach ($user->getTelefones() as $phone) {
            $phone = new Phone($phone);

            if ($isEdit && $phone->getId()) {
                $this->phoneRepository->edit($phone);
            } else {
                $phone->setFkUsuario($user->getId());
                $this->phoneRepository->save($phone);
            }
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

            throw new CustomException(Constants::MSG_DATA_NOT_FOUND, Constants::HTTP_NOT_FOUND);
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

            throw new CustomException(Constants::MSG_DATA_NOT_FOUND, Constants::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por verificar existência de um cpf
     *
     * @param string $cpf
     * @return int
     * @throws Exception
     */
    public function uniqueCpf(string $cpf): int
    {
        try {
            $query = "SELECT COUNT(*) FROM usuario WHERE cpf = ?";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute([$cpf]);

            return $stmt->fetchColumn();
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
        $user->setEnderecos($this->addressRepository->getByUserId($user->getId()));

        return $user;
    }

    /**
     * Responsável por listar todos usuários
     *
     * @param int $page
     * @param int $perPage
     * @return array
     * @throws Exception
     */
    public function all(int $page, int $perPage): array
    {
        try {
            $query = "SELECT * FROM usuario ORDER BY data_criacao DESC LIMIT :page,:perPage";

            $stmt = Connection::getInstance()->prepare($query);

            $currentPage = ($page - 1) * $perPage;

            $stmt->bindParam('page', $currentPage, PDO::PARAM_INT);
            $stmt->bindParam('perPage', $perPage, PDO::PARAM_INT);

            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list = [];
            foreach ($users as $user) {
                array_push($list, $this->returnUser($user)->toJson());
            }

            return [$list,$this->countAllUser()];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function countAllUser()
    {
        try {
            $query = "SELECT COUNT(*) FROM usuario";

            $stmt = Connection::getInstance()->prepare($query);

            $stmt->execute();

            return $stmt->fetchColumn();
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
        $this->phoneRepository = PhoneRepository::getInstance();
        $this->addressRepository = AddressRepository::getInstance();
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