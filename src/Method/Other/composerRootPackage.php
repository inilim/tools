<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * Data from \Composer\InstalledVersions::getRootPackage()
 * @author inilim
 * @todo tests
 * @return mixed[]|null
 */
function composerRootPackage(): ?array
{
    if (
        \class_exists($class = \Composer\InstalledVersions::class, true)
        &&
        \is_callable($callable = [$class, 'getRootPackage'])
    ) {
        $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => $callable(), null);
        if (!\is_array($value)) {
            return null;
        }
        return $value;
    }

    return null;
}
