<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert iterable<string> $value
 * @phpstan-assert iterable<string> $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function allString($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\isIterable($value);

    /** @var iterable $value */

    foreach ($value as $entry) {
        \Inilim\Tool\Method\Assert\string($entry, $message);
    }
}
