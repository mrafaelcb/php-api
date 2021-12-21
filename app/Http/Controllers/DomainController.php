<?php

namespace App\Http\Controllers;

use App\Business\CityBO;
use App\Business\NationBO;
use App\Business\StateBO;
use App\Models\User;
use App\Util\Response;
use App\Util\Utils;
use Exception;

/**
 * Class DomainController
 *
 * @package App\Http\Controllers
 */
class DomainController extends Controller
{
    private CityBO $cityBO;
    private NationBO $nationBO;
    private StateBO $stateBO;

    /**
     * DomainController constructor.
     */
    public function __construct()
    {
        $this->cityBO = CityBO::getInstance();
        $this->nationBO = NationBO::getInstance();
        $this->stateBO = StateBO::getInstance();
    }

    /**
     * Responsável por retornar estado por id do estado
     *
     * @param $request
     * @return User|string
     */
    public function cities($request): User|string
    {
        try {
            $rules = [
                'id' => 'required',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);

            return Response::success($this->cityBO->getByFkEstado(Utils::getValue('id', $request)));
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por retornar todos os paises
     *
     * @return User|string
     */
    public function nations(): User|string
    {
        try {
            return Response::success($this->nationBO->all());
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    /**
     * Responsável por retornar estado por id do país
     *
     * @param $request
     * @return User|string
     */
    public function states($request): User|string
    {
        try {
            $rules = [
                'id' => 'required',
            ];

            $request = Utils::getValuesNotNull($request, array_keys($rules), []);

            Utils::validatorRules($request, $rules);

            return Response::success($this->stateBO->getByFkPais(Utils::getValue('id', $request)));
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}