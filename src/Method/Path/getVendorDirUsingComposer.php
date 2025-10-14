<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 */
function getVendorDirUsingComposer(): ?string
{
    static $cacheDir = null;
    /** @var ?string $cacheDir */

    if ($cacheDir !== null) {
        return $cacheDir;
    }

    if (
        \is_array($result = \Inilim\Tool\Method\Other\composerRootPackage())
        && \is_string(($result = $result['install_path'] ?? null))
        && \is_string($result = \Inilim\Tool\Method\Path\realPath($result))
    ) {
        return $cacheDir = \Inilim\Tool\Method\Path\normalize($result . '/vendor');
    }

    return null;
}
