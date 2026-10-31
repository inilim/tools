<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function isFile(string $filename): bool
{
    $value = \Inilim\Tool\Method\FS\isFile_m2([$filename]);
    return \Inilim\Tool\Method\PF\array_first($value);
}
