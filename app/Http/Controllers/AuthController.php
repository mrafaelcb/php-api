<?php

namespace App\Http\Controllers;

use App\Business\AuthBO;
use App\Util\Request;
use App\Util\Response;
use App\Util\Utils;
use Exception;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    private AuthBO $authBO;
    private Request $request;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->authBO = AuthBO::getInstance();
        $this->request = new Request();
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function login()
    {
        $request = $this->request->getBody();

        try {
            $rules = [
                'cpf' => 'required|length:11',
                'password' => 'required|min:6|max:60',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);

            return Response::success($this->authBO->createToken(
                Utils::getValue('cpf', $request),
                Utils::getValue('password', $request)
            ));
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}