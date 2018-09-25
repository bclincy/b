<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/6/18
 * Time: 6:16 PM
 */

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();
define('APP_ROOT', __DIR__ .'/..');
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(APP_ROOT .'/.env');
// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($settings["settings"]["db"]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\App($settings);

/**
 * Takes the name of env from .env and arrange key value seperate <=>
 * @param string $var
 * @return array|bool
 */
function envVarsToArrays (string $var)
{
    if (isset($_ENV[$var]) && strpos( $_ENV[$var], ',') !== false) {
        $enData = [];
        foreach ( explode(',', $_ENV[$var]) as $key => $value) {
            $kv = explode('<=>', $value);
            $enData[$kv[0]] = $kv[1];
        }
    } elseif (isset($_ENV[$var])) {
        $enData = explode(',', $_ENV[$var]);
    }

    return isset($enData) ? $enData : false;
}