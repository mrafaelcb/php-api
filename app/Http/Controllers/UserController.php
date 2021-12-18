<?php

namespace App\Http\Controllers;

use App\Util\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    private Request $request;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
    }
}