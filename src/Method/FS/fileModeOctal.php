<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

function fileModeOctal(string $filename): ?string
{
    $value = \Inilim\Tool\Method\FS\filePerms($filename);
    return $value === null ? null : \substr(\sprintf('%o', $value), -4);
}
