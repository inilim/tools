<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert non-empty-string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function stringNotEmpty($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value, $message);
    \Inilim\Tool\Method\Assert\notEq($value, '', $message);
}
