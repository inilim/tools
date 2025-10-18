<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed  $value
 * @param array  $values
 * @param string $message
 *
 * @return void
 *
 * @throws \InvalidArgumentException
 */
function allInArray($value, $values, $message = '')
{
    \Inilim\Tool\Method\Assert\isIterable($value);

    foreach ($value as $entry) {
        \Inilim\Tool\Method\Assert\inArray($entry, $values, $message);
    }
}
