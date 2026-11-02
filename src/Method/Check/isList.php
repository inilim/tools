<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @template T
 * @psalm-assert-if-true list<T> $value
 * @phpstan-assert-if-true list<T> $value
 * @param mixed $value
 */
function isList($value): bool
{
    return \is_array($value) && \Inilim\Tool\Method\PF\array_is_list($value);
}
