<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @skip_build
 */
function getVendorDirInAnyWayPossible(): ?string
{
    $dir = \Inilim\Tool\Method\Path\getVendorDirUsingComposer()
        ?? \Inilim\Tool\Method\Path\getVendorDirByPath();

    return $dir;
}
