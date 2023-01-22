<?php

function debug($data, $die = false): void
{
    echo '<pre>' . print_r($data, 1) . '<pre>';

    if ($die) {
        die;
    }
}

function h($str): string
{
    return htmlspecialchars($str);
}

function redirect($http = false): void
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? PATH;
    }

    header("Location: ".  $redirect);
    die();
}

function baseUrl(): string
{
    return PATH . '/' . (\core\App::$app->getProperty('lang') . '/' ?? '');
}

/**
 * @param $key - key of $_GET array
 * @param $type Values 'i', 'f', 's'
 * @return string|int|float
 */
function get($key, $type = 'i'): string|int|float
{
    $param = $key;
    $param = $_GET[$param] ?? '';

    if ($type == 'i') {
        return (int) $param;
    } elseif ($type == 'f') {
        return (float) $param;
    } else {
        return trim($param);
    }
}

/**
 * @param $key - key of $_POST array
 * @param $type Values 'i', 'f', 's'
 * @return string|int|float
 */
function post($key, $type = 's'): string|int|float
{
    $param = $key;
    $param = $_POST[$param] ?? '';

    if ($type == 'i') {
        return (int) $param;
    } elseif ($type == 'f') {
        return (float) $param;
    } else {
        return trim($param);
    }
}

function l(string $key): void
{
    echo \core\Language::get($key);
}

function lang(string $key): string
{
    return \core\Language::get($key);
}