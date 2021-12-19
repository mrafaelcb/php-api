<?php

namespace App\Http\Controllers;

use App\Business\UserBO;
use App\Config\Constants;
use App\Http\Controllers\Interfaces\ICrud;
use App\Models\User;
use App\Util\Request;
use App\Util\Response;
use App\Util\Utils;
use Exception;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller implements ICrud
{

    private UserBO $userBO;
    private Request $request;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userBO = UserBO::getInstance();
        $this->request = new Request();
    }


    /**
     * Responsável por retornar usuário por id
     *
     * @return User|string
     */
    public function get(): User|string
    {
        $request = $this->request->getBody();
        try {
            $rules = [
                'id' => 'required',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);

            return Response::success($this->userBO->getById(Utils::getValue('id', $request))->toJson());
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por deletar usuário
     *
     * @return mixed
     */
    public function delete(): mixed
    {
        // TODO: Implement delete() method.
    }

    /**
     * Responsável por editar usuário
     *
     * @return User
     */
    public function edit(): User
    {
        // TODO: Implement edit() method.
    }

    /**
     * Responsável por salvar usuário
     *
     * @return bool|string
     */
    public function save(): bool|string
    {
        $request = $this->request->getBody();

        try {
            $rules = [
                'nome' => 'required|max:60|min:10',
                'data_nascimento' => 'required|datetime',
                'cpf' => 'required|equals:11',
                'rg' => 'required|max:20|min:6',
                'data_criacao' => 'datetime',
                'data_alteracao' => 'datetime'
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules));


            Utils::validatorRules($request, $rules);

            $user = new User($request);

            return Response::success($this->userBO->save($user)->toJson(), Constants::HTTP_CREATED);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por salvar usuário
     *
     * @return bool|string
     */
    public function all(): bool|string
    {
        // TODO: Implement all() method.
    }
}