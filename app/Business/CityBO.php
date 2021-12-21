<?php


namespace App\Business;


use App\Repository\CityRepository;
use Exception;

/**
 * Class CityBO
 * @package App\Business
 */
class CityBO extends AbstractBO
{
    private CityRepository $cityRepository;

    public static $instance;

    /**
     * CityBO constructor.
     */
    public function __construct()
    {
        $this->cityRepository = CityRepository::getInstance();
    }

    /**
     * Responsável por retornar de acordo com fk_estado
     *
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getByFkEstado($id): array
    {
        return $this->cityRepository->getByFkEstado($id);
    }

    /**
     * Responsável pelo Singleton
     *
     * @return CityBO
     */
    public static function getInstance(): CityBO
    {
        if (self::$instance === null) {
            self::$instance = new CityBO();
        }
        return self::$instance;
    }
}