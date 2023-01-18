<?php

namespace core;

use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = []
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Not found view {$view_file}", 500);
        }

        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Not found template {$layout_file}", 500);
            }
        }
    }

    public function getMeta(): string
    {
        $out = '<title>' . h($this->meta['title'] ?? '') . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="'. h($this->meta['description'] ?? '') .'" >' . PHP_EOL;
        $out .= '<meta name="keywords" content="'. h($this->meta['keywords'] ?? '') .'" >' . PHP_EOL;

        return $out;
    }

    public function getDbLogs(): void
    {
        if (DEBUG) {
            if (R::testConnection()) {
                $logs = R::getLogger();
                $logs = array_merge(
                    $logs->grep('SELECT'),
                    $logs->grep('select'),
                    $logs->grep('INSERT'),
                    $logs->grep('insert'),
                    $logs->grep('DELETE'),
                    $logs->grep('delete'),
                );

                debug($logs);
            }

        }
    }

    public function getPart($file, $data = null): void
    {
        if (is_array($data)) {
            extract($data);
        }

        $file = APP . "/views/{$file}.php";
        if (is_file($file)) {
            require $file;
        } else {
            echo "File {$file} not found";
        }
    }

}