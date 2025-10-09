<?php

use Inilim\Tool\Str;
use Inilim\Tool\Other;

require_once __DIR__ . '/../src/all.php';

// ---------------------------------------------
// INFO encode env
// ---------------------------------------------

$t = $_SERVER['__ENV'] ?? '';
if ($t === '') {
    exit('');
}
$t = json_decode($t, true);
if (!\is_array($t)) {
    exit('');
}
$_SERVER['__ENV'] = $t;
unset($t);

// ---------------------------------------------
// 
// ---------------------------------------------

/**
 * @return mixed
 */
function test_get_param_from_env(string $name, $default = null)
{
    return $_SERVER['__ENV'][$name] ?? $default;
}
function test_shutdown()
{
    echo \sprintf(
        '<shutdown work_ms="%s" memory_limit="%s" time_limit="%s" timezone="%s" />',
        \test_startMs() - \START_CASE,
        \ini_get('memory_limit'),
        \ini_get('max_execution_time'),
        \date_default_timezone_get()
    );
}
function test_handle_error($level_err, $message, $file, $line)
{
    $t = [
        'error_reporting' => $t = \error_reporting(),
        'level_err'       => $level_err,
        '@suppress'       => !($t & $level_err),
        'message'         => $message,
        'file'            => $file,
        'line'            => $line,
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
function test_startMs(): int
{
    $t = \microtime(false);
    return \intval(\substr($t, 11) . \substr($t, 2, 3));
}
/**
 * @param mixed $value
 */
function test_recursiveExport(&$value): string
{
    if ($value === null) {
        return 'null';
    }

    if ($value === true) {
        return 'true';
    }

    if ($value === false) {
        return 'false';
    }

    $type = Other::getType($value);

    if ($type === 'float') {
        $precisionBackup = \ini_get('precision');

        \ini_set('precision', '-1');

        try {
            $valueStr = @(string) $value;

            if ((string) @(int) $value === $valueStr) {
                return $valueStr . '.0';
            }

            return $valueStr;
        } finally {
            \ini_set('precision', $precisionBackup);
        }
    }

    if ($type === 'resource_closed') {
        return 'resource (closed)';
    }

    if ($type === 'resource') {
        return \sprintf(
            'resource(%d) of type (%s)',
            $value,
            \get_resource_type($value)
        );
    }

    if ($type === 'string') {
        // Match for most non printable chars somewhat taking multibyte chars into account
        if (\preg_match('/[^\x09-\x0d\x1b\x20-\xff]/', $value)) {
            return 'Binary String: 0x' . \bin2hex($value);
        }

        return "'" .
            \str_replace(
                '<lf>',
                "\n",
                \str_replace(
                    ["\r\n", "\n\r", "\r", "\n"],
                    ['\r\n<lf>', '\n\r<lf>', '\r<lf>', '\n<lf>'],
                    $value
                )
            ) .
            "'";
    }

    return \print_r($value, true);
}

function test_process()
{
    echo \sprintf(
        '<process ini="%s" php_bin="%s" php_version="%s" case="%s" />',
        \strval(\php_ini_loaded_file()),
        \PHP_BINARY,
        \PHP_MAJOR_VERSION . '.' . \PHP_MINOR_VERSION,
        \strval($_SERVER['__ENV']['case'] ?? '')
    );
}

// ---------------------------------------------
// INFO Assert
// ---------------------------------------------

function assertSame($expected, $actual, string $message = '')
{
    $status = 1;
    if ($expected !== $actual) {
        $status = 0;
    }
    echo \sprintf(
        '<assert name="%s" status="%s" message="%s" expected="%s" actual="%s" />',
        __FUNCTION__,
        $status,
        ($message ? \base64_encode($message) : ''),
        \base64_encode(\test_recursiveExport($expected)),
        \base64_encode(\test_recursiveExport($actual))
    );
}

// ---------------------------------------------
// INFO запуск теста
// ---------------------------------------------

\test_process();
(static function () {
    $memory_limit = \test_get_param_from_env('memory_limit', '5M');
    $time_limit = (int)\test_get_param_from_env('time_limit', 5);

    \date_default_timezone_set('UTC');
    \ini_set('display_errors', 1);
    \ini_set('memory_limit', $memory_limit);
    \error_reporting(\E_ALL);
    \set_time_limit($time_limit);
    \ini_set('max_execution_time', $time_limit);
    \set_error_handler('test_handle_error', \E_ALL);
    \register_shutdown_function('test_shutdown');
})();


\define('START_CASE', \test_startMs());
try {
    require_once \test_get_param_from_env('case');
} catch (\Error $e) {
    echo \sprintf(
        '<error message="%s" file="%s" line="%s" />',
        Str::unixNewLines(\htmlspecialchars($e->getMessage()), ' '),
        $e->getFile(),
        $e->getLine()
    );
} catch (\Exception $e) {
    echo \sprintf(
        '<exception class="%s" message="%s" file="%s" line="%s" code="%s" trace="%s" />',
        \get_class($e),
        Str::unixNewLines(\htmlspecialchars($e->getMessage()), ' '),
        $e->getFile(),
        $e->getLine(),
        \base64_encode(\strval($e->getCode())),
        \base64_encode($e->getTraceAsString())
    );
}
