<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
function extPhp(string $nameExt, string $message = '')
{
    if (false === \Inilim\Tool\Method\Other\extPhp($nameExt)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'PHP Extension "%s" not found',
            $nameExt
        ));
    }
}
