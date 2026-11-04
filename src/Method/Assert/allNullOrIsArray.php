<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param string $message
 *
 * @return void
 *
 * @throws \InvalidArgumentException
 */
function allNullOrIsArray($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\isIterable($value);

    foreach ($value as $entry) {
        null === $entry || \Inilim\Tool\Method\Assert\isArray($entry, $message);
    }
}