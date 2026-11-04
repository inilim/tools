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
function nullOrInArray($value, array $values, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\inArray($value, $values, $message);

    return $value;
}