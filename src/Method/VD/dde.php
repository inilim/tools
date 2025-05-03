<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @param mixed ...$v
 * @return void
 */
function dde(...$v)
{
    \Inilim\Tool\Method\VD\dd(...$v);
    exit();
}
