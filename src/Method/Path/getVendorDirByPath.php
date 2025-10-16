<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @todo tests
 * @author inilim
 */
function getVendorDirByPath(?string $path = null): ?string
{
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
        // в основном мы будем попадать сюда.
        $t = \Inilim\Tool\Method\Str\beforeLast($path, '/vendor/');
        return \Inilim\Tool\Method\Path\normalize($t . '/vendor');
    } elseif (\Inilim\Tool\Method\PF\str_contains($path, '/src/')) {
        // Сюда мы попадаем если нас склонировали или скачали
        $t = \Inilim\Tool\Method\Str\beforeLast($path, '/src/');
        $t = \Inilim\Tool\Method\Path\normalize($t . '/vendor');
        if (\is_dir($t)) {
            return $t;
        }
    }

    // проверка в текущей папке
    $t = $path . 'vendor';
    if (\is_dir($t)) {
        return $t;
    } else {
        $t = \Inilim\Tool\Method\Path\normalize(\dirname($path) . '/vendor');
        // проверка на уровне выше
        if (\is_dir($t)) {
            return $t;
        }
    }

    return null;
}
