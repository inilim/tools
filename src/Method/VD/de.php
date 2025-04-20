<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @param mixed ...$v
 * @return void
 */
function de()
{
    \Inilim\Tool\Method\VD\d(...\func_get_args());
    exit();
}
