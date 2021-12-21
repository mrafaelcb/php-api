<?php


namespace App\Business;


use App\Repository\StateRepository;
use Exception;

/**
 * Class StateBO
 * @package App\Business
 */
class StateBO extends AbstractBO
{
    private StateRepository $stateRepository;

    public static $instance;

    /**
     * StateBO constructor.
     */
    public function __construct()
    {
        $this->stateRepository = StateRepository::getInstance();
    }

    /**
     * Responsável por retornar de acordo com fk país
     *
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getByFkPais($id): array
    {
        return $this->stateRepository->getByFkPais($id);
    }

    /**
     * Responsável pelo Singleton
     *
     * @return StateBO
     */
    public static function getInstance(): StateBO
    {
        if (self::$instance === null) {
            self::$instance = new StateBO();
        }
        return self::$instance;
    }
}