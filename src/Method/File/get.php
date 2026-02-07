<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

use function Inilim\Tool\Method\Check\php85;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * 
 * 
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @psalm-import-type Return_get from \TypeFile
 * 
 * 
 * @param null|resource|array $context
 * @return Return_get
 * @throws THROW_get_0
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
        'pathToFile'           => $pathToFile,
        'offset'               => $offset,
        'length'               => $length,
        'useIncludePath'       => $useIncludePath,
        'context'              => $context,
        'contextParams'        => $contextParams,
        'result'               => null,
        'result'               => null,
        'exception'            => null,
        'errors'               => null,
        'http_response_header' => null,
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

            if (\Inilim\Tool\Method\Check\php84()) {
                $args['http_response_header'] = \http_get_last_response_headers();
            } else {
                // Deprecated: The predefined locally scoped $http_response_header variable is deprecated, call http_get_last_response_headers()
                if (isset($http_response_header)) {
                    $args['http_response_header'] = $http_response_header;
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
        $args['exception'] = \Inilim\Tool\Method\Obj\getCollectionThrowable('File::get(...)');
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
            'http_response_header' => $args['http_response_header'],
        ];
    }

    return [
        'result'    => $args['result'],
        'exception' => $args['exception'],
        'http_response_header' => $args['http_response_header'],
    ];
}


// $a = get('');

// if (isset($a['exception'])) {
//     foreach ($a['exception'] as $e) {
//     }
// }
