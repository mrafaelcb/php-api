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
    private UserController $userController;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->userController = new UserController();
    }


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


    public function run()
    {
        $this->user();

        return Routes::run();
    }

    /**
     * Responsável por listar rotas de usuários
     */
    public function user()
    {
        $userController = $this->userController;

        Routes::get('/user', function () use ($userController) {
            return $userController->get();
        });

        Routes::delete('/user', function () use ($userController) {
            return $userController->delete();
        });

        Routes::put('/user', function () use ($userController) {
            return $userController->edit();
        });

        Routes::post('/user', function () use ($userController) {
            return $userController->save();
        });
    }
}