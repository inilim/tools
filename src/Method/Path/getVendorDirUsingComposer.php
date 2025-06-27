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
        \class_exists($class = \Composer\InstalledVersions::class, true)
        && \method_exists($class, 'getRootPackage')
        && \is_array($result = $class::getRootPackage())
        && \is_string(
            ($result = $result['install_path'] ?? null)
        )
        && \is_string($result = \realpath($result))
    ) {
        return $cacheDir = \Inilim\Tool\Method\Path\normalize($result . '/vendor');
    }

    return null;
}
