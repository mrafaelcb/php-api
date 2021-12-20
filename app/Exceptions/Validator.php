<?php

namespace App\Exceptions;


use App\Business\UserBO;
use App\Config\Constants;
use App\Util\Utils;
use Closure;
use Exception;

/**
 * Class Validator
 * @package App\Exceptions
 */
class Validator
{
    /**
     * Responsável por válidar as regras
     *
     * @param $request
     * @param $rules
     * @return array
     */
    public static function valid($request, $rules): array
    {
        $errors = [];
        foreach ($rules as $key => $value) {
            $matchs = explode('|', $value);
            if (count($matchs) > 0 && current($matchs) != "") {
                foreach ($matchs as $match) {
                    $error = explode(':', $match);
                    if (in_array(Constants::REQUIRED, $matchs)) {
                        if (array_key_exists($key, $request)) {
                            if (self::matchs($match, $request[$key])) {
                                $errors[$key][current($error)] = end($error);
                            }
                        } else {
                            $errors[$key][current($error)] = end($error);
                        }
                    } else {
                        if (array_key_exists($key, $request)) {
                            if (self::matchs($match, $request[$key])) {
                                $errors[$key][current($error)] = end($error);
                            }
                        }
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * Responsável por chamar as funções de validação
     *
     * @param $match
     * @param $value
     * @return mixed
     */
    public static function matchs($match, $value): mixed
    {
        $matchs = array_merge(
            self::required(),
            self::dateTime(),
            self::max(),
            self::min(),
            self::length(),
            self::phone(),
            self::address(),
            self::uniqueCpf(),
        );

        $match = explode(':', $match);
        return $matchs[current($match)]($value, end($match));
    }

    /**
     * Responsável por validar se campo é requirido
     *
     * @return Closure[]
     */
    public static function required()
    {
        return [Constants::REQUIRED => function ($value, $match = null) {
            if (is_null($value)) {
                return true;
            }

            return false;
        }];
    }

    /**
     * Responsável por validar datatime
     *
     * @return Closure[]
     */
    public static function dateTime()
    {
        return [Constants::DATETIME => function ($value, $match = null) {
            try {
                if (!is_null($value)) {
                    return !date_create_from_format(Constants::DATA_FORMAT, $value);
                }
                return false;
            } catch (Exception $e) {
                return true;
            }
        }];
    }

    /**
     * Responsável por validar maximo da string
     *
     * @return Closure[]
     */
    public static function max()
    {
        return [Constants::MAX => function ($value, $match = null) {
            if (strlen($value) > $match) {
                return true;
            }
            return false;
        }];
    }

    /**
     * Responsável por validar minimo da string
     *
     * @return Closure[]
     */
    public static function min()
    {
        return [Constants::MIN => function ($value, $match = null) {
            if (strlen($value) < $match) {
                return true;
            }
            return false;
        }];
    }

    /**
     * Responsável por validar tamanho da string
     *
     * @return Closure[]
     */
    public static function length()
    {
        return [Constants::LENGTH => function ($value, $match = null) {
            if (strlen($value) == $match) {
                return false;
            }
            return true;
        }];
    }

    /**
     * Responsável por validar cpf unico
     *
     * @return Closure[]
     */
    public static function uniqueCpf()
    {
        return [Constants::UNIQUE_CPF => function ($value, $match = null) {
            if (UserBO::getInstance()->uniqueCpf($value) > intval($match)) {
                return true;
            }

            return false;
        }];
    }

    /**
     * Responsável por validar telefone
     *
     * @return Closure[]
     */
    public static function phone()
    {
        return [Constants::PHONE => function ($value, $match = null) {
            foreach ($value as $phone) {
                try {
                    $rules = [
                        'ddd' => 'required|length:2',
                        'numero' => 'required|length:9',
                        'data_criacao' => 'datetime',
                        'data_alteracao' => 'datetime',
                    ];

                    Utils::validatorRules((array)$phone, $rules);
                } catch (Exception $e) {
                    throw $e;
                }
            }
        }];
    }

    /**
     * Responsável por validar endereço
     *
     * @return Closure[]
     */
    public static function address()
    {
        return [Constants::ADDRESS => function ($value, $match = null) {
            if (count($value) > 0) {
                foreach ($value as $address) {
                    try {
                        $rules = [
                            'logradouro' => 'required|max:80',
                            'complemento' => 'max:80',
                            'numero' => 'max:80',
                            'cep' => 'length:8',
                            'data_criacao' => 'datetime',
                            'data_alteracao' => 'datetime',
                            'fk_cidade' => '',
                        ];

                        Utils::validatorRules((array)$address, $rules);
                    } catch (Exception $e) {
                        throw $e;
                    }
                }
            } else {
                throw new CustomException(Constants::MSG_FALHA_REQUISICAO, Constants::HTTP_BAD_REQUEST, ["requiredOne" => true]);
            }
        }];
    }
}