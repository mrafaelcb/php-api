<?php

namespace App\Http\Controllers;

use App\Business\UserBO;
use App\Config\Constants;
use App\Exceptions\CustomException;
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
class UserController extends Controller
{
    private UserBO $userBO;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userBO = UserBO::getInstance();
    }

    /**
     * Responsável por retornar usuário logado
     *
     * @param User $user
     * @return User|string
     */
    public function get(User $user): User|string
    {
        try {
            return Response::success($this->userBO->getById($user->getId())->toJson());
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por deletar usuário
     *
     * @param $request
     * @return User|string
     */
    public function delete($request): User|string
    {
        try {
            $rules = [
                'id' => 'required',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);

            return Response::success($this->userBO->deleteById(Utils::getValue('id', $request)));
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por editar usuário
     *
     * @param $request
     * @return User|string
     */
    public function edit($request): User|string
    {
        try {
            $rules = [
                'id' => 'required',
                'nome' => 'required|max:60|min:10',
                'data_nascimento' => 'required|datetime|uniqueCpf:1',
                'cpf' => 'required|length:11',
                'rg' => 'required|max:20|min:6',
                'password' => 'required|min:6|max:60',
                'data_criacao' => 'datetime',
                'data_alteracao' => 'datetime',
                'telefones' => 'phone:true',
                'enderecos' => 'address',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);


            Utils::validatorRules($request, $rules);

            $user = new User($request);

            return Response::success($this->userBO->edit($user)->toJson(), Constants::HTTP_CREATED);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por salvar usuário
     *
     * @param $request
     * @return bool|string
     */
    public function save($request): bool|string
    {
        try {
            $rules = [
                'nome' => 'required|max:60|min:10',
                'data_nascimento' => 'required|datetime',
                'cpf' => 'required|length:11|uniqueCpf:0',
                'rg' => 'required|max:20|min:6',
                'password' => 'required|min:6|max:60',
                'data_criacao' => 'datetime',
                'data_alteracao' => 'datetime',
                'telefones' => 'phone',
                'enderecos' => 'address',
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
     * Responsável por retornar todos os usuários
     *
     * @param $request
     * @return bool|string
     */
    public function all($request): bool|string
    {
        try {
            $rules = [
                'page' => 'required',
                'per_page' => 'required',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);


            return Response::success($this->userBO->all(intval(Utils::getValue('page', $request)), intval(Utils::getValue('per_page', $request))));
        } catch (Exception $e) {
            return Response::error($e);
        }

    }
}