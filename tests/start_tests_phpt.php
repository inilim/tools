<?php

use Inilim\Tool\Str;
use Inilim\Tool\Test\Internal;

require_once __DIR__ . '/../src/all.php';
require_once __DIR__ . '/Internal.php';
require_once __DIR__ . '/Assert.php';

// ---------------------------------------------
// INFO encode env
// ---------------------------------------------

(static function () {
    $t = $_SERVER['__ENV'] ?? '';
    if ($t === '') {
        exit('');
    }
    $t = \json_decode($t, true);
    if (!\is_array($t)) {
        exit('');
    }
    $_SERVER['__ENV'] = $t;
})();

// ---------------------------------------------
// INFO запуск теста
// ---------------------------------------------

Internal::process();
(static function () {
    $memory_limit = Internal::get_param_from_env('memory_limit', '128M');
    $time_limit   = Internal::get_param_from_env('time_limit', 5);
    $composer_autoload = Internal::get_param_from_env('composer_autoload', false);

    if ($composer_autoload) {
        require_once __DIR__ . '/../vendor/autoload.php';
    }

    \date_default_timezone_set('UTC');
    \ini_set('display_errors', 1);
    \ini_set('memory_limit', $memory_limit);
    \error_reporting(\E_ALL);
    \set_time_limit($time_limit);
    \ini_set('max_execution_time', $time_limit);
    \set_error_handler([Internal::class, 'handle_error'], \E_ALL);
    \register_shutdown_function([Internal::class, 'shutdown']);
})();

// ---------------------------------------------
// 
// ---------------------------------------------

\define('START_CASE', Internal::startMs());
try {
    require_once Internal::get_param_from_env('case');
} catch (\Error $e) {
    echo \sprintf(
        // TODO use data
        '<error message="%s" file="%s" line="%s" />',
        Str::unixNewLines(\htmlspecialchars($e->getMessage()), ' '),
        $e->getFile(),
        $e->getLine()
    );
} catch (\Exception $e) {
    echo \sprintf(
        // TODO use data
        '<exception class="%s" message="%s" file="%s" line="%s" code="%s" trace="%s" />',
        \get_class($e),
        Str::unixNewLines(\htmlspecialchars($e->getMessage()), ' '),
        $e->getFile(),
        $e->getLine(),
        \base64_encode(\strval($e->getCode())),
        \base64_encode($e->getTraceAsString())
    );
}
