<?php


namespace App\Business;


use App\Models\User;
use App\Repository\UserRepository;
use Exception;

/**
 * Class UserBO
 * @package App\Business
 */
class UserBO extends AbstractBO
{
    private UserRepository $userRepository;

    public static $instance;

    /**
     * UserBO constructor.
     */
    public function __construct()
    {
        $this->userRepository = UserRepository::getInstance();
    }


    /**
     * Responsável por salvar usuário no banco
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function save(User $user): User
    {
        return $this->userRepository->save($user);
    }

    /**
     * Responsável por editar usuário no banco
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function edit(User $user): User
    {
        return $this->userRepository->edit($user);
    }

    /**
     * Responsável por salvar usuário no banco
     *
     * @param $id
     * @return User
     * @throws Exception
     */
    public function getById($id): User
    {
        return $this->userRepository->getById($id);
    }

    /**
     * Responsável por listar todos usuários
     *
     * @param $page
     * @param $perPage
     * @return array
     * @throws Exception
     */
    public function all($page, $perPage): array
    {
        return $this->userRepository->all($page, $perPage);
    }

    /**
     * Responsável por deletar usuário no banco
     *
     * @param $id
     * @return array
     * @throws Exception
     */
    public function deleteById($id): array
    {
        return $this->userRepository->deleteById($id);
    }

    /**
     * Responsável por verificar se existe na base
     *
     * @param $cpf
     * @return int
     * @throws Exception
     */
    public function uniqueCpf($cpf): int
    {
        return $this->userRepository->uniqueCpf($cpf);
    }

    /**
     * Responsável pelo Singleton
     *
     * @return UserBO
     */
    public static function getInstance(): UserBO
    {
        if (self::$instance === null) {
            self::$instance = new UserBO();
        }
        return self::$instance;
    }
}