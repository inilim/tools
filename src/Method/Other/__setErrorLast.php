<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @internal Inilim\Tool\Method\Other
 */
function __setErrorLast(int $type, string $message, string $file, int $line): void
{
    \Inilim\Tool\Method\Other\__state()->error = [
        'type'    => $type,
        'message' => $message,
        'file'    => $file,
        'line'    => $line,
    ];
}
