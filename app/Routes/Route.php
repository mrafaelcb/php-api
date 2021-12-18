<?php

namespace App\Routes;

/**
 * Class Route
 *
 * @package App\Routes
 */
class Route
{
    private string $route;
    private object $function;
    private string $method;

    /**
     * Route constructor.
     *
     * @param $route
     * @param $function
     * @param $method
     */
    public function __construct($route, $function, $method)
    {
        $this->route = $route;
        $this->function = $function;
        $this->method = $method;
    }

    /**
     * Responsável por retornar a rota
     *
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Responsável por retornar a função da rota
     *
     * @return object
     */
    public function getFunction(): object
    {
        return $this->function;
    }

    /**
     * Responsável por retornar o tipo de método utilizado pela rota
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
