<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * @param mixed $value
 * @return void
 * @throws \AssertionError
 */
function enumCase($value, string $message = '')
{
    if (\Inilim\Tool\Method\Enum\isCase($value)) {
        return;
    }
    throw new \AssertionError($message ?: 'Expected an \UnitEnum');
}
