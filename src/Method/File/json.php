<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file as decoded JSON.
 * @param  mixed  $default
 * @param  int  $flags json_decode flags
 * @return mixed
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @throws THROW_get_0
 * @throws \JsonException
 */
function json(
    string $pathToFile,
    int $flags  = 0,
    bool $lock  = false,
    bool $throw = false,
    $default    = null
) {
    if ($lock) {
        $result = \Inilim\Tool\Method\File\sharedGet($pathToFile);
    } else {
        $result = \Inilim\Tool\Method\File\get($pathToFile);
    }

    if ($result['exception']) {
        if ($throw) {
            throw $result['exception'];
        }
        \Inilim\Tool\Method\Other\__setErrorLast(
            -1,
            \sprintf('Read file "%s" failed', $pathToFile),
            '',
            -1
        );
        return $default;
    }

    if (!\Inilim\Tool\Method\Check\isJson($result['result'])) {
        $m = \sprintf('Content from file "%s" not json', $pathToFile);
        if ($throw) {
            throw new \JsonException($m);
        }
        \Inilim\Tool\Method\Other\__setErrorLast(-1, $m, '', -1);
        return $default;
    }

    return \json_decode($result['result'], true, 512, $flags);
}
