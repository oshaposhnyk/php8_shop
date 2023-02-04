<?php

namespace core;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    public static function add($regexp, $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    protected static function removeQueryString(string $url): string
    {
        if ($url) {
            $params = explode('?', $url, 2);
            if (false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }

        return '';
    }

    public static function dispatch(string $url): void
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            if (!empty(self::$route['lang'])) {
                App::$app->setProperty('lang', self::$route['lang']);
            }
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
            $action = self::$route['action'] . 'Action';

            if (class_exists($controller)) {

                /** @var Controller $controllerObj */
                $controllerObj = new $controller(self::$route);
                $controllerObj->getModel();


                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    throw new \Exception("Action {$controller}::{$action} not found", 404);
                }
            } else {
                throw new \Exception("Controller {$controller} not found", 404);
            }
        } else {
            throw new \Exception('Page not found', 404);
        }
    }

    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}
