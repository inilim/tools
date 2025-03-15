<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * analog function "file_put_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @param ?get_throw $e
 * @return int<-1,max> return -1 if error
 * @throws get_throw
 */
function put(
    string $filename,
    $data,
    int $flags            = 0,
    bool $throw           = false,
    &$e                   = null,
    $context              = null,
    ?array $contextParams = null
) {
    $args = [
        'filename'      => $filename,
        'data'          => $data,
        'flags'         => $flags,
        'context'       => $context,
        'contextParams' => $contextParams,
        'result'        => null,
        'exception'     => null,
    ];

    // if ($mkdir && !is_dir($dir)) {
    //     @mkdir($dir, 0777, true);
    // }

    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$args) {
            if (\is_array($args['context'])) {
                $args['context'] = \stream_context_create($args['context'], $args['contextParams']);
            }
            $args['result'] = \file_put_contents($args['filename'], $args['data'], $args['flags'], $args['context']);
        },
        static function ($type, $message) use (&$args) {
            $args['exception'] ??= \Inilim\Tool\Method\Obj\getCollectionThrowable();
            $args['exception'][] = new \ErrorException($message, 0, $type);
        }
    );
    if ($args['result'] === false) {
        $e = $args['exception'];
        if ($throw && $e) {
            throw $e;
        }
        return -1;
    }

    return $args['result'];
}
