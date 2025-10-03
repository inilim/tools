<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 */
function sqliteLibVersion(): ?string
{
    \ob_start();
    \phpinfo(\INFO_MODULES);
    $pinfo = \ob_get_clean();
    \preg_match('/SQLite\s+Library\s+=>\s+(\d+\.\d+\.?\d+?)/i', $pinfo, $match);
    return $match[1] ?? null;
}
