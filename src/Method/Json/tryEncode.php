<?php

namespace Inilim\Method\Json;

/**
 * the method does not throw exceptions JsonException, instead it returns the default value
 * 
 * @template T
 * @param T $default return default if failed encode
 * @param mixed $value
 * @return string|T
 */
function tryEncode($value, int $flags = 0, int $depth = 512, $default = null)
{
    try {
        // @phpstan-ignore-next-line
        $json = \json_encode($value, $flags, $depth);
    } catch (\JsonException $e) {
        return $default;
    }
    if ($json === false) {
        return $default;
    }
    return $json;
}
