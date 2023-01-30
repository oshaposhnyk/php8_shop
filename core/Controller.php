<?php

namespace core;

use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{
    public array $data = [];
    public array $meta = [];
    public string|false $layout = '';
    public string $view = '';
    public object $model;

    public function __construct(public array $route = [])
    {
    }

    public function getModel(): void
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function set(array $data): void
    {
        $this->data = $data;
    }

    public function setMeta(string $title = '', string $description = '', $keywords = ''): void
    {
        $this->meta = [
            'title' => $title, 'description' => $description, 'keywords' => $keywords
        ];
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    #[NoReturn] public function loadView(string $view, array $vars = [])
    {
        extract($vars);
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        require APP . "/views/{$prefix}{$this->route['controller']}/{$view}.php";
        die();
    }
}