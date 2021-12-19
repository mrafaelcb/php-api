<?php


namespace App\Business;


use App\Models\User;
use App\Repository\UserRepository;
use Exception;

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