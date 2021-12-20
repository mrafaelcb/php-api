<?php

namespace App\Util;

use App\Config\Constants;
use App\Exceptions\CustomException;
use Exception;

/**
 * Class Response
 *
 * @package App\Util
 */
class Response
{
    const HTTP_CODES = [
        Constants::HTTP_OK,
        Constants::HTTP_CREATED,
        Constants::HTTP_BAD_REQUEST,
        Constants::HTTP_NOT_FOUND,
        Constants::HTTP_UNAUTHORIZED,
        Constants::HTTP_INTERNAL_ERROR,
    ];

    /**
     * Responsável por retornar mensagem em caso de sucesso.
     *
     * @param null $data
     * @param int $code
     * @return bool|string
     */
    public static function success($data = null, int $code = Constants::HTTP_OK): bool|string
    {
        return Utils::formatResponse($data,Constants::MSG_OK, $code);
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
     * @param Exception|CustomException $error
     * @return string
     */
    public static function error(Exception|CustomException $error): string
    {
        if (array_key_exists($error->getCode(), self::HTTP_CODES)) {
            $code = self::HTTP_CODES[$error->getCode()];
        } else {
            $code = Constants::HTTP_INTERNAL_ERROR;
        }

        return Utils::formatResponse(Utils::getDecodedMessageException($error), $error->getMessage(), $code);
    }
}
