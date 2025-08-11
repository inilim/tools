<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

use function Inilim\Tool\Method\Data\getMimeTypeByExt;

/**
 * @psalm-type Param_1_multipart = array<array{content:resource|string,name:string,headers?:string[]|array<string,string>,filename?:string}>
 * @psalm-type Param_2_multipart = array{boundary?:string}
 *
 * @param Param_1_multipart $array
 * @param Param_2_multipart $options
 */
function multipart(array $array, array $options = []): string
{
    if (!$array) {
        return '';
    }

    $boundary = (string)($options['boundary'] ?? \bin2hex(\random_bytes(20)));
    $body = '';
    foreach ($array as $element) {

        \Inilim\Tool\Method\Assert\keysExists(
            $element,
            ['contents', 'name'],
            'A "contents" and "name" keys is required from option multipart'
        );

        $name = $element['name'];
        \Inilim\Tool\Method\Assert\string($name, '"name" must be string');


        $content = $element['contents'];
        \Inilim\Tool\Method\Assert\resOrstr($content, '"contents" must be string or resource');
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
        $filename = $element['filename'] ?? null;

        if ($filename === null) {
            $uri = $metaData['uri'] ?? '';
            if ($uri && \substr($uri, 0, 6) !== 'php://' && \substr($uri, 0, 7) !== 'data://') {
                $filename = $uri;
            }
            unset($uri);
        } else {
            \Inilim\Tool\Method\Assert\string(
                $filename,
                '"filename" must be string'
            );
        }
        // filename string|unset
        $headers = $element['headers'] ?? null;

        if ($headers !== null) {
            \Inilim\Tool\Method\Assert\isArray($headers, '"headers" must be array');
            $headers = \Inilim\Tool\Method\Exp\normalizeHeaders($headers);
        } else {
            $headers = [];
        }

        if (!isset($headers['content-length'])) {
            $size = \Inilim\Tool\Method\Other\getSizeResource($content);
            if ($size !== -1) {
                $headers['content-length'] = [(string)$size];
            }
            unset($size);
        }

        if (!isset($headers['content-disposition'])) {
            $headers['content-disposition'] = ($filename === '0' || $filename)
                ? [\sprintf(
                    'form-data; name="%s"; filename="%s"',
                    $name,
                    \basename($filename)
                )]
                : ["form-data; name=\"{$name}\""];
        }

        if (!isset($headers['content-type'])) {
            if ($filename === '0' || $filename) {
                $ext = \pathinfo($filename, \PATHINFO_EXTENSION);
                $headers['content-type'] = [\Inilim\Tool\Method\Data\getMimeTypeByExt($ext) ?? 'application/octet-stream'];
                unset($ext);
            }
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $body .= "--{$boundary}\r\n";
        foreach ($headers as $key => $value) {
            $value = \implode(', ', $value);
            $body .= "{$key}: {$value}\r\n";
        }

        $body .= \trim($body) . "\r\n\r\n";
        $body .= $content;
        $body .= "\r\n";
        $body .= "--{$boundary}--\r\n";
    } // endforeach

    return $body;
}
