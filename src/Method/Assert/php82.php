<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * equal to or greater than
 * @param string $message
 * @return void
 * @throws \AssertionError
 */
function php82($message = '')
{
    if (\Inilim\Tool\Method\Check\php82()) {
        return;
    }
    throw new \AssertionError($message ?: 'The current version is lower than required "8.2"');
}
