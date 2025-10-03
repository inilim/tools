<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 */
function existSqliteLib(): bool
{
    return \Inilim\Tool\Method\Other\sqliteLibVersion() !== null;
}
