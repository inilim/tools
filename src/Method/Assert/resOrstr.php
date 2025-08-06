<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert resource|string $value
 * @phpstan-assert resource|string $value
 *
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 *
 * @throws \InvalidArgumentException
 */
function resOrstr($value, ?string $type = null, string $message = '')
{
    if ($type !== null && !\Inilim\Tool\Method\Check\resOrstr($value, $type)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected resource of type %2$s or string. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            $type
        ));
    }

    if (!\Inilim\Tool\Method\Check\resOrstr($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected resource or string. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            $type // User supplied message might include the second placeholder.
        ));
    }
}
