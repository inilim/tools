<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @psalm-pure
 * @psalm-import-type Main_Countable from \TypeMain
 * @psalm-assert Main_Countable $value
 * @phpstan-assert Main_Countable $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function isCountable($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\countable($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a countable. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
