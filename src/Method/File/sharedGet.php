<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get contents of a file with shared access.
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @return array{result:string,exception:null}|array{result:null,exception:THROW_get_0}
 * @throws THROW_get_0
 */
function sharedGet(string $pathToFile, bool $throw = false): array
{
    $args = [
        'pathToFile' => $pathToFile,
        'result'     => null,
        'e'          => null,
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
        $args['e'] = \Inilim\Tool\Method\Obj\getCollectionThrowable();
        foreach ($args['errors'] as $err) {
            $args['e'][] = new \ErrorException($err[0], $err[1], $err[1], $err[2], $err[3]);
        }
        unset($args['errors']);
    }

    if ($args['result'] === false || $args['result'] === null) {
        if ($throw && $args['e']) {
            throw $args['e'];
        }
        return [
            'result'    => null,
            'exception' => $args['e'],
        ];
    }

    return [
        'result'    => $args['result'],
        'exception' => $args['e'],
    ];
}
