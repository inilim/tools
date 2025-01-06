<?php

namespace Inilim\Method\Json;

/**
 * @return mixed
 */
function decode(
    string $value,
    ?bool $associative = null,
    int $depth         = 512,
    int $flags         = 0
) {
    // @phpstan-ignore-next-line
    return \json_decode($value, $associative, $depth, $flags);
}
