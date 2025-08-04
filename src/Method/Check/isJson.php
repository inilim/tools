<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 */
function isJson($value): bool
{
    if (!\is_string($value)) {
        return false;
    }
    return \Inilim\Tool\Method\PF\json_validate($value);
}
