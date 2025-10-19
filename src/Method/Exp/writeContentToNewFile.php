<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * 
 * commands "get:file" "get:count" "get:resource" "end"|"close"|"finish"
 * 
 * @param ?string $dir default sys_get_temp_dir()
 * @return null|\Closure(mixed $value,?string $command):false|int|resource|string
 */
function writeContentToNewFile(?string $dir = null): ?\Closure
{
    if ($dir !== null) {
        \Inilim\Tool\Method\Assert\dir($dir);
    } else {
        $dir = \sys_get_temp_dir();
    }

    $opt = [
        'end'      => false,
        'count'    => 0,
        'file'     => \Inilim\Tool\Method\Path\normalize($dir . '/inilim-tools-' . \Inilim\Tool\Method\ID\uuidv7() . '.tmp'),
        'resource' => null,
    ];

    $resource = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \fopen($opt['file'], 'wb'),
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );

    if (!\is_resource($resource)) {
        return null;
    }
    $opt['resource'] = $resource;

    return static function ($value, ?string $command = null) use (&$opt) {

        if ($opt['end']) {
            return $opt['file'];
        }

        if ($command !== null) {

            // ---------------------------------------------
            // Команда
            // ---------------------------------------------

            switch ($command) {
                case 'get:count':
                    // выдать количество успешных итераций
                    return $opt['count'];
                case 'get:resource':
                    // выдать ресурс
                    return $opt['resource'];
                case 'get:file':
                    // выдать путь до файла
                    return $opt['file'];
                case 'close':
                case 'end':
                case 'finish':
                    // завершить сеанс и выдать путь до файла
                    \fclose($opt['resource']);
                    $opt['resource'] = null;
                    $opt['end']      = true;
                    return $opt['file'];
            }
            return;
        }

        // ---------------------------------------------
        // Запись
        // ---------------------------------------------

        $value  = (string)$value;
        $errMsg = null;
        $status = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
            static fn() => \fwrite($opt['resource'], $value),
            static function ($_, $msg) use (&$errMsg) {
                $errMsg = $msg;
            }
        );
        if ($errMsg !== null) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $errMsg, '', -1);
            $status = false;
        } else {
            $opt['count']++;
        }

        return $status;
    };
}
