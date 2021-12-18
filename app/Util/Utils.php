<?php

namespace App\Util;

use App\Config\Constants;

/**
 * Class Utils
 *
 * @package App\Util
 */
class Utils
{
    /**
     * Responsável por retornar response no padrão
     *
     * @param $dados
     * @param null $code
     * @return string
     */
    public static function formatResponse($dados, $code = null): string
    {
        $array_json = ['result' => Constants::SUCCESS, 'data' => ''];

        $dados = json_decode($dados);

        if ($code != Constants::HTTP_OK && $code != Constants::HTTP_CREATED) {
            $array_json['result'] = Constants::ERROR;
        }

        http_response_code($code);

        $array_json['data'] = $dados;

        return json_encode($array_json);
    }

    /**
     * Responsável por inserir a mensagem para retornar no padrão do response
     *
     * @param $message
     * @param null $data
     * @return false|string
     */
    public static function getMessageResponse($message, $data = null): false|string
    {
        if ($data) {
            $data->message = $message;
            return json_encode($data);
        }
        return json_encode(array_merge(["message" => $message], $data));
    }
}