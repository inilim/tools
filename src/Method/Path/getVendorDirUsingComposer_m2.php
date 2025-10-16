<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 */
function getVendorDirUsingComposer_m2(): ?string
{
    static $cacheDir = null;
    /** @var ?string $cacheDir */

    if ($cacheDir !== null) {
        return $cacheDir;
    }
    $path = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () {
            if (!\class_exists($class = \Composer\InstalledVersions::class, true)) {
                return null;
            }
            $ref = new \ReflectionClass($class);
            return $ref->getFileName();
        },
        null
    );

    if (\is_string($path)) {
        $path = \Inilim\Tool\Method\Path\normalize($path);
        if (\Inilim\Tool\Method\PF\str_contains($path, '/vendor/')) {
            $t = \Inilim\Tool\Method\Str\beforeLast($path, '/vendor/');
            return $cacheDir = \Inilim\Tool\Method\Path\normalize($t . '/vendor');
        }
    }
    return null;
}
