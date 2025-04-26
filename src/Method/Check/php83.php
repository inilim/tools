<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * equal to or greater than
 * @return bool
 */
function php83()
{
    return \PHP_VERSION_ID >= 80300 ? true : false;
}
