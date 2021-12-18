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

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->body = file_get_contents('php://input');
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
}
