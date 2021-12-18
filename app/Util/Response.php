<?php

namespace App\Util;

use App\Config\Constants;
use Exception;

/**
 * Class Response
 *
 * @package App\Util
 */
class Response
{
    /**
     * Responsável por retornar mensagem em caso de sucesso.
     *
     * @param null $data
     * @return bool|string
     */
    public static function success($data = null): bool|string
    {
        return Utils::formatResponse($data);
    }

    /**
     * Responsável por retornar mensagem em caso de página não encontrada.
     *
     * @return bool|string
     */
    public static function notFound(): bool|string
    {
        return Utils::formatResponse([], Constants::MSG_NOT_FOUND, Constants::HTTP_NOT_FOUND);
    }

    /**
     * Responsável por retornar mensagem em caso de erro.
     *
     * @param Exception $error
     * @return string
     */
    public static function error(Exception $error): string
    {
        return Utils::formatResponse(Utils::getDecodedMessageException($error), $error->getMessage(), $error->getCode());
    }
}
