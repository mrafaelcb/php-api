<?php


namespace App\Business;


use App\Repository\NationRepository;
use Exception;

/**
 * Class NationBO
 * @package App\Business
 */
class NationBO extends AbstractBO
{
    private NationRepository $nationRepository;

    public static $instance;

    /**
     * NationBO constructor.
     */
    public function __construct()
    {
        $this->nationRepository = NationRepository::getInstance();
    }

    /**
     * Responsável por retornar todos os paises
     *
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        return $this->nationRepository->all();
    }

    /**
     * Responsável pelo Singleton
     *
     * @return NationBO
     */
    public static function getInstance(): NationBO
    {
        if (self::$instance === null) {
            self::$instance = new NationBO();
        }
        return self::$instance;
    }
}