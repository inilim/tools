<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * equal to or greater than
 */
function php85(): bool
{
    return \PHP_VERSION_ID >= 80500 ? true : false;
}
