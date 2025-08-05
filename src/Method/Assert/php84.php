<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
function php84(string $message = '')
{
    if (!\Inilim\Tool\Method\Check\php84()) {
        throw new \InvalidArgumentException($message ?: 'The current version is lower than required "8.4"');
    }
}
