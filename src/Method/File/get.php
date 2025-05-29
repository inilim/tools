<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param null|resource|array $context
 * @return array{result:string|null,exception:null|TYPEExceptionV1}
 * @throws TYPEExceptionV1
 */
function get(
    string $pathToFile,
    int $offset           = 0,
    ?int $length          = null,
    bool $useIncludePath  = false,
    bool $throw           = false,
    $context              = null,
    ?array $contextParams = null
): array {
    $args = [
        'pathToFile'     => $pathToFile,
        'offset'         => $offset,
        'length'         => $length,
        'useIncludePath' => $useIncludePath,
        'context'        => $context,
        'contextParams'  => $contextParams,
        'result'         => null,
        'exception'      => null,
        'errors'         => null,
    ];

    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$args) {
            if (\is_array($args['context'])) {
                // php 8.0.0 Параметры options и params теперь принимают значение null.
                if ($args['contextParams'] === null) {
                    $args['context'] = \stream_context_create($args['context']);
                } else {
                    $args['context'] = \stream_context_create($args['context'], $args['contextParams']);
                }
            }
            // php 8.0.0 Параметр length теперь принимает значение null.
            if ($args['length'] === null) {
                $args['result'] = \file_get_contents($args['pathToFile'], $args['useIncludePath'], $args['context'], $args['offset']);
            } else {
                $args['result'] = \file_get_contents($args['pathToFile'], $args['useIncludePath'], $args['context'], $args['offset'], $args['length']);
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

    if ($args['result'] === false) {
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
