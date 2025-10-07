<?php

require_once __DIR__ . '/../../vendor/autoload.php';

\define('ABSROOT', __DIR__);
\define('DIR_FILES', \realpath(\ABSROOT . '/../files'));

function test_startMs(): int
{
    $t = \microtime(false);
    return \intval(\substr($t, 11) . \substr($t, 2, 3));
}

function test_handleError($level_err, $message, $file, $line)
{
    $t = [
        'error_reporting' => $t = \error_reporting(),
        'level_err'       => $level_err,
        '@suppress'       => !($t & $level_err),
        'message'         => $message,
        'file'            => $file,
        'line'            => $line,
        'ms'              => \test_startMs(),
    ];

    if ($t['@suppress']) {
        return true;
    }

    if (\in_array($level_err, [\E_DEPRECATED, \E_USER_DEPRECATED], true)) {
    } else {
        $e = new \Error($message);
        $rc = new \ReflectionClass($e);
        $rpf = $rc->getProperty('file');
        $rpl = $rc->getProperty('line');
        $rpf->setAccessible(true);
        $rpl->setAccessible(true);
        $rpf->setValue($e, $file);
        $rpl->setValue($e, $line);
        throw $e;
    }

    // Не запускаем внутренний обработчик ошибок PHP
    return true;
}

function test_shutdown()
{
    echo PHP_EOL . PHP_EOL;
    echo \str_repeat('-', 33);
    echo PHP_EOL . PHP_EOL;
    echo \sprintf(
        '<work_ms>%s</work_ms>',
        \test_startMs() - \START_CASE
    );
    echo \sprintf(
        '<memory_limit>%s</memory_limit>',
        \ini_get('memory_limit')
    );
    echo \sprintf(
        '<time_limit>%s</time_limit>',
        \ini_get('max_execution_time')
    );
    echo \sprintf(
        '<timezone>%s</timezone>',
        \date_default_timezone_get()
    );
}

function test_get_cli_arg(string $name): ?string
{
    return \getopt('', [$name . ':'])[$name] ?? null;
}

// ---------------------------------------------
// 
// ---------------------------------------------

(static function () {


    $memory_limit = \getopt('', ['memory_limit:'])['memory_limit'] ?? '5M';
    $time_limit   = (int)(\getopt('', ['time_limit:'])['time_limit'] ?? 5);

    \date_default_timezone_set('UTC');
    \ini_set('display_errors', 1);
    \ini_set('memory_limit', $memory_limit);
    \error_reporting(\E_ALL);
    \set_time_limit($time_limit);
    \ini_set('max_execution_time', $time_limit);
    \set_error_handler('test_handleError', \E_ALL);
    \register_shutdown_function('test_shutdown');
})();


\define('START_CASE', \test_startMs());
