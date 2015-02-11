<?php namespace Paper\Http;

use Paper\Foundation\Application;
use Paper\Support\Collection;
use Paper\Exceptions\Http\NotFoundException;

class Router {

    /**
     * @var Collection
     */
    protected $routes;
    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app) {
        $this->routes = new Collection();
        $this->app = $app;
    }

    /**
     * @param $route    string
     * @param $action   Callable|string
     */
    public function register($route, $action)
    {
        $route = $this->sanitizeRoute($route);
        $this->routes[$route] = $action;
    }

    public function run(Request $request)
    {
        $route = $request->getRoute();

        if(! $this->routeExists($route)) {
            throw new NotFoundException();
        }

        return $this->handleRoute($route, $request);
    }

    private function handleRoute($route, $request)
    {
        $action = $this->routes[$route];

        if(is_callable($action)) {
            return $action($request);
        }

        return $this->callControllerAction($action, $request);
    }

    private function routeExists($route)
    {
        return $this->routes->exists($route);
    }

    private function callControllerAction($action, $request)
    {
        list($controller, $action) = explode('@', $action);

        $class = $this->resolveControllerClass($controller);

        $controller = new $class($request);
        return $controller->{$action}();
    }

    private function sanitizeRoute($route)
    {
        return clean_url($route);
    }

    private function resolveControllerClass($controller)
    {
        if(class_exists($controller))
            return $controller;

        $namespace = $this->app->configuration->get('app.namespace.controllers');

        return $namespace.$controller;
    }

}