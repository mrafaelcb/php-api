<?php


namespace App\Business;

use App\Config\Constants;
use App\Exceptions\CustomException;
use App\Models\User;
use App\Repository\UserRepository;
use App\Util\Utils;
use Exception;
use Firebase\JWT\JWT;

/**
 * Class UserBO
 * @package App\Business
 */
class AuthBO extends AbstractBO
{
    public static $instance;
    private UserRepository $userRepository;

    /**
     * UserBO constructor.
     */
    public function __construct()
    {
        $this->userRepository = UserRepository::getInstance();
    }

    /**
     * Responsável por criar o token JWT
     *
     * @param string $cpf
     * @param string $password
     * @return array
     * @throws Exception
     */
    public function createToken(string $cpf, string $password): array
    {
        try {
            $user = $this->validPassword($cpf, $password);

            $time = time();

            $payload = array(
                "cpf" => $user->getCpf(),
                "iat" => $time,
            );

            return ["token" => Utils::encodeJwt($payload)];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Responsável por válidar usuário no banco
     *
     * @param $cpf
     * @param $password
     * @return User
     * @throws Exception
     */
    private function validPassword($cpf, $password): User
    {
        $user = $this->userRepository->getByCpf($cpf);

        if (!password_verify($password, $user->getPassword())) {
            throw new CustomException(Constants::MSG_PASSWORD_INVALID, Constants::HTTP_NOT_FOUND);
        }

        return $user;
    }

    /**
     * Responsável pelo Singleton
     *
     * @return AuthBO
     */
    public static function getInstance(): AuthBO
    {
        if (self::$instance === null) {
            self::$instance = new AuthBO();
        }
        return self::$instance;
    }
}