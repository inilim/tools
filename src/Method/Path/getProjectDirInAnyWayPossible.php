<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @skip_build
 */
function getProjectDirInAnyWayPossible(): ?string
{
    $dir = \Inilim\Tool\Method\Path\getVendorDirInAnyWayPossible();
    return $dir ? \dirname($dir, 1) : null;
}
