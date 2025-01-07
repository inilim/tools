<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;

Json::__include('hasError');

/**
 * the method does not throw exceptions JsonException, instead it returns the default value
 * 
 * @template T
 * @param T $default
 * @return mixed|T
 */
function tryDecode(
    string $value,
    ?bool $associative = null,
    int $depth         = 512,
    int $flags         = 0,
    $default           = null
) {
    try {
        // @phpstan-ignore-next-line
        $value = \json_decode($value, $associative, $depth, $flags);
    } catch (\JsonException $e) {
        return $default;
    }
    if (hasError()) {
        return $default;
    }
    return $value;
}
