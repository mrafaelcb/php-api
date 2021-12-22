<?php

namespace App\Util;

use App\Config\Constants;
use App\Exceptions\CustomException;
use App\Exceptions\Validator;
use App\Models\User;
use App\Repository\UserRepository;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

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
     * @param mixed $dados
     * @param string $message
     * @param int $code
     * @return string
     */
    public static function formatResponse(mixed $dados = null, string $message = Constants::MSG_OK, int $code = Constants::HTTP_OK): string
    {
        $array_json = ['result' => Constants::SUCCESS, 'message' => $message, 'data' => ''];

        $dados = json_decode(json_encode($dados));

        if ($code != Constants::HTTP_OK && $code != Constants::HTTP_CREATED) {
            $array_json['result'] = Constants::ERROR;
        }

        http_response_code($code);

        $array_json['data'] = $dados;

        return json_encode($array_json);
    }

    /**
     * Responsável por retornar mensagem de exceção
     *
     * @param Exception|CustomException $e
     * @return mixed
     */
    public static function getDecodedMessageException(Exception|CustomException $e): mixed
    {
        return [
            "file" => basename($e->getFile()),
            "code" => $e->getCode(),
            "line" => $e->getLine(),
            "description" => $e instanceof CustomException ? json_decode(json_encode($e->getDescription())) : $e->getTraceAsString(),
        ];
    }

    /**
     * Responsável de retornar valores do Request
     *
     * @param $index
     * @param $array
     * @return mixed
     */
    public static function getValue($index, $array): mixed
    {
        if ($array instanceof Stdclass) {
            return property_exists($array, $index) && isset($array->$index) ? $array->$index : null;
        }

        if (array_key_exists($index, $array)) {
            return $array[$index];
        }
        return null;
    }

    /**
     * Responsável por recuperar data do request
     *
     * @param $index
     * @param $array
     * @return DateTime|mixed
     *
     * @throws Exception
     */
    public static function getValueDate($index, $array): ?DateTime
    {
        if ($array instanceof Stdclass) {
            if (property_exists($array, $index) && isset($array->$index)) {
                try {
                    return new DateTime($array->$index);
                } catch (Exception $e) {
                    throw new CustomException(Constants::MSG_ERROR_REQUEST, Constants::HTTP_BAD_REQUEST);
                }
            }

            return null;
        }

        if (array_key_exists($index, $array)) {
            try {
                return new DateTime($array[$index]);
            } catch (Exception $e) {
                throw new CustomException(Constants::MSG_ERROR_REQUEST, Constants::HTTP_BAD_REQUEST);
            }
        }
        return null;
    }

    /**
     * Responsável por retornar apenas campos não nulos
     *
     * @param $request
     * @param $fields
     * @param string[] $fieldIgnore
     * @return array
     */
    public static function getValuesNotNull($request, $fields, array $fieldIgnore = ["id"])
    {
        $requestFields = [];

        foreach ($fields as $field) {
            if (in_array($field, $fieldIgnore)) {
                continue;
            }
            $value = Utils::getValue($field, $request);
            if (!is_null($value)) {
                $requestFields[$field] = $value;
            }
        }

        return $requestFields;
    }

    /**
     * Responsável por validar as regras
     *
     * @param $request
     * @param $rules
     * @throws Exception
     */
    public static function validatorRules($request, $rules)
    {
        $validacao = Validator::valid($request, $rules);

        if (count($validacao) > 0) {
            throw new CustomException(Constants::MSG_ERROR_REQUEST, Constants::HTTP_BAD_REQUEST, $validacao);
        }
    }

    /**
     * Responsável por transformar camelCase em SnackCase
     *
     * @param $data
     * @return string
     */
    public static function camelCaseToSnackCase($data)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $data)), '_');
    }

    /**
     * Responsável por retornar token
     *
     * @param $payload
     * @return string
     */
    public static function encodeJwt($payload): string
    {
        return JWT::encode($payload, $_ENV['JWT_SECURITY_KEY'], Constants::JWT_TYPE);
    }

    /**
     * Responsável por retornar token decodificado
     *
     * @param $jwt
     * @return mixed
     */
    public static function decodeJwt($jwt): mixed
    {
        return JWT::decode($jwt, new Key($_ENV['JWT_SECURITY_KEY'], Constants::JWT_TYPE));
    }

    /**
     * Responsável por retornar usuário do token
     *
     * @param string $token
     * @return User
     * @throws CustomException
     */
    public static function validToken(mixed $token): User
    {
        if (is_null($token)) {
            throw new CustomException(Constants::MSG_TOKEN_INVALID, Constants::HTTP_UNAUTHORIZED);
        }

        $data = Utils::decodeJwt($token);

        if (is_null($data) || !isset($data->cpf)) {
            throw new CustomException(Constants::MSG_TOKEN_INVALID, Constants::HTTP_UNAUTHORIZED);
        }

        return UserRepository::getInstance()->getByCpf($data->cpf);
    }
}