<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @psalm-type Param_1_multipart = array<array{content:resource|string,name:string,headers?:string[]|array<string,string>,filename?:string}>
 * @psalm-type Param_2_multipart = array{boundary?:string}
 *
 * @param Param_1_multipart $array
 * @param Param_2_multipart $options
 * @return array
 */
function multipart(array $array, array $options = []): array
{
    if (!$array) {
        return [];
    }

    foreach ($array as $element) {

        \Inilim\Tool\Method\Assert\keysExists(
            $element,
            ['contents', 'name'],
            'A "contents" and "name" keys is required from option multipart'
        );

        $content = $element['contents'];
        \Inilim\Tool\Method\Assert\resOrstr($content);
        /** @var string|resource $content */

        $metaData = null;

        if (\is_string($content)) {
            $stream = \Inilim\Tool\Method\Other\tryFopen('php://temp', 'r+');
            if ($content !== '') {
                \fwrite($stream, $content);
                \fseek($stream, 0);
            }
            $content = $stream;
        } else {
            /*
            * The 'php://input' is a special stream with quirks and inconsistencies.
            * We avoid using that stream by reading it into php://temp
            */
            $metaData = \stream_get_meta_data($content);
            if (($metaData['uri'] ?? '') === 'php://input') {
                $stream = \Inilim\Tool\Method\Other\tryFopen('php://temp', 'w+');
                \stream_copy_to_stream($content, $stream);
                \fseek($stream, 0);
                $content = $stream;
            }
        }
        unset($stream);

        $metaData ??= \stream_get_meta_data($content);

        // FILENAME Guzzle procedure

        if (!isset($element['filename'])) {
            $uri = $metaData['uri'] ?? '';
            if ($uri && \substr($uri, 0, 6) !== 'php://' && \substr($uri, 0, 7) !== 'data://') {
                $element['filename'] = $uri;
            }
            unset($uri);
        } else {
            \Inilim\Tool\Method\Assert\string(
                $element['filename'],
                'element multipart key filename myst be string'
            );
        }
        // filename string|unset

        if (isset($element['headers'])) {
            \Inilim\Tool\Method\Assert\isArray($element['headers']);
            $element['headers'] = \Inilim\Tool\Method\Exp\normalizeHeaders($element['headers']);
        } else {
            $element['headers'] = [];
        }

        if (!isset($element['headers']['content-length'])) {
            $size = \Inilim\Tool\Method\Other\getSizeResource($content);
            if ($size !== -1) {
                $element['headers']['content-length'] = (string)$size;
            }
            unset($size);
        }

        // 
    } // endforeach

    // 
    $boundary = (string)$options['boundary'] ?? \bin2hex(\random_bytes(20));

    $content = $element['contents'] ?? null;
    \Inilim\Tool\Method\Assert\resOrstr($content);
}
