<?php

namespace App;

use App\Http\Controllers\UserController;
use App\Routes\Routes;

/**
 * Class Application
 * @package App
 */
class Application
{

    /**
     * Responsável por carregar dependências iniciais
     *
     * @return $this
     */
    public function init(): static
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Origin: GET,POST,PUT,DELETE");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow: Content-Type, Access-Control-Allow-Headers, Authorization X-Requested, X-Request-Width");
        return $this;
    }

    /**
     * @return bool|string
     */
    public function run()
    {
        /**
         * TODO Funções de rota
         */
        return Routes::run();
    }
}