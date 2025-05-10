<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @param mixed  $value
 */
function file($value): bool
{
    return \is_string($value) && \is_file($value);
}
