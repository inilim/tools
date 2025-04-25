<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * equal to or greater than
 * @return bool
 */
function php80()
{
    if (\PHP_VERSION_ID >= 80000) {
        return true;
    }
    return false;
}
