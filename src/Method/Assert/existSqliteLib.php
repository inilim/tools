<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * @throws \InvalidArgumentException
 */
function existSqliteLib(string $message = '')
{
    if (!\Inilim\Tool\Method\Check\existSqliteLib()) {
        throw new \InvalidArgumentException($message ?: 'SQLite library not exist');
    }
}
