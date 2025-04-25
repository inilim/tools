<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * equal to or greater than
 * @return void
 * @throws \AssertionError
 */
function php80(string $message = '')
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return;
    }
    throw new \AssertionError($message ?: 'The current version is lower than required "8.0"');
}
