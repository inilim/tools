<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * INFO phpinfo берем из кеш файла
 * @author Inilim
 * @throws \InvalidArgumentException
 */
function existSqliteLib_m2(string $message = '')
{
    if (!\Inilim\Tool\Method\Check\existSqliteLib_m2()) {
        throw new \InvalidArgumentException($message ?: 'SQLite library not exist');
    }
}
