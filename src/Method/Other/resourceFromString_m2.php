<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * via tmpfile()
 * @author inilim
 * @todo tests
 * @return resource|false
 */
function resourceFromString_m2(string $string)
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($string) {
        $stream = \tmpfile();
        if ($string !== '') {
            \fwrite($stream, $string);
            \fseek($stream, 0);
        }
        return $stream;
    });
}
