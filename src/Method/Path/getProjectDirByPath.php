<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirByPath()
 */
function getProjectDirByPath(?string $path = null): ?string
{
    $dir = \Inilim\Tool\Method\Path\getVendorDirByPath($path);
    return $dir ? \dirname($dir, 1) : null;
}
