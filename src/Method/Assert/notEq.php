<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @param mixed  $value
 * @param mixed  $expect
 * @throws \InvalidArgumentException
 */
function notEq($value, $expect, string $message = '')
{
    if ($expect == $value) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a different value than %s.',
            \Inilim\Tool\Method\Other\valueToString($expect)
        ));
    }
}
