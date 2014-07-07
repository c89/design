<?php
define('IN_SHARK', 1);
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
require 'config.php';
$app = new \Slim\Slim($setting);

// Set config into app container
foreach ($config as $key => $val) {
    $app->config($key, $val);
}
// Autorun middleware or
if (isset($config['auto'])) {
    if (isset($config['auto']['helper'])) {
        foreach ($config['auto']['helper'] as $val) {
            $helper = '\\Shark\Helper\\' . ucfirst($val);
            $app->container->singleton($val, function() use ($app, $helper) {
                return new $helper();
            });
        }
    }
    if (isset($config['auto']['middleware'])) {
        foreach ($config['auto']['middleware'] as $val) {
            $mid = '\\Shark\Middleware\\' . ucfirst($val);
            $app->add(new $mid()); 
        }
    }
    if (isset($config['auto']['hook'])) {
        foreach ($config['auto']['hook'] as $val) {
            $name = 'Shark' . DIRECTORY_SEPARATOR . 'hook' . DIRECTORY_SEPARATOR . strtolower($name) . '.php';
            require($name);
        }
    }
}

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$route = function($app) {
    $name = trim(urldecode($app->request->getResourceUri()), " \t\n\r\0\x0B//");
    $name = array_shift(explode('/', $name));
    $name = preg_replace('/[^a-zA-Z]/', '', $name);
    if ($name == '') {
        $name = 'home';
    }
    $name = sprintf('app/control/%s.php', strtolower($name));
    if (file_exists($name)) {
        require($name);
    }
};
$route($app);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
