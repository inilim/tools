<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * 
 * equal to or greater than
 */
function php82(): bool
{
    return \PHP_VERSION_ID >= 80200 ? true : false;
}
