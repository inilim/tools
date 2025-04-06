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
    if (\PHP_VERSION_ID >= 80100) {
        return;
    }
    throw new \AssertionError($message ?: 'The current version is lower than required "8.1"');
}
