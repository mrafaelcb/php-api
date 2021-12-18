<?php


namespace App\Business;


use App\Models\User;

class UserBO extends AbstractBO
{
    public static $instance;

    /**
     * Responsável por salvar usuário no banco
     *
     * @param User $user
     * @return array
     */
    public function save(User $user)
    {
        return $user->toJson();
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