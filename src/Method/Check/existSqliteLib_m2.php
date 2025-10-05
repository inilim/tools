<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * INFO phpinfo берем из кеш файла
 * @author Inilim
 */
function existSqliteLib_m2(): bool
{
    return \Inilim\Tool\Method\Other\sqliteLibVersion_m2() !== null;
}
