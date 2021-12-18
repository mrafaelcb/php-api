<?php

namespace App\Exceptions;


use App\Config\Constants;
use Closure;
use Exception;

class Validator
{
    /**
     * Responsável por válidar as regras
     *
     * @param $request
     * @param $rules
     * @return array
     */
    public static function valid($request, $rules)
    {
        $errors = [];
        foreach ($rules as $key => $value) {
            $matchs = explode('|', $value);
            if (count($matchs) > 0 && current($matchs) != "") {
                foreach ($matchs as $match) {
                    if (strpos($value, Constants::REQUIRED)) {
                        if (array_key_exists($key, $request)) {
                            if (self::matchs($match, $request[$key])) {
                                $errors[$key][$match] = $key;
                            }
                        } else {
                            $errors[$key][$match] = $key;
                        }
                    } else {
                        if (array_key_exists($key, $request)) {
                            if (self::matchs($match, $request[$key])) {
                                $errors[$key][$match] = $key;
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
    public static function matchs($match, $value)
    {
        $matchs = array_merge(
            self::required(),
            self::dateTime(),
            self::max(),
            self::min(),
            self::length(),
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
                return true;
            }
            return false;
        }];
    }
}