<?php

namespace Inilim\Tool\Test;

class Internal
{
    /**
     * @return mixed
     */
    static function get_param_from_env(string $name, $default = null)
    {
        return $_SERVER['__ENV'][$name] ?? $default;
    }

    static function shutdown()
    {
        echo \sprintf(
            '<shutdown work_ms="%s" memory_limit="%s" time_limit="%s" timezone="%s" />',
            self::startMs() - \START_CASE,
            \ini_get('memory_limit'),
            \ini_get('max_execution_time'),
            \date_default_timezone_get()
        );
    }

    static function handle_error($level_err, $message, $file, $line)
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

    static function startMs(): int
    {
        $t = \microtime(false);
        return \intval(\substr($t, 11) . \substr($t, 2, 3));
    }

    static function process()
    {
        $data = [
            'ini'         => \strval(\php_ini_loaded_file()),
            'php_bin'     => \PHP_BINARY,
            'php_version' => \PHP_MAJOR_VERSION . '.' . \PHP_MINOR_VERSION,
            'case'        => $_SERVER['__ENV']['case'],
            'env'         => $_SERVER['__ENV'],
        ];
        echo \sprintf(
            '<process data="%s" />',
            \base64_encode(\json_encode($data))
        );
    }
}
