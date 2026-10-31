<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @deprecated use exists()
 */
function fileExists(string $filename): bool
{
    return \Inilim\Tool\Method\FS\exists($filename);
}
