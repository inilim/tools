<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param array $values
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function oneOf($value, $values, $message = '')
{
    \Inilim\Tool\Method\Assert\inArray($value, $values, $message);

    return $value;
}