<?php

namespace App\Repository;

use App\Config\Constants;
use App\Models\Address;
use App\Models\Phone;
use Exception;
use PDO;

/**
 * Class AddressRepository
 * @package App\Repository
 */
class AddressRepository
{
    private Connection $connection;
    public static $instance;

    /**
     * Responsável por salvar endereço
     *
     * @param Address $address
     * @return bool
     * @throws Exception
     */
    public function save(Address $address): bool
    {
        try {
            $query = "INSERT INTO endereco 
                (logradouro, complemento, numero, cep, fk_cidade, fk_usuario) 
                VALUES (?,?,?,?,?,?)";

            $stmt = $this->connection->prepare($query);

            return $stmt->execute([
                $address->getLogradouro(),
                $address->getComplemento(),
                $address->getNumero(),
                $address->getCep(),
                $address->getFkCidade(),
                $address->getFkUsuario(),
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por editar endereço
     *
     * @param Address $address
     * @return bool
     * @throws Exception
     */
    public function edit(Address $address): bool
    {
        try {
            $query = "UPDATE endereco SET 
                    logradouro = :logradouro, 
                    complemento = :complemento, 
                    numero = :numero, 
                    cep = :cep, 
                    data_alteracao = :data_alteracao, 
                    fk_cidade = :fk_cidade, 
                    fk_usuario = :fk_usuario WHERE id = :id";

            $stmt = $this->connection->prepare($query);

            return $stmt->execute([
                'logradouro' => $address->getLogradouro(),
                'complemento' => $address->getComplemento(),
                'numero' => $address->getNumero(),
                'cep' => $address->getCep(),
                'data_alteracao' => date(Constants::DATA_FORMAT),
                'fk_cidade' => $address->getFkCidade(),
                'fk_usuario' => $address->getFkUsuario(),
                'id' => $address->getId(),
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
            $query = "SELECT * FROM endereco WHERE fk_usuario = ?";

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
     * @return AddressRepository
     */
    public static function getInstance(): AddressRepository
    {
        if (self::$instance === null) {
            self::$instance = new AddressRepository();
        }
        return self::$instance;
    }
}