<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert resource $value
 * @phpstan-assert resource $value
 *
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 *
 * @throws \InvalidArgumentException
 */
function resource($value, ?string $type = null, string $message = '')
{
    if ($type && !\Inilim\Tool\Method\Check\resource($value, $type)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a resource of type %2$s. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            $type
        ));
    }

    if (!\Inilim\Tool\Method\Check\resource($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a resource. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            $type // User supplied message might include the second placeholder.
        ));
    }
}
