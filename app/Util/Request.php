<?php

namespace App\Util;

/**
 * Class Request
 *
 * @package App\Util
 */
class Request
{
    private string|false $body;
    private mixed $token;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->body = file_get_contents('php://input');
        $this->token = $this->getBearerToken();

    }

    /**
     * Responsável por obter token
     *
     * @return string|null
     */
    private function getAuthorizationHeader(): string|null
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));

            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * Responsável por retornar token
     *
     * @return mixed
     */
    private function getBearerToken(): mixed
    {
        $headers = $this->getAuthorizationHeader();

        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Responsável por retornar os dados do body da request
     *
     * @return mixed
     */
    public function getBody(): mixed
    {
        return json_decode($this->body);
    }

    /**
     * @return mixed
     */
    public function getToken(): mixed
    {
        return $this->token;
    }
}
