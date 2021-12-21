<?php

namespace App;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Routes\Routes;
use App\Util\Request;
use App\Util\Response;
use App\Util\Utils;
use Exception;

/**
 * Class Application
 * @package App
 */
class Application
{
    private UserController $userController;
    private AuthController $authController;
    private Request $request;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->userController = new UserController();
        $this->authController = new AuthController();
        $this->request = new Request();
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
        $this->auth();

        $this->user();

        return Routes::run();
    }

    /**
     * Responsável por listar rotas de usuários
     */
    public function user()
    {
        $userController = $this->userController;
        $request = $this->request;

        Routes::get('/user', function () use ($userController, $request) {
            try {
                return $userController->get(Utils::validToken($request->getToken()));
            } catch (Exception $e) {
                return Response::error($e);
            }
        });

        Routes::delete('/user', function () use ($userController, $request) {
            try {
                Utils::validToken($request->getToken());

                return $userController->delete($request->getBody());
            } catch (Exception $e) {
                return Response::error($e);
            }
        });

        Routes::put('/user', function () use ($userController, $request) {
            try {
                Utils::validToken($request->getToken());

                return $userController->edit($request->getBody());
            } catch (Exception $e) {
                return Response::error($e);
            }
        });

        Routes::post('/user', function () use ($userController, $request) {
            return $userController->save($request->getBody());
        });

        Routes::get('/users', function () use ($userController, $request) {
            try {
                Utils::validToken($request->getToken());

                return $userController->all($request->getBody());
            } catch (Exception $e) {
                return Response::error($e);
            }
        });
    }

    /**
     * Responsável por listar rotas de autenticação
     */
    public function auth()
    {
        $request = $this->request;
        $authController = $this->authController;

        Routes::post('/login', function () use ($authController, $request) {
            return $authController->login($request);
        });
    }
}