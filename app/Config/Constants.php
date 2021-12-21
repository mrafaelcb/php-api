<?php

namespace App\Config;

/**
 * Class Constants
 *
 * @package App\Config
 */
class Constants
{
    /**
     * HTTP CÓDIGOS
     */
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNAUTHORIZED = 404;
    const HTTP_INTERNAL_ERROR = 500;

    /**
     * STATUS
     */
    const SUCCESS = true;
    const ERROR = false;

    /**
     * MENSAGENS PADRÃO
     */
    const MSG_OK = 'Sucesso.';
    const MSG_NOT_FOUND = 'Página não encontrada.';
    const MSG_ERROR_REQUEST = 'Operação não concluida.';
    const MSG_DATA_NOT_FOUND = 'Registro não encontrado.';
    const MSG_PASSWORD_INVALID = 'Senha inválida.';


    /**
     * VALIDAÇÕES
     */
    const REQUIRED = 'required';
    const MIN = 'min';
    const MAX = 'max';
    const DATETIME = 'datetime';
    const LENGTH = 'length';
    const PHONE = 'phone';
    const ADDRESS = 'address';
    const UNIQUE_CPF = 'uniqueCpf';

    /**
     * MÉTODOS HTTP
     */
    const POST = 'POST';
    const GET = 'GET';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /**
     *  UTILS
     */
    const DATA_FORMAT = 'Y-m-d H:i:s';
    const JWT_TYPE = 'HS256';
}