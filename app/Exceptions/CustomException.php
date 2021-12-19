<?php


namespace App\Exceptions;


use Exception;
use Throwable;

/**
 * Class CustomException
 * @package App\Exceptions
 */
class CustomException extends Exception
{
    protected array $description;

    public function __construct($message = "", $code = 0, $description = [], Throwable $previous = null)
    {
        $this->description = $description;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getDescription(): mixed
    {
        return $this->description;
    }
}