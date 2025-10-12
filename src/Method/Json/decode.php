<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * @return mixed
 */
function decode(
    string $v,
    ?bool $associative = null,
    int $depth         = 512,
    int $flags         = 0
) {
    // @phpstan-ignore-next-line
    return \json_decode($v, $associative, $depth, $flags);
}
