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