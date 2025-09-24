<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 */
function get_exception_handler(): ?callable
{
    if (\Inilim\Tool\Method\Check\php85()) {
        return \get_exception_handler();
    }

    $handler = \set_exception_handler(null);
    \restore_exception_handler();
    return $handler;
}
