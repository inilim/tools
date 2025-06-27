<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:int<-1,max>,exception:null|TYPEExceptionV1} return result -1 if error
 * @throws TYPEExceptionV1
 */
function put(
    string $filename,
    $data,
    int $flags            = 0,
    bool $throw           = false,
    $context              = null,
    ?array $contextParams = null
): array {
    $args = [
        'filename'      => $filename,
        'data'          => $data,
        'flags'         => $flags,
        'context'       => $context,
        'contextParams' => $contextParams,
        'result'        => null,
        'exception'     => null,
        'errors'        => null,
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
            $args['result'] = \file_put_contents($args['filename'], $args['data'], $args['flags'], $args['context']);
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
            'result'    => -1,
            'exception' => $args['exception'],
        ];
    }

    return [
        'result'    => $args['result'],
        'exception' => $args['exception'],
    ];
}
