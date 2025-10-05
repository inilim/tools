<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * INFO phpinfo берем из кеш файла
 * @author inilim
 * @todo tests
 */
function sqliteLibVersion_m2(bool $fresh = false): ?string
{
    $info = \Inilim\Tool\Method\Other\phpInfoCache(\INFO_MODULES, $fresh);
    if ($info === null) {
        return null;
    }
    \preg_match('/SQLite\s+Library\s+=>\s+(\d+\.\d+\.?\d+?)/i', $info, $match);
    return $match[1] ?? null;
}
