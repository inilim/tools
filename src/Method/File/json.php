<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file as decoded JSON.
 * @param  mixed  $default
 * @return mixed
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @throws TYPEExceptionV1
 * @throws \JsonException
 */
function json(string $pathToFile, int $flags = 0, bool $lock = false, bool $throw = false, $default = null)
{
    if ($lock) {
        $result = \Inilim\Tool\Method\File\sharedGet($pathToFile);
    } else {
        $result = \Inilim\Tool\Method\File\get($pathToFile);
    }

    if ($result['exception']) {
        if ($throw) {
            throw $result['exception'];
        }
        return $default;
    }

    if (!\Inilim\Tool\Method\Json\isJson($result['result'])) {
        if ($throw) {
            throw new \JsonException(\sprintf('Content file not json "%s"', $pathToFile));
        }
        return $default;
    }

    return \json_decode($result['result'], true, 512, $flags);
}
