<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @skip_build
 * конвертировать строку для возможности использовать ее в качестве имени файла или папки
 */
function normalizeName(string $name, string $default = '', string $replacement = '_'): string
{
    $ext = '';
    if (\Inilim\Tool\Method\PF\str_contains($name, '.')) {
        $name = \Inilim\Tool\Method\Str\beforeLast($name, '.');
        $ext  = \Inilim\Tool\Method\Str\afterLast($name, '.');
    }
    return \preg_replace('#[^a-z\d\.\_\-]#ui', $replacement, $name) ?? $default;
}
