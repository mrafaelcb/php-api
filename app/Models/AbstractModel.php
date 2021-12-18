<?php


namespace App\Models;


use App\Config\Constants;
use App\Util\Utils;
use ReflectionClass;

class AbstractModel
{
    public function toJson()
    {
        $json = array();
        $class = new ReflectionClass($this);

        foreach ($class->getProperties() as $key => $value) {
            $value->setAccessible(true);
            if ($value->getValue($this) instanceof \DateTime) {
                $json[Utils::camelCaseToSnackCase($value->getName())] = ($value->getValue($this))->format(Constants::DATA_FORMAT);
            } else {
                $json[Utils::camelCaseToSnackCase($value->getName())] = $value->getValue($this);
            }
        }

        return $json;
    }
}