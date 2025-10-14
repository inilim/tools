<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 */
function getVendorDirByPath(?string $path = null): ?string
{
    $result = null;

    if ($path === null) {
        $path = __DIR__;
    } else {
        // если путь произвольный, то проверяем что он существует
        $path = \Inilim\Tool\Method\Path\realPath($path);
        if ($path === null) {
            return null;
        }
    }
    $path = \Inilim\Tool\Method\Path\normalize($path . '/');

    if (\Inilim\Tool\Method\PF\str_contains($path, '/vendor/')) {
        $path   = \Inilim\Tool\Method\Str\beforeLast($path, '/vendor/');
        $result = \Inilim\Tool\Method\Path\normalize($path . '/vendor');
    } else {
        // проверка в текущей папке
        if (\is_dir($path . 'vendor')) {
            $result = $path . 'vendor';
        } else {
            $path = \Inilim\Tool\Method\Path\normalize(\dirname($path) . '/');
            // проверка на уровне выше
            if (\is_dir($path . 'vendor')) {
                $result = $path . 'vendor';
            }
        }
    }

    return $result;
}
