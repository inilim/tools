<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @param mixed ...$v
 * @return void
 */
function de(...$v)
{
    \Inilim\Tool\Method\VD\d(...$v);
    exit();
}
