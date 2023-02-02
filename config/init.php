<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/core');
define("HELPERS", CORE . '/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'main');
define("PATH", 'https://127.0.0.1:8000');
define("ADMIN", 'https://127.0.0.1:8000/admin');
define("NO_IMAGE", 'uploads/no-image.jpg');

require_once ROOT . '/vendor/autoload.php';