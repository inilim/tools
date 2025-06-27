<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 */
function getVendorDirByPath(?string $path = null): ?string
{
    static $cacheDirForSelf = null;
    /** @var ?string $cacheDirForSelf */

    $self  = $path === null;

    if ($self && $cacheDirForSelf !== null) {
        return $cacheDirForSelf;
    }

    $result = null;

    $path ??= __DIR__;
    $path = \Inilim\Tool\Method\Path\normalize($path . '/');
    if (\Inilim\Tool\Method\PF\str_contains($path, '/vendor/')) {
        $path = \Inilim\Tool\Method\Str\beforeLast($path, '/vendor/');
        $result = \Inilim\Tool\Method\Path\normalize($path . '/vendor');
    } else {
        if (\is_dir($path . 'vendor')) {
            $result = $path . 'vendor';
        } else {
            $path = \Inilim\Tool\Method\Path\normalize(\dirname($path) . '/');
            if (\is_dir($path . 'vendor')) {
                $result = $path . 'vendor';
            }
        }
    }

    if ($self && $result !== null) {
        $cacheDirForSelf = $result;
    }

    return $result;
}
