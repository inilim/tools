<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true int<1,max> $value
 * @phpstan-assert-if-true int<1,max> $value
 * @param mixed  $value
 */
function positiveInteger($value): bool
{
    return \is_int($value) && $value > 0;
}
