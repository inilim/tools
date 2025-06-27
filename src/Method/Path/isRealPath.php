<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @skip_build
 */
function isRealPath(string $path): bool
{
    $path = \Inilim\Tool\Method\Path\normalize($path);
    return !!\preg_match(\sprintf(
        '#%s|%s#',
        '(\/\.{1,}\/)', // "/..../"
        '(^\.{1,}\/)', // "..../"
    ), $path);
}
