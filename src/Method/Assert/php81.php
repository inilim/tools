<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * equal to or greater than
 * @return void
 * @throws \AssertionError
 */
function php81(string $message = '')
{
    if (\Inilim\Tool\Method\Check\php81()) {
        return;
    }
    throw new \AssertionError($message ?: 'The current version is lower than required "8.1"');
}
