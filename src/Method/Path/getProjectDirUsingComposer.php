<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirUsingComposer()
 */
function getProjectDirUsingComposer(): ?string
{
    $dir = \Inilim\Tool\Method\Path\getVendorDirUsingComposer();
    return $dir ? \dirname($dir, 1) : null;
}
