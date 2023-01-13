<?php

namespace core;

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
        $model = 'app\models\\' . $this->data['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
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
}