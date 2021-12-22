<?php

namespace App\Routes;

use App\Config\Constants;
use App\Util\Response;

/**
 * Class Routes
 *
 * @package App\Routes
 */
class Routes
{

    private static array $routes = array();

    /**
     * Responsável por inserir na lista os endpoints GET
     *
     * @param $route
     * @param $function
     */
    public static function get($route, $function)
    {
        $route = new Route(Constants::API . $route, $function, Constants::GET);
        self::$routes[] = $route;
    }

    /**
     * Responsável por inserir na lista os endpoints POST
     *
     * @param $route
     * @param $function
     */
    public static function post($route, $function)
    {
        $route = new Route(Constants::API . $route, $function, Constants::POST);
        self::$routes[] = $route;
    }

    /**
     * Responsável por inserir na lista os endpoints PUT
     *
     * @param $route
     * @param $function
     */
    public static function put($route, $function)
    {
        $route = new Route(Constants::API . $route, $function, Constants::PUT);
        self::$routes[] = $route;
    }

    /**
     * Responsável por inserir na lista os endpoints DELETE
     *
     * @param $route
     * @param $function
     */
    public static function delete($route, $function)
    {
        $route = new Route(Constants::API . $route, $function, Constants::DELETE);
        self::$routes[] = $route;
    }

    /**
     * Responsável por descobrir qual rota está chamando e redirecionar
     *
     * @return bool|string
     */
    public static function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $requestUri = explode('?',$requestUri);
        $requestUri = current($requestUri);

        $currentRoute = null;
        foreach (self::$routes as $route) {
            $routeString = $route->getRoute();
            $routeMethod = $route->getMethod();
            if (($routeString == $requestUri) && ($requestMethod == $routeMethod)) {
                $currentRoute = $route;
            }
        }

        if ($currentRoute != null) :
            $function = $currentRoute->getFunction();
            return $function->__invoke();
        else :
            return Response::notFound();
        endif;
    }
}