<?php

require_once('vendor/autoload.php');

use Pecee\SimpleRouter\SimpleRouter;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
/* Load external routes file */
require_once 'routes.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\Demo\Controllers');

// Start the routing
SimpleRouter::start();