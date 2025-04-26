<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * equal to or greater than
 * @return bool
 */
function php82()
{
    return \PHP_VERSION_ID >= 80200 ? true : false;
}
