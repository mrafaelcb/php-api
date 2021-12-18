<?php

namespace App\Util;

use App\Config\Constants;

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
        return Utils::formatResponse(Utils::getMessageResponse(Constants::PAGE_OK, $data), Constants::HTTP_OK);
    }

    /**
     * Responsável por retornar mensagem em caso de página não encontrada.
     *
     * @return bool|string
     */
    public static function notFound(): bool|string
    {
        return Utils::formatResponse(Utils::getMessageResponse(Constants::PAGE_NOT_FOUND), Constants::HTTP_NOT_FOUND);
    }

    /**
     * Responsável por retornar mensagem em caso de erro.
     *
     * @return string
     */
    public static function error(): string
    {
        return Utils::formatResponse(Utils::getMessageResponse(Constants::PAGE_INTERNAL_ERROR), Constants::HTTP_INTERNAL_ERROR);
    }
}
