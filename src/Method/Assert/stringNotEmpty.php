<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert non-empty-string $value
 * @phpstan-assert non-empty-string $value
 * @template T
 * @return T
 * @param mixed $value
 * @param string|callable():string $message
 * @throws \InvalidArgumentException
 */
function stringNotEmpty($value, $message = '')
{
    \Inilim\Tool\Method\Assert\string($value, $message);
    \Inilim\Tool\Method\Assert\notSame($value, '', $message);

    return $value;
}