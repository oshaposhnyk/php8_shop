<?php

/**
 * @var $errno ErrorHandler
 * @var $errstr ErrorHandler
 * @var $errfile ErrorHandler
 * @var $errline ErrorHandler
 */

use core\ErrorHandler;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body>

<h1>Error</h1>
<p><b>Error code:</b> <?= $errno ?></p>
<p><b>Error message:</b> <?= $errstr ?></p>
<p><b>Error file:</b> <?= $errfile ?></p>
<p><b>Error line code:</b> <?= $errline ?></p>

</body>
</html>
