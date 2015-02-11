<?php

/**
 * Require the auto-loader.
 */
require __DIR__  . '/vendor/autoload.php';

/**
 * Instantiate the application.
 */
$app = new Paper\Foundation\Application();

/**
 * Run the application.
 */
echo $app->run();

exit();