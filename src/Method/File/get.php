<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param null|resource|array $context
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
function get(
    string $filename,
    int $offset           = 0,
    ?int $length          = null,
    bool $useIncludePath  = false,
    bool $throw           = false,
    $context              = null,
    ?array $contextParams = null
) {
    $args = [
        'filename'       => $filename,
        'offset'         => $offset,
        'length'         => $length,
        'useIncludePath' => $useIncludePath,
        'context'        => $context,
        'contextParams'  => $contextParams,
        'result'         => null,
        'exception'      => null,
    ];

    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$args) {
            if (\is_array($args['context'])) {
                $args['context'] = \stream_context_create($args['context'], $args['contextParams']);
            }
            $args['result'] = \file_get_contents($args['filename'], $args['useIncludePath'], $args['context'], $args['offset'], $args['length']);
        },
        static function ($type, $message) use (&$args) {
            $args['exception'] ??= \Inilim\Tool\Method\Obj\getCollectionThrowable();
            $args['exception'][] = new \ErrorException($message, 0, $type);
        }
    );

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
        'exception' => null,
    ];
}
