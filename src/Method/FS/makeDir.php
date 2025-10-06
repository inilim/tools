<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Create a directory.
 * @todo tests
 * @author Inilim
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?THROW_get_0}
 * @throws THROW_get_0
 */
function makeDir(
    string $path,
    bool $throw           = false,
    int $mode             = 0755,
    bool $recursive       = false,
    bool $force           = false,
    $context              = null,
    ?array $contextParams = null
): array {

    $args = [
        'path'           => $path,
        'mode'           => $mode,
        'recursive'      => $recursive,
        'force'          => $force,
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
            if ($args['force']) {
                $args['result'] = @\mkdir($args['path'], $args['mode'], $args['recursive'], $args['context']);
            } else {
                $args['result'] = \mkdir($args['path'], $args['mode'], $args['recursive'], $args['context']);
            }
        },
        // [Handle]
        static function ($type, $message, $file, $line, $context) use (&$args) {
            if ($context['isSuppress']) {
                return;
            }
            $args['errors'] ??= [];
            $args['errors'][] = [$message, $type, $file, $line];
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $message, '', -1);
        }
    );

    // Делаем исключения
    if ($args['errors']) {
        $args['exception'] = \Inilim\Tool\Method\Obj\getCollectionThrowable('FS::makeDir(...)');
        foreach ($args['errors'] as $err) {
            [$message, $type, $file, $line] = $err;
            $args['exception'][] = new \ErrorException($message, $type, $type, $file, $line);
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
