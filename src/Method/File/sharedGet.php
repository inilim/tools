<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get contents of a file with shared access.
 * @phpstan-import-type get_throw from \File
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
function sharedGet(string $pathToFile, bool $throw = false): array
{
    $args = [
        'pathToFile' => $pathToFile,
        'result'     => null,
        'exception'  => null,
        'errors'     => null,
    ];

    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$args) {
            $handle = \fopen($args['pathToFile'], 'rb');

            if ($handle) {
                try {
                    if (\flock($handle, \LOCK_SH)) {
                        \clearstatcache(true, $args['pathToFile']);

                        $args['result'] = \fread($handle, \filesize($args['pathToFile']) ?: 1);

                        \flock($handle, \LOCK_UN);
                    }
                } finally {
                    \fclose($handle);
                }
            }
        },
        // [Handle]
        static function ($type, $message, $file, $line) use (&$args) {
            $args['errors'] ??= [];
            $args['errors'][] = [$message, $type, $file, $line];
        }
    );

    // Делаем исключения
    if ($args['errors']) {
        $args['exception'] = \Inilim\Tool\Method\Obj\getCollectionThrowable();
        foreach ($args['errors'] as $err) {
            $args['exception'][] = new \ErrorException($err[0], $err[1], $err[1], $err[2], $err[3]);
        }
        unset($args['errors']);
    }

    if ($args['result'] === false || $args['result'] === null) {
        if ($throw && $args['exception']) {
            throw $args['exception'];
        }
        return [
            'result'    => null,
            'exception' => $args['exception'],
        ];
    }

    return [
        'result'    => $args['result'],
        'exception' => $args['exception'],
    ];
}
