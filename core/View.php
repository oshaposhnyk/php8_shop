<?php

namespace core;

use RedBeanPHP\R;

class View
{

    public string $content = '';


    public function __construct(
        public $route,
        public $layout='',
        public $view='',
        public $meta=[]
    ) {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }

    }//end __construct()


    public function render($data)
    {
        if (is_array($data) === true) {
            extract($data);
        }

        $prefix   = str_replace('\\', '/', $this->route['admin_prefix']);
        $viewFile = APP."/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($viewFile) === true) {
            ob_start();
            include_once $viewFile;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Not found view {$viewFile}", 500);
        }

        if (false !== $this->layout) {
            $layoutFile = APP."/views/layouts/{$this->layout}.php";
            if (is_file($layoutFile) === true) {
                include_once $layoutFile;
            } else {
                throw new \Exception("Not found template {$layoutFile}", 500);
            }
        }

    }//end render()


    public function getMeta(): string
    {
        $out  = '<title>'.h(($this->meta['title'] ?? '')).'</title>'.PHP_EOL;
        $out .= '<meta name="description" content="'.h(($this->meta['description'] ?? '')).'" >'.PHP_EOL;
        $out .= '<meta name="keywords" content="'.h(($this->meta['keywords'] ?? '')).'" >'.PHP_EOL;

        return $out;

    }//end getMeta()


    public function getDbLogs(): void
    {
        if (DEBUG) {
            if (R::testConnection() === true) {
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

    }//end getDbLogs()


    public function getPart($file, $data=null): void
    {
        if (is_array($data)) {
            extract($data);
        }

        $file = APP."/views/{$file}.php";
        if (is_file($file)) {
            include $file;
        } else {
            echo "File {$file} not found";
        }

    }//end getPart()


}//end class
