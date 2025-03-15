<?php

namespace Inilim\Tool\Method\Json;

/**
 * the method does not throw exceptions JsonException, instead it returns the default value
 * 
 * @template T
 * @param T $default
 * @return mixed|T
 */
function tryDecode(
    string $v,
    ?bool $associative = null,
    int $depth         = 512,
    int $flags         = 0,
    $default           = null
) {
    try {
        // @phpstan-ignore-next-line
        $v = \json_decode($v, $associative, $depth, $flags);
    } catch (\JsonException $e) {
        return $default;
    }
    if (\Inilim\Tool\Method\Json\hasError()) {
        return $default;
    }
    return $v;
}
